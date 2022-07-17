<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\VMS\Http\Requests\VehicleMaintenanceItemRequest;
use Modules\VMS\Services\VehicleMaintenanceItemService;
use Modules\VMS\Entities\VehicleMaintenanceItem;
use Session;
use Auth;

class VehicleMaintenanceItemController extends Controller
{

    /**
     * @var $vehicleMaintenanceItemService
     */
    private $vehicleMaintenanceItemService;

    /**
     * VehicleMaintenanceItemController constructor.
     * @param VehicleMaintenanceItemService $vehicleMaintenanceItemService
     */
    public function __construct(VehicleMaintenanceItemService $vehicleMaintenanceItemService)
    {
        $this->vehicleMaintenanceItemService = $vehicleMaintenanceItemService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $page = 'index';
        $itemList = $this->vehicleMaintenanceItemService->findAll(null, null, ['column' => 'created_at', 'direction' => 'desc']);
        return view('vms::maintenanceItem.index', compact('page', 'itemList'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = 'create';
        return view('vms::maintenanceItem.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param VehicleMaintenanceItemRequest $request
     * @return Response
     */
    public function store(VehicleMaintenanceItemRequest $request)
    {
        $inputData = $request->all();
        if (empty($inputData['item_name_bn'])) {
            $inputData['item_name_bn'] = $inputData['item_name_en'];
        }
        $this->vehicleMaintenanceItemService->save($inputData);
        return redirect()->route('vms.maintenance.item.index')->with('success', __('labels.save_success'));

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $item = $this->vehicleMaintenanceItemService->findOne($id);
        $page = "show";
        return view('vms::maintenanceItem.show', compact('page', 'item'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $item = $this->vehicleMaintenanceItemService->findOne($id);
        $page = "edit";
        return view('vms::maintenanceItem.create', compact('page', 'item'));
    }

    /**
     * Update the specified resource in storage.
     * @param VehicleMaintenanceItemRequest $request
     * @param int $id
     * @return Response
     */
    public function update(VehicleMaintenanceItemRequest $request, $id)
    {
        $inputData = $request->all();
        $aa = $this->vehicleMaintenanceItemService->findOrFail($id)->update($inputData);
        return redirect()->route('vms.maintenance.item.index')->with('success', __('labels.update_success'));

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @param VehicleMaintenanceItem $vehicleMaintenanceItem
     * @return Response
     */
    public function destroy(VehicleMaintenanceItem $vehicleMaintenanceItem, $id)
    {
//        $vehicleMaintenanceItem->destroy($id);
        Session::flash('warning', trans('labels.delete_success'));
        return redirect()->route('vms.maintenance.item.index');
    }
}
