<?php

namespace Modules\IMS\Services;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use App\Entities\User;
use App\Services\RoleService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\IMS\Entities\InventoryItemRequest;
use Modules\IMS\Entities\InventoryLocation;
use Modules\VMS\Entities\Trip;

class InventoryItemRequestWorkflowService
{
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function start(InventoryItemRequest $inventoryItemRequest)
    {
        $roles = config('ims.constants.item.request.workflow.start_privilege');
        $selectedRole = null;
        $users = null;
        foreach ($roles as $rolename) {
            $role = $this->roleService->findBy(['name' => $rolename])->first();
            if (is_null($role)) {
                continue;
            }
            $users = $role->users;
            if (!is_null($users)) {
                $selectedRole = $role;
                break;
            }
        }
        // filter the users by department head
        $users = $this->filterUserByDepartment($inventoryItemRequest, $users, $selectedRole);
        // send this user a notification about the trip
        foreach ($users as $user) {
            if (!is_null($user)) {
                $message = trans('ims::inventory.item.item_request.notification_messages.pending',
                    ['name' => $inventoryItemRequest->requester->name ?? trans('labels.not_found')]);
                $inventoryItemRequest->update(['status' => InventoryItemRequest::getStatus()['pending']]);
                $this->sendWorkflowNotification($inventoryItemRequest, $user, $message);
            } else {
                throw  new \Exception('No User Found with roles: ' . $selectedRole->name);
            }
        }
    }

