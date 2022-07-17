<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\VMS\Entities\Trip;
use Modules\VMS\Services\TripWorkflowService;

class TripWorkflowController extends Controller
{
    /**
     * @var TripWorkflowService
     */
    private $tripWorkflowService;

    public function __construct(TripWorkflowService $tripWorkflowService)
    {
        $this->tripWorkflowService = $tripWorkflowService;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param Trip $trip
     * @return Factory|Application|View
     */
    public function show(Trip $trip)
    {
        $vehicles = $this->tripWorkflowService->getAllAvailableVehicles();
        $vehicleTypes = $this->tripWorkflowService->getVehicleTypesForSelection();
        $requestedVehicleTypeId = $trip->vehicle_type_id ?? null;
        $shouldShowApproveRejectButton = $this->tripWorkflowService->shouldShowApproveRejectButton($trip);
        $shouldShowVehicleSelection = $this->tripWorkflowService->shouldShowVehicleSelection($trip);
        $recentTrips = $this->tripWorkflowService->getRecentTripsOfRequester($trip);
        $hasRequesterCrossedLimits = $this->tripWorkflowService->hasRequesterCrossedTripLimits($trip);
        $userMaxTripLimit = $this->tripWorkflowService->getRequesterMaxTripLimits($trip);
        $statusCssArray = $this->tripWorkflowService->getStatusClassArray();
        $assignedVehicles = $trip->vehicles->pluck('id')->toArray();
        return view('vms::trip.workflow.show',
            compact('trip',
                'vehicles',
                'shouldShowVehicleSelection',
                'vehicles',
                'requestedVehicleTypeId',
                'vehicleTypes',
                'statusCssArray',
                'shouldShowApproveRejectButton',
                'recentTrips',
                'userMaxTripLimit',
                'assignedVehicles',
                'hasRequesterCrossedLimits'));
    }


    public function approve(Trip $trip)
    {
        if ($this->tripWorkflowService->approve($trip)) {
            return redirect()->route('vms.trip.create')->with('success', trans('labels.approved'));
        } else {
            return redirect()->route('vms.trip.create')->with('error', trans('labels.generic_error_message'));
        }
    }

    public function reject(Trip $trip)
    {
        return $trip;
    }
}
