<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\VMS\Services\VehicleFillingStationService;
use Modules\VMS\Services\VehicleFuelBillSubmitService;
use Modules\VMS\Http\Requests\VehicleFuelBillSubmitRequest;

class VehicleFuelBillSubmitController extends Controller
{
    private $vehicleFillingStationService;
    private $vehicleFuelBillSubmitService;

    /**
     * @param VehicleFillingStationService $vehicleFillingStationService
     * @param VehicleFuelBillSubmitService $vehicleFuelBillSubmitService
     *
     */
    public function __construct(
        VehicleFillingStationService $vehicleFillingStationService,
        VehicleFuelBillSubmitService $vehicleFuelBillSubmitService
    ){
        $this->vehicleFillingStationService = $vehicleFillingStationService;
        $this->vehicleFuelBillSubmitService = $vehicleFuelBillSubmitService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        $page='index';
        $fuelBill = $this->vehicleFuelBillSubmitService->findAll(null, null, [
            'direction' => 'desc',
            'column' => 'created_at'
        ]);;
        return view('vms::fuelLogBook.bill.index', compact('page','fuelBill'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function create()
    {
        $page='create';
        $fillingStation = $this->vehicleFillingStationService->getFillingStationForDropdown();
        return view('vms::fuelLogBook.bill.form', compact('page','fillingStation'));
    }

    /**
     * @param VehicleFuelBillSubmitRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(VehicleFuelBillSubmitRequest $request)
    {
        $this->vehicleFuelBillSubmitService->store($request->all());

        return redirect()->route('vms.fuel.bill.index')->with('success', __('labels.save_success'));

    }

}
