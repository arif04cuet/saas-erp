<?php

namespace Modules\VMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\PMS\Services\ProjectService;
use Modules\TMS\Services\TrainingsService;
use Modules\VMS\Entities\Driver;
use Modules\VMS\Entities\Trip;
use Modules\VMS\Entities\Vehicle;
use Modules\VMS\Entities\VehicleType;
use Modules\VMS\Services\TripService;
use Modules\VMS\Services\VehicleService;
use Modules\VMS\Services\VehicleTypeService;
use Request as HttpRequest;

class TripController extends Controller
{
    /**
     * @var TripService
     */
    private $tripService;

    /**
     * @var VehicleService
     */
    private $vehicleService;
    /**
     * @var VehicleTypeService
     */
    private $vehicleTypeService;
    /**
     * @var TrainingsService
     */
    private $trainingService;
    /**
     * @var ProjectService
     */
    private $projectService;

    public function __construct(
        TripService $tripService,
        VehicleService $vehicleService,
        TrainingsService $trainingService,
        ProjectService $projectService,
        VehicleTypeService $vehicleTypeService
    ) {
        $this->tripService = $tripService;
        $this->vehicleService = $vehicleService;
        $this->trainingService = $trainingService;
        $this->projectService = $projectService;
        $this->vehicleTypeService = $vehicleTypeService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|View
     */
    public function index()
    {
        $trips = $this->tripService->getTripsFilteredForIndex();
        $statusCssArray = $this->tripService->getStatusClassArray();
        $tripStatuses = $this->tripService->getTripStatusesForDropdown();
        $method = 'get';
        $isPrivilegedUser = $this->tripService->isUserStartPrivileged();
        return view('vms::trip.index', compact(
            'trips',
            'method',
            'statusCssArray',
            'tripStatuses',
            'isPrivilegedUser'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|RedirectResponse|View
     */
    public function create()
    {
        try {
            $employees = $this->tripService->getEmployeesForDropdown();
            $defaultBilledTo = auth()->user()->employee ? auth()->user()->employee->id : null;
            $reasons = array_keys(config('vms.trip.reason'));
            $distanceOptions = config('vms.trip.distance');
            $trainings = $this->trainingService->getTrainingsForDropdown();
            $projects = $this->projectService->getProjectsForDropdown();
            $vehicleTypes = $this->vehicleTypeService->getVehicleTypesForDropdown();
            return view('vms::trip.create',
                compact(
                    'distanceOptions',
                    'employees',
                    'defaultBilledTo',
                    'reasons',
                    'vehicleTypes',
                    'trainings',
                    'projects'));
        } catch (\Exception $e) {
            Log::error("Trip Creation Error: " . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            Session::flash('error', $e->getMessage());
            return redirect()->route('vms.trip.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->tripService->store($request->all())) {
            $message = trans('labels.save_success');
            if (Session::has('success')) {
                $message = Session::get('success');
            }
            return redirect()->route('vms.trip.create')->with('success', $message);
        } else {
            $message = trans('labels.save_success');
            if (Session::has('error')) {
                $message = Session::get('error');
            }
            return redirect()->route('vms.trip.create')->with('error', $message);
        }
    }

    public function edit(Trip $trip)
    {
        // not implemented yet
        return $trip;
    }

    public function update(Request $request, Trip $trip)
    {
        $trip = $this->tripService->update($trip, $request->all());
        if ($trip) {
            return redirect()
                ->route('vms.trip.index')
                ->with('success', trans('labels.update_success'));
        } else {
            return redirect()
                ->route('vms.trip.index')
                ->with('error', trans('labels.update_fail'));
        }
    }

    public function show(Trip $trip)
    {
        return view('vms::trip.show', compact('trip'));
    }

    public function print(Trip $trip)
    {
        return \view('vms::trip.partial.trip-print', compact('trip'));
    }

    public function changeStatus(Trip $trip, $status)
    {
        if ($this->tripService->changeStatus($trip, $status)) {
            $message = trans('labels.save_success');
            if (Session::has('success')) {
                $message = Session::get('success');
            }
            return redirect()->route('vms.trip.index')->with('success', $message);
        } else {
            $message = trans('labels.save_fail');
            if (Session::has('error')) {
                $message = Session::get('error');
            }
            return redirect()->route('vms')->with('error', $message);
        }
    }

    public function updateViaAjax(Request $request, Trip $trip)
    {
        $trip = $this->tripService->update($trip, $request->all());
        if ($trip) {
            $message = trans('vms::trip.notification_messages.update_trip_message');
            $this->tripService->sendTripNotification($trip, optional($trip->requester)->user ?? null, $message);
            return $trip;
        } else {
            return false;
        }
    }

    public function load(Request $request)
    {
        $trips = $this->tripService->getTripsFilteredForIndex($request->all());
        $startDateTime = Carbon::parse($request['start_date_time'])->format('Y-m-d') ?? null;
        $endDateTime = Carbon::parse($request['end_date_time'])->format('Y-m-d') ?? null;
        $method = $request->getMethod();
        $statusCssArray = $this->tripService->getStatusClassArray();
        $tripStatuses = $this->tripService->getTripStatusesForDropdown();
        $isPrivilegedUser = $this->tripService->isUserStartPrivileged();
        return view('vms::trip.index', compact(
            'trips',
            'startDateTime',
            'endDateTime',
            'method',
            'statusCssArray',
            'tripStatuses',
            'isPrivilegedUser'));
    }

    public function allocateVehicle(Trip $trip, Vehicle $vehicle)
    {

        if ($this->tripService->allocateVehicles($trip, $vehicle)) {
            $message = trans('labels.save_success');
            if (Session::has('success')) {
                $message = Session::get('success');
            }
            return redirect()->route('vms.trip.workflow.show', $trip)->with('success', $message);
        } else {
            $message = trans('labels.save_fail');
            if (Session::has('error')) {
                $message = Session::get('error');
            }
            return redirect()->route('vms.trip.workflow.show', $trip)->with('error', $message);
        }
    }

    public function removeVehicle(Trip $trip, Vehicle $vehicle)
    {
        $trip->vehicles()->detach($vehicle);
        return redirect()->back();
    }
}