    public function approve(InventoryItemRequest $inventoryItemRequest)
    {
        try {
            DB::beginTransaction();
            $user = auth()->user();
            $superAdminRole = config('ims.constants.item.request.workflow.super_admin');
            $endRoleNames = config('ims.constants.item.request.workflow.end_privilege');
            if ($user->hasAnyRole($endRoleNames)) {
                // if the user is super_admin, approve it
                if ($user->hasRole($superAdminRole)) {
                    $inventoryItemRequest->update(['status' => InventoryItemRequest::getStatus()['approved']]);
                    DB::commit();
                    return $inventoryItemRequest;
                }
                // if not traverse in the end privilege
                $this->traverse($inventoryItemRequest);
            } else {
                // user is just an intermediate person, pass to next supervisor
                $this->traverse($inventoryItemRequest);
            }
            DB::commit();
            return $inventoryItemRequest;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . " Trace " . $exception->getTraceAsString());
            return false;
        }
    }

    public function isUserEndPrivileged()
    {
        $endRoleNames = config('ims.constants.item.request.workflow.end_privilege');
        $authUser = $this->getAuthUser();
        if ($authUser->hasAnyRole($endRoleNames)) {
            return true;
        }
        return false;
    }

    public function canUserRejectTrip(InventoryItemRequest $inventoryItemRequest)
    {

        $requester = $inventoryItemRequest->requester;
        if (($this->getAuthUser()->id == $requester->id) || $this->isUserEndPrivileged()) {
            return true;
        }
        return false;
    }

    public function sendWorkflowNotification(
        InventoryItemRequest $inventoryItemRequest,
        $toUser,
        $message,
        $notificationTypeName = NotificationTypeConstant::INVENTORY_ITEM_REQUEST
    ) {
        $notificationType = NotificationType::where('name', $notificationTypeName)->first();
        if (is_null($notificationType)) {
            $notificationType = NotificationType::firstOrCreate([
                'name' => $notificationTypeName,
                'is_application_notification' => 1
            ]);
        }
        if ($toUser) {
            $notification = Notification::create([
                'type_id' => $notificationType->id,
                'ref_table_id' => $inventoryItemRequest->id,
                'from_user_id' => $this->getAuthUser()->id,
                'to_user_id' => $toUser->id,
                'message' => $message,
                'item_url' => route('inventory-item-request.workflow.show', $inventoryItemRequest)
            ]);
        }
        Session::flash('success', 'Request Has Been Sent To ' . $toUser->name);
    }

    public function shouldShowApproveRejectButton(InventoryItemRequest $inventoryItemRequest): bool
    {
        $status = InventoryItemRequest::getStatus();
        $allowedRoles = config('ims.constants.item.request.workflow.end_privilege');
        if (($inventoryItemRequest->status == $status['pending']) || $inventoryItemRequest->status == $status['new']) {
            if ($this->getAuthUser()->hasAnyRole($allowedRoles)) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function checkIfStoreAdminHasProperRole(InventoryLocation $inventoryLocation)
    {
        $storeAdmin = $inventoryLocation->adminEmployee;
        $user = optional($storeAdmin)->user ?? null;
        if (is_null($user)) {
            $errorMessage = 'Store Admin : ' . $storeAdmin->name . ' : Does Not Have A User Profile';
            Session::flash('error', $errorMessage);
            throw  new \Exception($errorMessage);
        }
        $superAdmin = config('ims.constants.item.request.workflow.super_admin');
        $this->roleService->firstOrCreate($superAdmin);
        if (!$user->hasRole($superAdmin)) {
            $errorMessage = 'Store Admin : ' . $storeAdmin->name . ' : Does Not Have ROLE_INVENTORY_STORE_ADMIN role!';
            Session::flash('error', $errorMessage);
            throw  new \Exception($errorMessage);
        }
    }

    public function changeStatus(InventoryItemRequest $inventoryItemRequest, $status)
    {
        try {
            $statusArray = InventoryItemRequest::getStatus();
            if (!array_key_exists($status, $statusArray)) {
                throw new \Exception('Invalid Status!');
            }
            $this->checkIfStoreAdminHasProperRole($inventoryItemRequest->inventoryLocation);
            switch ($status) {
                case $statusArray['approved'] :
                    return $this->approve($inventoryItemRequest);
                case $statusArray['reject']:
                    return $this->reject($inventoryItemRequest);
                default:
                    throw new \Exception('Invalid Status !');
                    return false;
            }
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function reject(InventoryItemRequest $inventoryItemRequest)
    {
        $inventoryItemRequest->update(['status' => 'rejected']);
        return $inventoryItemRequest;

    }

    //------------------------------------------------------------------------------------------------------------------
    //                                          Private Function
    //------------------------------------------------------------------------------------------------------------------

    private function traverse(InventoryItemRequest $inventoryItemRequest)
    {
        $workflow = config('ims.constants.item.request.workflow.flow');
        $superAdminRole = config('ims.constants.item.request.workflow.super_admin');
        $authUser = $this->getAuthUser();
        $authUserRoles = $authUser->roles;
        $isSentToNextUser = false;

        foreach ($authUserRoles as $userRole) {
            $roleName = $userRole->name;
            if (array_key_exists($roleName, $workflow)) {
                $nextRoleName = $workflow[$roleName];
                // if the next-role is super-admin, send the notification to the specific store admin
                if ($nextRoleName == $superAdminRole) {
                    $storeAdminUser = optional($inventoryItemRequest->inventoryLocation)->adminEmployee->user;
                    $message = trans('ims::inventory.item.item_request.notification_messages.pending',
                        ['name' => optional($inventoryItemRequest->requester)->name ?? trans('labels.not_found')]);
                    $this->sendWorkflowNotification($inventoryItemRequest, $storeAdminUser, $message);
                    $isSentToNextUser = true;
                } else {
                    $nextUserRole = $this->roleService->findBy(['name' => $nextRoleName])->first();
                    // for each users of that role, send a notification
                    foreach ($this->getUsersOfRole($nextUserRole->name) as $user) {
                        if ($user) {
                            $message = trans('ims::inventory.item.item_request.notification_messages.pending',
                                ['name' => optional($inventoryItemRequest->requester)->name ?? trans('labels.not_found')]);
                            $this->sendWorkflowNotification($inventoryItemRequest, $user, $message);
                        }
                    }
                    $isSentToNextUser = true;
                }
            }
        }
        if (!$isSentToNextUser) {
            Log::error('User Role Not Found In Inventory Item Request Workflow');
            throw  new \Exception('User Role Not Found In Inventory Item Request Workflow');
        }
    }

    private function getAuthUser()
    {
        return auth()->user();
    }

    private function filterUserByDepartment(
        InventoryItemRequest $inventoryItemRequest,
        Collection $users,
        $selectedRole = 'ROLE'
    ) {
        $requester = $inventoryItemRequest->requester;
        $departmentId = get_user_department($requester)->id;

        $users = $users
            ->filter(function ($user) use ($departmentId) {
                if (!empty($user->employee)) {
                    return get_user_department($user)->id == $departmentId;
                }
            });
        if (empty($users)) {
            throw new \Exception('No User Found With This Role: ' . $selectedRole->name . ' In ' . get_user_department($requester)->name . ' Department');
        }
        return $users;

    }

    private function getUsersOfRole(
        $roleName
    ) {
        $role = $this->roleService->findBy(['name' => $roleName])->first();
        if ($role) {
            return $role->users ?? [];
        } else {
            Log::error('Inventory Item Request Error: No User Found With This Role: ' . $roleName);
            throw new \Exception('No User Found With This Role: ' . $roleName);
        }
    }

}

