<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\VMS\Entities\VehicleMaintenanceRequisition;
use Modules\VMS\Services\VehicleMaintenanceRequisitionService;


class RequisitionWorkFlowController extends Controller
{
    private $vehicleMaintenanceRequisitionService;

    public function __construct(
        VehicleMaintenanceRequisitionService $vehicleMaintenanceRequisitionService
    )
    {
        $this->vehicleMaintenanceRequisitionService = $vehicleMaintenanceRequisitionService;
    }


    /**
     * @param VehicleMaintenanceRequisition $vmr
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(VehicleMaintenanceRequisition $vmr, $status)
    {

        if ($this->vehicleMaintenanceRequisitionService->changeStatus($vmr, $status)) {
            return redirect()->route('vms.requisition.index')->with('success', trans('labels.save_success'));
        } else {
            return redirect()->route('vms.requisition.index')->with('error', trans('labels.save_fail'));
        }
    }
}
