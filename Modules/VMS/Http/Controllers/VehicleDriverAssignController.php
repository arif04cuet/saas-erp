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
use Modules\VMS\Entities\Driver;
use Modules\VMS\Entities\Vehicle;
use Modules\VMS\Services\DriverService;
use Modules\VMS\Services\VehicleDriverAssignService;
use Modules\VMS\Services\VehicleService;

class VehicleDriverAssignController extends Controller
{
    /**
     * @var DriverService
     */
    private $driverService;
    /**
     * @var VehicleService
     */
    private $vehicleService;
    /**
     * @var VehicleDriverAssignService
     */
    private $vehicleDriverAssignService;

    public function __construct(VehicleDriverAssignService $vehicleDriverAssignService)
    {
        $this->vehicleDriverAssignService = $vehicleDriverAssignService;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('vms::index');
    }

    /**
     * Show the form for creating a new resource.
     * @param Vehicle|null $vehicle
     * @return Factory|Application|View
     */
    public function create(Vehicle $vehicle = null)
    {
        $vehiclesForDropdown = $this->vehicleDriverAssignService->getVehiclesForDropdown();
        $driversForDropdown = $this->vehicleDriverAssignService->getDriversForDropdown();
        return view('vms::vehicle.driver-assign.create',
            compact('vehicle', 'vehiclesForDropdown', 'driversForDropdown'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->vehicleDriverAssignService->store($request->all())) {
            return redirect()
                ->route('vms.vehicles.index')
                ->with('success', trans('labels.save_success'));
        } else {
            if (Session::has('duplicate')) {
                Session::flash('error', trans('vms::driver.flash_messages.duplicate'));
            } else {
                Session::flash('error', trans('labels.save_fail'));
            }
            return redirect()
                ->route('vms.vehicles.index');


        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('vms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('vms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request)
    {
        if ($this->vehicleDriverAssignService->deleteData($request->all())) {
            return redirect()
                ->route('vms.vehicles.show', $request->vehicle_id)
                ->with('success', trans('labels.delete_success'));
        } else {
            return redirect()
                ->route('vms.vehicles.show', $request->vehicle_id)
                ->with('error', trans('labels.delete_fail'));
        };
    }

    public function getVehicleInformation(Vehicle $vehicle)
    {
        return view('vms::vehicle.driver-assign.partial.vehicle-information', compact('vehicle'))->render();
    }
}
