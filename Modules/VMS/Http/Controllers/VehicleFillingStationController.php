<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\VMS\Http\Requests\FillingStationRequest;
use Modules\VMS\Services\VehicleFillingStationService;
use Modules\VMS\Services\VehicleFuelLogService;
use Modules\VMS\Entities\VehicleFillingStation;
use Session;

class VehicleFillingStationController extends Controller
{
    /**
     * @var $vehicleFillingStationService
     * @var $vehicleFuelLogService
     */
    private $vehicleFillingStationService;
    private $vehicleFuelLogService;

    /**
     * @param VehicleFillingStationService $vehicleFillingStationService
     * @param VehicleFuelLogService $vehicleFuelLogService
     */

    public function __construct(
        VehicleFillingStationService $vehicleFillingStationService,
        VehicleFuelLogService $vehicleFuelLogService
    )
    {
        $this->vehicleFillingStationService = $vehicleFillingStationService;
        $this->vehicleFuelLogService = $vehicleFuelLogService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $fillingStation = $this->vehicleFillingStationService->findAll();
        return view('vms::filling-station.index', compact('fillingStation'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = "create";
        return view('vms::filling-station.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param FillingStationRequest $request
     * @return Response
     */
    public function store(FillingStationRequest $request)
    {
        $this->vehicleFillingStationService->save($request->all());

        return redirect()->route('vms.fillingStation.index')->with('success', __('labels.save_success'));

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $company = $this->vehicleFillingStationService->findOne($id);

        return view('vms::filling-station.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $fillingStation = $this->vehicleFillingStationService->findBy(['id' => $id])->first();
        $page = "edit";

        return view('vms::filling-station.create', compact('fillingStation', 'page'));

    }

    /**
     * Update the specified resource in storage.
     * @param FillingStationRequest $request
     * @param int $id
     * @return Response
     */
    public function update(FillingStationRequest $request, $id)
    {
        $this->vehicleFillingStationService->findOrFail($id)->update($request->all());

        return redirect()->route('vms.fillingStation.index')->with('success', __('labels.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param $medicineCompany
     * @param $id
     * @return Response
     */
    public function destroy(VehicleFillingStation $vehicleFillingStation, $id)
    {


        $checkFillingStationAllReadyUse = $this->vehicleFuelLogService->findBy(['filling_station_id' => $id])->count();
        if ($checkFillingStationAllReadyUse < 1) {
            $vehicleFillingStation->destroy($id);
            Session::flash('warning', trans('labels.delete_success'));
        } else {
            Session::flash('warning', trans('vms::fuelLogBook.already_in_use'));
        }

        return redirect()->route('vms.fillingStation.index');
    }
}
