<?php

namespace Modules\IMS\Http\Controllers\InventoryLocation;


use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\HRM\Services\DepartmentService;
use Modules\HRM\Services\EmployeeService;
use Modules\IMS\Entities\InventoryLocation;
use Modules\IMS\Services\InventoryLocationService;
use Modules\HRM\Services\SectionService;


class InventoryLocationController extends Controller
{
    /**
     * @var DepartmentService
     */
    private $departmentService;
    /**
     * @var InventoryLocationService
     */
    private $locationService;
    /**
     * @var InventoryLocationService
     */
    private $inventoryLocationService;
    /**
     * @var $employeeService
     */
    private $employeeService;

    public function __construct(
        DepartmentService $departmentService,
        EmployeeService $employeeService,
        InventoryLocationService $inventoryLocationService,
        SectionService $sectionService
    ) {
        $this->departmentService = $departmentService;
        $this->sectionService = $sectionService;
        $this->inventoryLocationService = $inventoryLocationService;
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $departmentCode = get_user_department()->department_code;
        $inventoryLocations = $this->inventoryLocationService->filterLocationByDepartment($departmentCode);
//       dd($inventoryLocations[0]->section);
        return view('ims::inventory_location.index', compact('inventoryLocations', 'departmentCode'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $departments = $this->departmentService->getDepartmentsForDropdown();
        $employees = $this->employeeService->getEmployeesForDropdown();
        $sections=$this->sectionService->getSectionForDropdown();
        return view('ims::inventory_location.create', compact('departments', 'employees','sections'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->inventoryLocationService->store($request->all());
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('inventory-locations.index');
    }

    /**
     * Show the specified resource.
     * @param InventoryLocation $location
     * @return Response
     */
    public function show(InventoryLocation $location)
    {
        $itemLists = $location->inventories;
        return view('ims::inventory_location.show', compact('location', 'itemLists'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param InventoryLocation $location
     * @return Factory|Application|Response|View
     */
    public function edit(InventoryLocation $location)
    {
        $departments = $this->departmentService->getDepartmentsForDropdown();
        $employees = $this->employeeService->getEmployeesForDropdown();
        $sections=$this->sectionService->getSectionForDropdown();
        return view('ims::inventory_location.edit', compact('location', 'departments', 'employees','sections'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, InventoryLocation $location)
    {
//        dd($request->all());
        $this->inventoryLocationService->updateLocation($location, $request->all());
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('inventory-locations.index');
    }


}
