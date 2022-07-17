<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Http\Requests\StoreUpdateSectionRequest;
use Modules\HRM\Repositories\DepartmentRepository;
use Modules\HRM\Repositories\SectionRepository;
use Modules\HRM\Services\EmployeeService;
use Modules\HRM\Services\SectionService;

class SectionController extends Controller
{
    private $sectionRepository;
    private $sectionService;
    private $departmentRepository;
    private $employeeService;

    public function __construct(
        SectionRepository $sectionRepository,
        SectionService $sectionService,
        EmployeeService $employeeService,
        DepartmentRepository $departmentRepository
    )
    {
        $this->sectionRepository = $sectionRepository;
        $this->sectionService = $sectionService;
        $this->departmentRepository = $departmentRepository;
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $sections = $this->sectionRepository->findAll();
        return view('hrm::section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $departments = $this->departmentRepository->findAll();
        $employees = $this->employeeService->getEmployeesForDropdown();
        return view('hrm::section.create', compact('employees', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreUpdateSectionRequest $request
     * @return Response
     */
    public function store(StoreUpdateSectionRequest $request)
    {
        if ($this->sectionService->storeSection($request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect(route('sections.index'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $section = $this->sectionRepository->findOne($id);
        $sectionHead = $section->head;
        return view('hrm::section.show', compact('section', 'sectionHead'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $departments = $this->departmentRepository->findAll();
        $employees = $this->employeeService->getEmployeesForDropdown();
        $section = $this->sectionRepository->findOne($id);
        return view('hrm::section.edit', compact('departments', 'employees', 'section'));
    }

    /**
     * Update the specified resource in storage.
     * @param StoreUpdateSectionRequest $request
     * @param int $id
     * @return Response
     */
    public function update(StoreUpdateSectionRequest $request, $id)
    {
        if ($this->sectionService->updateSection($request->all(), $id)) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }
        return redirect(route('sections.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        if ($this->sectionRepository->delete($this->sectionRepository->findOrFail($id))) {
            Session::flash('error', trans('labels.delete_success'));
        } else {
            Session::flash('error', trans('labels.delete_fail'));
        }
        return redirect(route('sections.index'));
    }

    public function getAllByDeptId($deptId)
    {
        return $this->sectionRepository->findBy(['department_id' => $deptId]);
    }

}
