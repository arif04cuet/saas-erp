<?php

namespace Modules\VMS\Services;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Services\EmployeeService;
use Modules\VMS\Entities\EmployeeTrip;
use Modules\VMS\Entities\Trip;
use Modules\VMS\Entities\TripVehicle;
use Modules\VMS\Entities\Vehicle;
use Modules\VMS\Repositories\TripRepository;

class TripService
{
    use CrudTrait;

    /**
     * @var EmployeeService
     */
    private $employeeService;
    /**
     * @var VehicleService
     */
    private $vehicleService;
    /**
     * @var TripWorkflowService
     */
    private $tripWorkflowService;
    /**
     * @var TripBillPaymentService
     */
    private $tripBillPaymentService;
    /**
     * @var TripCalculationSettingService
     */
    private $tripCalculationSettingService;
    /**
     * @var TripBillService
     */
    private $tripBillService;


    public function __construct(
        TripRepository $tripRepository,
        EmployeeService $employeeService,
        TripBillService $tripBillService,
        TripWorkflowService $tripWorkflowService,
        TripBillPaymentService $tripBillPaymentService,
        TripCalculationSettingService $tripCalculationSettingService,
        VehicleService $vehicleService
    ) {
        $this->setActionRepository($tripRepository);
        $this->employeeService = $employeeService;
        $this->vehicleService = $vehicleService;
        $this->tripBillService = $tripBillService;
        $this->tripWorkflowService = $tripWorkflowService;
        $this->tripCalculationSettingService = $tripCalculationSettingService;
        $this->tripBillPaymentService = $tripBillPaymentService;
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $trip = $this->saveTripData($data);
            $this->savePassengerInformation($trip, $data);
            //$this->saveVehicleInformation($trip, $data);
            $this->tripWorkflowService->start($trip);
            DB::commit();
            return true;
        } catch (Exception $exception) {
            Log::error('Trip Error: ' . $exception->getMessage() . ' Trace: ' . $exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    public function getEmployeesForDropdown()
    {
        return $this->employeeService->getEmployeesForDropdown();
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

    public function isUserEndPrivileged()
    {
        return $this->tripWorkflowService->isUserEndPrivileged();
    }

    public function isUserStartPrivileged()
    {
        return $this->tripWorkflowService->isUserStartPrivileged();
    }

    public function changeStatus(Trip $trip, $status)
    {
        try {
            DB::beginTransaction();
            if ($status == Trip::getStatuses()['approved']) {
                if (!$trip->vehicles->count()) {
                    $message = trans('vms::trip.flash_messages.vehicle_selection_error');
                    Session::flash('error', $message);
                    throw  new Exception($message);
                }
                // approval has a workflow !
                $this->tripWorkflowService->approve($trip);
            } elseif ($status == Trip::getStatuses()['rejected']) {
                if (!$this->tripWorkflowService->canUserRejectTrip($trip)) {
                    $message = 'User does not have the permission to perform this action !';
                    Session::flash('error', $message);
                    throw  new Exception($message);
                }
                $trip->update(['status' => Trip::getStatuses()[$status]]);
            } elseif ($status == Trip::getStatuses()['completed']) {
                $trip->update(['status' => Trip::getStatuses()[$status]]);
            } else {
                $trip->update(['status' => Trip::getStatuses()[$status]]);
            }
            $this->vehicleService->changeStatusByTripStatus($trip, $status);
            DB::commit();
            return $trip;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('VMS Trip Status Error: ' . $exception->getMessage() . ' : ' . $exception->getTraceAsString());
            return false;
        }
    }

    /**
     * @param array $data
     * {
     * vehicles: {
     *               1: {
     *                   selected: "on",
     *                   vehicle_id: "1"
     *               },
     *               2: {
     *                     vehicle_id: "2"
     *               }
     *          }
     *   }
     */
    public function getSelectedVehicles(array $data)
    {
        $selectedVehicles = collect();
        foreach ($data['vehicles'] as $vehicle) {
            if (isset($vehicle['selected'])) {
                $selectedVehicles[] = $vehicle['vehicle_id'];
            }
        }
        return $selectedVehicles;
    }

    public function getTripsForBilling()
    {
        $trips = $this->actionRepository->getTripsForBilling();
        $roles = config('vms.trip.workflow.reject_privilege');
        $user = auth()->user();
        if ($user->hasAnyRole($roles)) {
            return $trips;
        }
        $authEmployee = $user->employee;
        if (is_null($authEmployee)) {
            return collect();
        }

        return $trips->filter(function ($trip) use ($authEmployee) {
            $employee = $trip->requester;
            if ($employee->id == $authEmployee->id) {
                return true;
            }
            return false;
        });
    }

    /**
     * @param array $data [contains all the project ID]
     * @return mixed
     */
    public function getExpenseForProjects(array $data)
    {
        $trips = $this->actionRepository->getTripsByProjectId($data);
        $tripExpenses = $this->tripBillPaymentService
            ->getTripExpenseByProject($trips->pluck('id')->toArray());
        $formattedArray = [];
        $projectExpenseArray = [];
        foreach ($tripExpenses as $expense) {
            $formattedArray[$expense->trip_id] = $expense->total;
        }
        // format the final array
        foreach ($trips as $data) {
            if (isset($projectExpenseArray[$data->project_id])) {
                $projectExpenseArray[$data->project_id] += $formattedArray[$data->id];
            } else {
                $projectExpenseArray[$data->project_id] = $formattedArray[$data->id];
            }
        }
        return $projectExpenseArray;
    }

    public function getRecentTripsOfRequester(Trip $trip)
    {
        return $this->actionRepository->getRecentTripsOfRequester($trip->requester_id);
    }

    public function calculatePendingTripAmountOfEmployee(Employee $employee, Carbon $date): array
    {
        $completedTrips = $this->actionRepository->getCompletedTripOfEmployeeByMonth($employee, $date);
        $totalBill = 0;
        $masterData = [];
        $data = [];
        foreach ($completedTrips as $completedTrip) {
            if ($completedTrip->tripBillPayment) {
                // we do not need bills that are already submitted of that month
                continue;
            }
            $data['trip_id'] = $completedTrip->id;
            $data['trip_bill'] = $this->tripBillService->calculateBillForTrip($completedTrip)->total;
            $masterData[] = $data;
            $totalBill += $data['trip_bill'];
        }
        $masterData['details'] = $masterData;
        $masterData['pending_trip_bill'] = $totalBill;
        return $masterData;
    }

    public function getExpiredTripsNow()
    {
        $threshHold = Carbon::now();
        return $this->actionRepository->getExpiredTrips($threshHold);
    }

    /**
     * Line Manger, Dirtor General , Director Admin Can View All The Trips
     * General User Will Only View Their Trip
     * @return Collection
     */
    public function getFilteredTrips()
    {
        $trips = $this->findAll(null, ['requester'], ['column' => 'created_at', 'direction' => 'desc']);

    }

    public function getTripsFilteredForIndex(array $data = [])
    {
        if (empty($data)) {
            $trips = $this->actionRepository->findAll(null, null, ['column' => 'created_at', 'direction' => 'desc']);
        } else {
            $trips = $this->actionRepository->getTripsFilteredForIndex($data);
        }
        $roles = config('vms.trip.workflow.reject_privilege');
        $user = auth()->user();
        if ($user->hasAnyRole($roles)) {
            return $trips;
        }
        $authEmployee = $user->employee;
        if (is_null($authEmployee)) {
            return collect();
        }

        return $trips->filter(function ($trip) use ($authEmployee) {
            $employee = $trip->requester;
            if ($employee->id == $authEmployee->id) {
                return true;
            }
            return false;
        });
    }

    public function getTripStatusesForDropdown()
    {
        if (app()->isLocale('bn')) {
            return trans('vms::trip.status', [], 'bn');
        }
        return trans('vms::trip.status', [], 'en');
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
                'from_user_id' => auth()->user()->id,
                'to_user_id' => $toUser->id,
                'message' => $message,
                'item_url' => route('vms.trip.index')
            ]);
        }
    }

