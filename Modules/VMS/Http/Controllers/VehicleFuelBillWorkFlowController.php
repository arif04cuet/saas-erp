<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\VMS\Entities\VehicleFuelBillSubmit;
use Modules\VMS\Services\VehicleFuelBillWorkFlowService;
use Modules\VMS\Services\VehicleFuelBillSubmitService;
use Modules\VMS\Entities\VehicleFuelBillSubmit as FuelBill;

class VehicleFuelBillWorkFlowController extends Controller
{

    private $vehicleFuelBillWorkFlowService;
    private $vehicleFuelBillSubmitService;

    public function __construct(
        VehicleFuelBillWorkFlowService $vehicleFuelBillWorkFlowService,
        VehicleFuelBillSubmitService $vehicleFuelBillSubmitService
    )
    {
        $this->vehicleFuelBillWorkFlowService = $vehicleFuelBillWorkFlowService;
        $this->vehicleFuelBillSubmitService = $vehicleFuelBillSubmitService;
    }


    /**
     * @param FuelBill $vehicleFuelBillSubmit
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function show(VehicleFuelBillSubmit $vehicleFuelBillSubmit, $id)
    {

        $fuelBill = $this->vehicleFuelBillSubmitService->findOne($id);
        $shouldShowApproveRejectButton = $this->vehicleFuelBillWorkFlowService->shouldShowApproveRejectButton($fuelBill);
        return view('vms::fuelLogBook.bill.show', compact('fuelBill', 'shouldShowApproveRejectButton'));

    }

    /**
     * @param FuelBill $fuelBill
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(FuelBill $fuelBill, $status)
    {
        if ($this->vehicleFuelBillSubmitService->changeStatus($fuelBill, $status)) {
            return redirect()->route('vms.fuel.bill.index')->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('vms.fuel.bill.index')->with('error', trans('labels.save_fail'));
        }
    }

}
