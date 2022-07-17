<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\VMS\Entities\Vehicle;
use Modules\VMS\Http\Requests\VehicleRequest;
use Modules\VMS\Services\VehicleService;
use Modules\VMS\Services\VehicleTypeService;

class VehicleController extends Controller
{
    /**
     * @var VehicleService
     */
    private $vehicleService;

    private $vehicleTypeService;

    public function __construct(VehicleTypeService $vehicleTypeService, VehicleService $vehicleService)
    {
        $this->vehicleTypeService = $vehicleTypeService;
        $this->vehicleService = $vehicleService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $vehicles = $this->vehicleService->findAll();
        return view('vms::vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|View
     */
    public function create()
    {
        $vehicleTypes = $this->vehicleTypeService->getVehicleTypesForDropdown();
        $fuelTypes = $this->vehicleService->getFuelTypesForDropdown();
        $this->vehicleService->clearSessionValues();
        return view('vms::vehicle.create', compact('vehicleTypes', 'fuelTypes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param VehicleRequest $request
     * @return RedirectResponse
     */
    public function store(VehicleRequest $request)
    {
        if ($this->vehicleService->store($request->all())) {
            return redirect()
                ->route('vms.vehicles.index')
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect()
                ->route('vms.vehicles.index')
                ->with('error', trans('labels.save_fail'));
        }
    }

    /**
     * Show the specified resource.
     * @param Vehicle $vehicle
     * @return Factory|Application|View
     */
    public function show(Vehicle $vehicle)
    {
        return view('vms::vehicle.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Vehicle $vehicle
     * @return Factory|Application|View
     */
    public function edit(Vehicle $vehicle)
    {
        $this->vehicleService->setSessionValues($vehicle);
        $vehicleTypes = $this->vehicleTypeService->getVehicleTypesForDropdown();
        $fuelTypes = $this->vehicleService->getFuelTypesForDropdown();
        return view('vms::vehicle.edit', compact('vehicle', 'vehicleTypes', 'fuelTypes'));
    }

    /**
     * Update the specified resource in storage.
     * @param VehicleRequest $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        if ($this->vehicleService->updateData($request->all(), $vehicle)) {
            return redirect()
                ->route('vms.vehicles.index')
                ->with('success', trans('labels.update_success'));
        } else {
            return redirect()
                ->route('vms.vehicles.index')
                ->with('error', trans('labels.update_fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus(Vehicle $vehicle, $status)
    {
        if ($vehicle = $this->vehicleService->changeStatus($vehicle, $status)) {
            Session::flash('success', trans('labels.update_success'));
            return redirect()->route('vms.vehicles.index');
        } else {
            Session::flash('error', trans('labels.update_fail'));
            return redirect()->route('vms.vehicles.index');
        }
    }
}
