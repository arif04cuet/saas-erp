<?php

namespace Modules\VMS\Services;

use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use App\Services\RoleService;
use App\Constants\NotificationType as NotificationTypeConstant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\Employee;
use Modules\IMS\Entities\InventoryItemRequest;
use Modules\VMS\Entities\Trip;
use Modules\VMS\Entities\Vehicle;
use Modules\VMS\Repositories\TripRepository;

class TripWorkflowService
{

    /**
     * @var RoleService
     */
    private $roleService;
    /**
     * @var VehicleService
     */
    private $vehicleService;
    /**
     * @var TripLimitService
     */
    private $tripLimitService;
    /**
     * @var TripRepository
     */
    private $tripRepository;

    /**
     * @var VehicleTypeService
     */
    private $vehicleTypeService;

    public function __construct(
        RoleService $roleService,
        VehicleService $vehicleService,
        TripLimitService $tripLimitService,
        VehicleTypeService $vehicleTypeService,
        TripRepository $tripRepository
    ) {
        $this->vehicleService = $vehicleService;
        $this->roleService = $roleService;
        $this->vehicleTypeService = $vehicleTypeService;
        $this->tripRepository = $tripRepository;
        $this->tripLimitService = $tripLimitService;
    }

    public function start(Trip $trip)
    {
        $roles = config('vms.trip.workflow.start_privilege');
        $users = null;
        foreach ($roles as $rolename) {
            $role = $this->roleService->firstOrCreate($rolename);
            if (is_null($role)) {
                continue;
            }
            $users = $role->users;
            if (!is_null($users)) {
                break;
            }
        }
        // send this user a notification about the trip
        foreach ($users as $user) {
            if (!is_null($user)) {
                $message = trans('vms::trip.notification_messages.start',
                    ['name' => $trip->requester->getName() ?? trans('labels.not_found')]);
                $this->sendTripNotification($trip, $user, $message);
            } else {
                throw  new \Exception('No user Found with roles: ' . $roles);
            }
        }
    }

