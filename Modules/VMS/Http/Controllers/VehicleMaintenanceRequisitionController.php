<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\VMS\Services\VehicleMaintenanceRequisitionService;
use Modules\VMS\Services\VehicleDriverAssignService;
use Modules\VMS\Services\VehicleMaintenanceItemService;
use Modules\VMS\Services\RequisitionWorkFlowService;
use Modules\VMS\Http\Requests\VehicleMaintenanceRequisitionRequest;
use Modules\VMS\Entities\VehicleMaintenanceRequisition;
use Auth;

class VehicleMaintenanceRequisitionController extends Controller
{
    /**
     * @var VehicleMaintenanceRequisitionService
     * @var VehicleDriverAssignService
     * @var VehicleMaintenanceItemService
     * @var RequisitionWorkFlowService
     */
        private $vehicleMaintenanceRequisitionService;
        private $vehicleDriverAssignService;
        private $vehicleMaintenanceItemService;
        private $requisitionWorkFlowService;

    /**
     * VehicleMaintenanceRequisitionController constructor.
     * @param VehicleMaintenanceRequisitionService $vehicleMaintenanceRequisitionService
     * @param VehicleDriverAssignService $vehicleDriverAssignService
     * @param VehicleMaintenanceItemService $vehicleMaintenanceItemService
     * @param RequisitionWorkFlowService $requisitionWorkFlowService
     */
    public function __construct(
        VehicleMaintenanceRequisitionService $vehicleMaintenanceRequisitionService,
        VehicleDriverAssignService $vehicleDriverAssignService,
        VehicleMaintenanceItemService $vehicleMaintenanceItemService,
        RequisitionWorkFlowService $requisitionWorkFlowService
    )
    {
        $this->vehicleMaintenanceRequisitionService = $vehicleMaintenanceRequisitionService;
        $this->vehicleDriverAssignService = $vehicleDriverAssignService;
        $this->vehicleMaintenanceItemService = $vehicleMaintenanceItemService;
        $this->requisitionWorkFlowService = $requisitionWorkFlowService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $requisition = $this->vehicleMaintenanceRequisitionService->findAll(null, null,
            ['direction' => 'desc', 'column' => 'created_at']);
        $statusCssArray=$this->vehicleMaintenanceRequisitionService->getStatusClassArray();
        return view('vms::requisition.index', compact('requisition','statusCssArray'));
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = 'create';
        $vehiclesForDropdown = $this->vehicleMaintenanceRequisitionService->getVehiclesForDropdown();
        $driversForDropdown = $this->vehicleDriverAssignService->getDriversForDropdown();
        $requisitionNumber = $this->vehicleMaintenanceRequisitionService->getNextSerialNumber();
        $maintenanceItemForDropdown = $this->vehicleMaintenanceItemService->getMaintenanceItemsForDropdown();
        return view('vms::requisition.create', compact('page', 'vehiclesForDropdown', 'driversForDropdown', 'requisitionNumber', 'maintenanceItemForDropdown'));
    }

    /**
     * Store a newly created resource in storage.
     * @param VehicleMaintenanceRequisitionRequest $request
     * @return Response
     */
    public function store(VehicleMaintenanceRequisitionRequest $request)
    {
        $data = $request->all();
        $save = $this->vehicleMaintenanceRequisitionService->store($data);
        if ($save == true) {
            return redirect()->route('vms.requisition.index')->with('success', __('labels.save_success'));
        } else {
            return redirect()->route('vms.requisition.index')->with('warning', __('labels.save_fail'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $page = 'edit';
        $requisition = $this->vehicleMaintenanceRequisitionService->findOne($id);
        $requisitionItem = $this->vehicleMaintenanceRequisitionService->requisitionItemDetails($id);
        $shouldShowApproveRejectButton = $this->requisitionWorkFlowService->shouldShowApproveRejectButton($requisition);
        return view('vms::requisition.show', compact('page','requisition','requisitionItem','shouldShowApproveRejectButton'));
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
        $data=$request->all();
        $data['requisition_id']=$id;
        $result = $this->vehicleMaintenanceRequisitionService->updateItemPrice($data);
        if($result==true){
            //TODO:: add work flow
            $status=VehicleMaintenanceRequisition::getStatuses()['approved'];
            return redirect()->route('vms.requisition.change-status',[$id,$status]);
        } else {
            return redirect()->route('vms.requisition.index')->with('warning', __('labels.update_fail'));
        }
    }

}
