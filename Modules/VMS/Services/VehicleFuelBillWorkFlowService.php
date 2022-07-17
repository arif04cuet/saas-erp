<?php

namespace Modules\VMS\Services;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use App\Services\RoleService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\VMS\Entities\VehicleFuelBillSubmit as FuelBill;


class VehicleFuelBillWorkFlowService
{

    /**
     * @var RoleService
     */
    private $roleService;
    /**
     * @var TripService
     */
    private $tripService;
    /**
     * @var TripBillService
     */
    private $tripBillService;

    /**
     * VehicleFuelBillWorkFlowService constructor.
     * @param RoleService $roleService
     * @param TripBillService $tripBillService
     */

    public function __construct(RoleService $roleService, TripBillService $tripBillService)
    {
        $this->roleService = $roleService;
        $this->tripService = $tripBillService;
    }

    /**
     * @param FuelBill $fuelBill
     * @throws \Exception
     */
    public function start(FuelBill $fuelBill)
    {

        $roles = config('vms.fuelBill.workflow.start_privilege');
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
                $message = trans('vms::fuelBillSubmit.notification_messages.start',
                    ['name' => $fuelBill->requester->getName() ?? trans('labels.not_found')]);
                $this->sendTripNotification($fuelBill, $user, $message);
            } else {
                throw  new \Exception('No user Found with roles: ' . $roles);
            }
        }
    }

    /**
     * @param FuelBill $fuelBill
     * @return false|FuelBill
     */
    public function approve(FuelBill $fuelBill)
    {
        try {
            DB::beginTransaction();
            $user = auth()->user();
            $workflow = config('vms.fuelBill.workflow.flow');
            $distanceRestriction = config('vms.fuelBill.workflow.distance_restriction');
            $superAdminRole = config('vms.fuelBill.workflow.super_admin');
            $endRoleNames = config('vms.fuelBill.workflow.end_privilege');
            if ($user->hasAnyRole($endRoleNames)) {
                // if the user is super_admin, approve it
                if ($user->hasRole($superAdminRole)) {
                    $fuelBill->update(['status' => FuelBill::getStatuses()['approved']]);
                    $this->tripBillService->submitVehicleFuelBillToAccounts($fuelBill);
                    //todo:: add integration to accounts
                    DB::commit();
                    return $fuelBill;
                }
                // up to 50km, super admin is not needed
//                if ($fuelBill->distance <= $distanceRestriction) {
                $fuelBill->update(['status' => FuelBill::getStatuses()['approved']]);
                DB::commit();
                return $fuelBill;
//                }
                // if not traverse in the end privilegezZ
//                $this->traverse($fuelBill);
            } else {

                // user is just an intermediate person, pass to next supervisor
                $this->traverse($fuelBill);
            }

            DB::commit();
            return $fuelBill;
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
        $endRoleNames = config('vms.fuelBill.workflow.end_privilege');
        $authUser = $this->getAuthUser();
        if ($authUser->hasAnyRole($endRoleNames)) {
            return true;
        }
        return false;
    }

    /**
     * @param FuelBill $fuelBill
     * @return bool
     */
    public function canUserRejectTrip(FuelBill $fuelBill)
    {
        $requester = $fuelBill->requester;
        if (($this->getAuthUser()->id == $requester->id) || $this->isUserEndPrivileged()) {
            return true;
        }
        return false;
    }

    /**
     * @param FuelBill $fuelBill
     * @param $toUser
     * @param $message
     * @param string $notificationType
     */
    public function sendTripNotification(
        FuelBill $fuelBill,
        $toUser,
        $message,
        $notificationType = NotificationTypeConstant::VMS_FUEL_BILL_REQUEST
    ) {
        $notificationType = NotificationType::where('name', $notificationType)->first();
        if ($toUser) {
            $notification = Notification::create([
                'type_id' => $notificationType->id,
                'ref_table_id' => $fuelBill->id,
                'from_user_id' => $this->getAuthUser()->id,
                'to_user_id' => $toUser->id,
                'message' => $message,
                'item_url' => route('vms.fuel.Bill.workflow.show', $fuelBill->id)
            ]);
        }
    }

    /**
     * @param $fuelBill
     * @return bool
     */
    public function shouldShowApproveRejectButton($fuelBill)
    {
        $fuelBillStatus = FuelBill::getStatuses();
        if ($fuelBill->status == $fuelBillStatus['pending']) {
            if (Gate::allows('admin-vms-fuel-bill-approve')) {
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
     * @param FuelBill $fuelBill
     * @throws \Exception
     */
    private function traverse(FuelBill $fuelBill)
    {
        $workflow = config('vms.fuelBill.workflow.flow');
        $authUser = $this->getAuthUser();
        $authUserRoles = $authUser->roles;
        $isSentToNextUser = false;

        foreach ($authUserRoles as $userRole) {
            $roleName = $userRole->name;
            if (array_key_exists($roleName, $workflow)) {
                $nextUserRole = $this->roleService->findBy(['name' => $workflow[$roleName]])->first();
                foreach ($this->getUsersOfRole($nextUserRole->name) as $user) {
                    if ($user) {
                        $message = trans('vms::fuelBillSubmit.notification_messages.start',
                            ['name' => $fuelBill->requester->getName() ?? trans('labels.not_found')]);
                        $this->sendTripNotification($fuelBill, $user, $message);
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

    private function submitAmountToAccountsModule()
    {

    }
}

