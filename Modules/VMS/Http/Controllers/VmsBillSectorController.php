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
use Modules\HRM\Services\EmployeeService;
use Modules\VMS\Entities\VmsBillSector;
use Modules\VMS\Http\Requests\VmsBillSectorRequest;
use Modules\VMS\Services\VmsBillSectorService;

class VmsBillSectorController extends Controller
{
    /**
     * @var VmsBillSectorService
     */
    private $vmsBillSectorService;
    /**
     * @var EmployeeService
     */
    private $employeeService;

    public function __construct(VmsBillSectorService $vmsBillSectorService, EmployeeService $employeeService)
    {
        $this->vmsBillSectorService = $vmsBillSectorService;
        $this->employeeService = $employeeService;
    }


    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $vmsBillSectors = $this->vmsBillSectorService->findAll(null, null,
            ['column' => 'created_at', 'direction' => 'desc']);
        return view('vms::bill-sector.index', compact('vmsBillSectors'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $this->vmsBillSectorService->clearOldSessionValues();
        return view('vms::bill-sector.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param VmsBillSectorRequest $request
     * @return RedirectResponse
     */
    public function store(VmsBillSectorRequest $request): RedirectResponse
    {
        if ($this->vmsBillSectorService->save($request->all())) {
            return redirect()
                ->route('vms.bill-sector.index')
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect()
                ->route('vms.bill-sector.index')
                ->with('error', trans('labels.save_fail'));
        }
    }

    /**
     * Show the specified resource.
     * @param VmsBillSector $vmsBillSector
     * @return Factory|Application|Response|View
     */
    public function show(VmsBillSector $vmsBillSector)
    {
        $employees = $this->employeeService->findAll();
        $employees = $this->employeeService->getEmployeesSortedByDesignationAndServicePeriod($employees);
        $assignedEmployees = $vmsBillSector->vmsBillSectorAssigns->pluck('employee_id')->toArray();
        return view('vms::bill-sector.show', compact('vmsBillSector', 'employees', 'assignedEmployees'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param VmsBillSector $vmsBillSector
     * @return Factory|Application|Response|View
     */
    public function edit(VmsBillSector $vmsBillSector)
    {
        $this->vmsBillSectorService->setOldSessionValues($vmsBillSector);
        return view('vms::bill-sector.edit', compact('vmsBillSector'));
    }

    /**
     * Update the specified resource in storage.
     * @param VmsBillSectorRequest $request
     * @param VmsBillSector $vmsBillSector
     * @return RedirectResponse
     */
    public function update(VmsBillSectorRequest $request, VmsBillSector $vmsBillSector)
    {
        if ($this->vmsBillSectorService->update($vmsBillSector, $request->all())) {
            return redirect()
                ->route('vms.bill-sector.index')
                ->with('success', trans('labels.update_success'));
        } else {
            return redirect()
                ->route('vms.bill-sector.index')
                ->with('error', trans('labels.update_fail'));
        }
    }

}
