<?php

namespace Modules\IMS\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\Department;
use Modules\HRM\Services\DepartmentService;
use Modules\IMS\Entities\Warehouse;
use Modules\IMS\Http\Requests\CreateWarehouseRequest;
use Modules\IMS\Services\WarehouseService;

class WarehouseController extends Controller
{

    /**
     * @var DepartmentService
     */
    private $departmentService;
    /**
     * @var WarehouseService
     */
    private $warehouseService;

    public function __construct(DepartmentService $departmentService, WarehouseService $warehouseService)
    {
        /** @var DepartmentService $departmentService */
        $this->departmentService = $departmentService;
        /** @var WarehouseService $warehouseService */
        $this->warehouseService = $warehouseService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $warehouses = $this->warehouseService->getAllWarehouses();
        return view('ims::warehouse.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $departments  = $this->departmentService->getDepartmentsForDropdown();
        return view('ims::warehouse.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateWarehouseRequest $request)
    {
        $this->warehouseService->store($request->all());
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('inventory.warehouse.list');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Warehouse $warehouse)
    {
        return view('ims::warehouse.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Warehouse $warehouse)
    {
        $departments = $this->departmentService->getDepartmentsForDropdown();
        return view('ims::warehouse.edit', compact('warehouse','departments'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $this->warehouseService->updateWarehouse($warehouse, $request->all());
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('inventory.warehouse.list');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
