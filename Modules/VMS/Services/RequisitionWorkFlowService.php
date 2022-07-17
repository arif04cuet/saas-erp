<?php

namespace Modules\VMS\Services;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use App\Services\RoleService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\VMS\Entities\VehicleMaintenanceRequisition as VMRequisition;
use Auth;

class RequisitionWorkFlowService
{

    /**
     * @var RoleService
     */
    private $roleService;
    /**
     * @var TripBillService
     */
    private $tripBillService;

    /**
     * VehicleVMRequisitionWorkFlowService constructor.
     * @param RoleService $roleService
     * @param TripBillService $tripBillService
     */

    public function __construct(RoleService $roleService, TripBillService $tripBillService)
    {
        $this->roleService = $roleService;
        $this->tripBillService = $tripBillService;
    }

    /**
     * @param VMRequisition $vmRequisition
     * @throws \Exception
     */
    public function start(VMRequisition $vmRequisition)
    {
        $roles = config('vms.requisition.workflow.start_privilege');
        $users = null;
        foreach ($roles as $rolename) {
            $role = $this->roleService->findBy(['name' => $rolename])->first();
            if (is_null($role)) {
                continue;
            }
            $users = $role->users;
            if (!is_null($users)) {
                break;
            }
        }
        // send this user a notification about the Fuel Bill
        foreach ($users as $user) {
            if (!is_null($user)) {
                $message = trans('vms::requisition.notification_messages.start',
                    ['name' => $vmRequisition->requester->getName() ?? trans('labels.not_found')]);
                $this->sendTripNotification($vmRequisition, $user, $message);
            } else {
                throw  new \Exception('No user Found with roles: ' . $roles);
            }
        }
    }

    /**
     * @param VMRequisition $vmRequisition
     * @return false|VMRequisition
     */
    public function approve(VMRequisition $vmRequisition)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();
            $workflow = config('vms.requisition.workflow.flow');
            $amountRestriction = config('vms.requisition.workflow.amount_restriction');
            $superAdminRole = config('vms.requisition.workflow.super_admin');
            $endRoleNames = config('vms.requisition.workflow.end_privilege');
            if ($user->hasAnyRole($endRoleNames)) {
                // if the user is super_admin, approve it
                if ($user->hasRole($superAdminRole)) {
                    $vmRequisition->update([
                        'status' => VMRequisition::getStatuses()['approved'],
                        'approve_by' => Auth::id()
                    ]);
                    $this->tripBillService->submitVehicleMaintenanceBillToAccounts($vmRequisition);
                    DB::commit();
                    return $vmRequisition;
                }

                // up to 8k, super admin is not needed
                if ($vmRequisition->total_amount < $amountRestriction) {
                    $vmRequisition->update([
                        'status' => VMRequisition::getStatuses()['approved'],
                        'approve_by' => Auth::id()
                    ]);

                    DB::commit();
                    return $vmRequisition;
                }
                $this->traverse($vmRequisition);
            } else {
                // user is just an intermediate person, pass to next supervisor
                $this->traverse($vmRequisition);
            }

            DB::commit();
            return $vmRequisition;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . " Trace " . $exception->getTraceAsString());
            return false;
        }
    }

    /**
     * @return bool
     */
    public function isUserEndPrivileged()
    {
        $endRoleNames = config('vms.requisition.workflow.end_privilege');
        $authUser = $this->getAuthUser();
        if ($authUser->hasAnyRole($endRoleNames)) {
            return true;
        }
        return false;
    }

    /**
     * @param VMRequisition $vmRequisition
     * @return bool
     */
    public function canUserRejectTrip(VMRequisition $vmRequisition)
    {
        $requester = $vmRequisition->requester;
        if (($this->getAuthUser()->id == $requester->id) || $this->isUserEndPrivileged()) {
            return true;
        }
        return false;
    }

    /**
     * @param VMRequisition $vmRequisition
     * @param $toUser
     * @param $message
     * @param string $notificationType
     */
    public function sendTripNotification(
        VMRequisition $vmRequisition,
        $toUser,
        $message,
        $notificationType = NotificationTypeConstant::VMS_MAINTENANCE_REQUISITION_REQUEST
    ) {
        $notificationType = NotificationType::where('name', $notificationType)->first();
        if ($toUser) {
            $notification = Notification::create([
                'type_id' => $notificationType->id,
                'ref_table_id' => $vmRequisition->id,
                'from_user_id' => $this->getAuthUser()->id,
                'to_user_id' => $toUser->id,
                'message' => $message,
                'item_url' => route('vms.requisition.work.flow.show', $vmRequisition->id)
            ]);
        }
    }

    /**
     * @param $vmRequisition
     * @return bool
     */
    public function shouldShowApproveRejectButton($vmRequisition)
    {
        $vmRequisitionStatus = VMRequisition::getStatuses();
        if ($vmRequisition->status == $vmRequisitionStatus['pending']) {
            if (Gate::allows('admin-vms-maintenance-requisition-approve')) {
                return true;
            }
            return false;
        }
        return false;
    }

    //------------------------------------------------------------------------------------------------------------------
    //                                          Private Function
    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param VMRequisition $vmRequisition
     * @throws \Exception
     */
    private function traverse(VMRequisition $vmRequisition)
    {
        $workflow = config('vms.requisition.workflow.flow');
        $authUser = $this->getAuthUser();
        $authUserRoles = $authUser->roles;
        $isSentToNextUser = false;
        foreach ($authUserRoles as $userRole) {
            $roleName = $userRole->name;
            if (array_key_exists($roleName, $workflow)) {
                $nextUserRole = $this->roleService->findBy(['name' => $workflow[$roleName]])->first();
                foreach ($this->getUsersOfRole($nextUserRole->name) as $user) {
                    if ($user) {
                        $message = trans('vms::requisition.notification_messages.start',
                            ['name' => $vmRequisition->requester->getName() ?? trans('labels.not_found')]);
                        $this->sendTripNotification($vmRequisition, $user, $message);
                    }
                }
                $isSentToNextUser = true;
            }
        }
        if (!$isSentToNextUser) {
            throw  new \Exception('User Role Not Found In VMS FUEL BILL WORKFLOW');
            Log::error('User Role Not Found In VMS FUEL BILL WORKFLOW');
        }
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private function getAuthUser()
    {
        return auth()->user();
    }

    /**
     * @param $roleName
     * @return array
     * @throws \Exception
     */
    private function getUsersOfRole($roleName)
    {
        $role = $this->roleService->findBy(['name' => $roleName])->first();
        if ($role) {
            return $role->users ?? [];
        } else {
            throw new \Exception('No User Found With This Role: ' . $roleName);
            Log::error('VMS WORKFLOW ERROR: No User Found With This Role: ' . $roleName);
        }
    }


}