    public function approve(Trip $trip)
    {
        try {
            DB::beginTransaction();
            $user = auth()->user();
            $workflow = config('vms.trip.workflow.flow');
            $distanceRestriction = config('vms.trip.workflow.distance_restriction');
            $superAdminRole = config('vms.trip.workflow.super_admin');
            $endRoleNames = config('vms.trip.workflow.end_privilege');
            if ($user->hasAnyRole($endRoleNames)) {
                // if the user is super_admin, approve it
                if ($user->hasRole($superAdminRole)) {
                    $trip->update(['status' => Trip::getStatuses()['approved']]);
                    DB::commit();
                    return $trip;
                }
                // up to 50km, super admin is not needed
                if ($trip->distance == Trip::getDistanceOptions()['below_25']) {
                    $trip->update(['status' => Trip::getStatuses()['approved']]);
                    DB::commit();
                    return $trip;
                }

                // if not traverse in the end privilege
                $this->traverse($trip);
            } else {
                // user is just an intermediate person, pass to next supervisor
                $this->traverse($trip);
            }
            DB::commit();
            return $trip;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . " Trace " . $exception->getTraceAsString());
            return false;
        }
    }

    public function isUserEndPrivileged()
    {
        $endRoleNames = config('vms.trip.workflow.end_privilege');
        $authUser = $this->getAuthUser();
        if ($authUser->hasAnyRole($endRoleNames)) {
            return true;
        }
        return false;
    }

    public function isUserRejectPrivileged()
    {
        $endRoleNames = config('vms.trip.workflow.reject_privilege');
        $authUser = $this->getAuthUser();
        if ($authUser->hasAnyRole($endRoleNames)) {
            return true;
        }
        return false;
    }

    public function isUserStartPrivileged()
    {
        $endRoleNames = config('vms.trip.workflow.start_privilege');
        $authUser = $this->getAuthUser();
        if ($authUser->hasAnyRole($endRoleNames)) {
            return true;
        }
        return false;
    }

    public function canUserRejectTrip(Trip $trip)
    {

        $requester = $trip->requester;
        if (($this->getAuthUser()->id == $requester->id) || $this->isUserRejectPrivileged()) {
            return true;
        }
        return false;
    }

    public function sendTripNotification(
        Trip $trip,
        $toUser,
        $message,
        $notificationType = NotificationTypeConstant::VMS_TRIP_REQUEST
    ) {
        $notificationType = NotificationType::where('name', $notificationType)->first();
        if ($toUser) {
            $notification = Notification::create([
                'type_id' => $notificationType->id,
                'ref_table_id' => $trip->id,
                'from_user_id' => $this->getAuthUser()->id,
                'to_user_id' => $toUser->id,
                'message' => $message,
                'item_url' => route('vms.trip.workflow.show', $trip->id)
            ]);
            if (Session::has('success')) {
                $message = Session::get('success');
                $message .= ', ' . $toUser->name;
                Session::flash('success', $message);
            } else {
                Session::flash('success',
                    trans('vms::trip.notification_messages.workflow_message', ['name' => $toUser->name]));
            }
        }
    }

    public function shouldShowApproveRejectButton(Trip $trip)
    {
        $tripStatus = Trip::getStatuses();
        if ($trip->status == $tripStatus['pending']) {
            if (Gate::allows('admin-vms-trip-approve')) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function getRecentTripsOfRequester(Trip $trip)
    {
        return $this->tripRepository->getRecentTripsOfRequester($trip->requester_id);
    }

    public function hasRequesterCrossedTripLimits(Trip $trip): bool
    {
        $hasRequesterCrossedLimits = $this->tripLimitService->hasRequesterCrossedTripLimits($trip->requester);
        if ($hasRequesterCrossedLimits) {
            Session::flash('warning', trans('vms::trip.limit.flash_messages.trip_limit_crossed'));
        }
        return $hasRequesterCrossedLimits;
    }

    public function getRequesterMaxTripLimits(Trip $trip)
    {
        return $this->tripLimitService->getRequesterMaxTripLimits($trip->requester);
    }

    public function getStatusClassArray()
    {
        return [
            'approved' => 'primary',
            'completed' => 'success',
            'pending' => 'warning',
            'draft' => 'warning',
            'rejected' => 'danger',
            'cancelled' => 'danger',
            'ongoing' => 'warning',
            'paid' => 'success',
            'partially_paid' => 'primary'
        ];
    }

    public function shouldShowVehicleSelection(Trip $trip)
    {
        $tripStatus = Trip::getStatuses();
        $vehicleSelectionRole = config('vms.trip.workflow.vehicle_selection');
        if ($trip->status == $tripStatus['pending'] && !is_null($vehicleSelectionRole)) {
            if (auth()->user()->hasRole($vehicleSelectionRole)) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function getAvailableVehicles(Trip $trip)
    {
        $vehicleTypeId = $trip->vehicle_type_id;
        $vehicles = $this->vehicleService->findBy([
            'vehicle_type_id' => $vehicleTypeId,
            'status' => Vehicle::getStatuses()['available']
        ]);
        return $vehicles;
    }

    public function getAllAvailableVehicles()
    {
        return $this->vehicleService->findBy([
            'status' => Vehicle::getStatuses()['available']
        ]);
    }

    public function getVehicleTypesForSelection()
    {
        return $this->vehicleTypeService->getVehicleTypesForDropdown();
    }



    //------------------------------------------------------------------------------------------------------------------
    //                                          Private Function
    //------------------------------------------------------------------------------------------------------------------

    private function traverse(Trip $trip)
    {
        $workflow = config('vms.trip.workflow.flow');
        $authUser = $this->getAuthUser();
        $authUserRoles = $authUser->roles;
        $isSentToNextUser = false;

        foreach ($authUserRoles as $userRole) {
            $roleName = $userRole->name;
            if (array_key_exists($roleName, $workflow)) {
                $nextUserRole = $this->roleService->findBy(['name' => $workflow[$roleName]])->first();
                foreach ($this->getUsersOfRole($nextUserRole->name) as $user) {
                    if ($user) {
                        $message = trans('vms::trip.notification_messages.start',
                            ['name' => $trip->requester->getName() ?? trans('labels.not_found')]);
                        $this->sendTripNotification($trip, $user, $message);
                        $isSentToNextUser = true;
                    }
                }
            }
        }
        if (!$isSentToNextUser) {
            throw  new \Exception('User Role Not Found In VMS TRIP WORKFLOW');
            Log::error('User Role Not Found In VMS TRIP WORKFLOW');
        }
    }

    private function getAuthUser()
    {
        return auth()->user();
    }

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