    public function allocateVehicles(Trip $trip, Vehicle $vehicle)
    {
        $alreadyBooked = $this->isVehicleAlreadyAllocated($trip, $vehicle);
        if ($alreadyBooked) {

            return false;
        }
        $trip->vehicles()->attach($vehicle);
        return $trip;
    }

    /**
     * Check if the vehicle is already allocated within the given time of Trip
     * @param Trip $trip
     * @param Vehicle $vehicle
     */
    public function isVehicleAlreadyAllocated(Trip $trip, Vehicle $vehicle)
    {
        $overLappedTrips = $this->actionRepository->getOverlappedTripsForVehicle($trip, $vehicle);
        if ($overLappedTrips->count()) {
            $overLappedTrip = $overLappedTrips->first();
            Session::flash('error', trans('vms::trip.flash_messages.vehicle_already_allocated_time_error',
                [
                    'start' => Carbon::parse($overLappedTrip->start_date_time)->format('d F,Y g:i A'),
                    'end' => Carbon::parse($overLappedTrip->end_date_time)->format('d F,Y g:i A')
                ]));
            return true;
        }
        return false;
    }
    //------------------------------------------------------------------------
    //                             Private Function
    //------------------------------------------------------------------------

    private function saveTripData(array $tripArray)
    {
        $authEmployeeId = $this->getAuthEmployeeId();
        $tripArray['requester_id'] = $authEmployeeId;
        $tripArray['trip_calculation_setting_id'] = $this->tripCalculationSettingService->getActiveSettingForTrip(Employee::find($authEmployeeId))->id;
        return $this->save($tripArray);
    }

    private function getAuthEmployeeId()
    {
        $authUser = auth()->user();
        if (is_null($authUser->employee)) {
            throw  new Exception('Employee Not Found For ' . $authUser->name);
        }
        return optional($authUser->employee)->id;
    }

    private function savePassengerInformation(Trip $trip, array $data)
    {
        $authEmployeeId = $this->getAuthEmployeeId();
        if (isset($data['is_requester_information'])) {
            $data['passengers'][] = $authEmployeeId;
        }
        foreach ($data['passengers'] as $passengerId) {
            EmployeeTrip::create(['trip_id' => $trip->id, 'employee_id' => $passengerId]);
        }
    }

    private function saveVehicleInformation(Trip $trip, array $data)
    {
        foreach ($data['vehicles'] as $vehicleId) {
            TripVehicle::create(['trip_id' => $trip->id, 'vehicle_id' => $vehicleId]);
        }
    }
}

