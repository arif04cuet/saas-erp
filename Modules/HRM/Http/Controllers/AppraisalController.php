<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\HM\Services\RoomTypeService;
use Modules\HRM\Entities\Appraisal;
use Modules\HRM\Http\Requests\StoreAppraisalRequest;
use Modules\HRM\Http\Requests\UpdateAppraisalRequest;
use Modules\HRM\Services\AppraisalService;
use Modules\HRM\Services\DepartmentService;
use Modules\HRM\Services\DesignationService;
use Modules\HRM\Services\EmployeeService;

class AppraisalController extends Controller
{

    /**
     * @var DesignationService
     */
    private $designationService;
    /**
     * @var AppraisalService
     */
    private $appraisalService;

    /**
     * @var AppraisalService
     */
    private $employeeService;
    /**
     * @var DepartmentService
     */
    private $departmentService;


    /**
     * AppraisalController constructor.
     * @param DesignationService $designationService
     * @param AppraisalService $appraisalService
     * @param EmployeeService $employeeService
     * @param DepartmentService $departmentService
     */
    public function __construct(
        DesignationService $designationService,
        AppraisalService $appraisalService,
        EmployeeService $employeeService,
        DepartmentService $departmentService
    ) {
        /** @var DesignationService $designationService */
        $this->designationService = $designationService;
        /** @var AppraisalService $appraisalService */
        $this->appraisalService = $appraisalService;
        /** @var EmployeeService $employeeService */
        $this->employeeService = $employeeService;
        /** @var DepartmentService $departmentService */
        $this->departmentService = $departmentService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $appraisals = $this->appraisalService->getAvailableAppraisals();

        return view('hrm::appraisal.index', compact('appraisals'));
    }

    /**
     * @param string $class
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($class = "first")
    {
        switch ($class) {
            case 'first':
                $medicalOfficer = $this->employeeService->getAvailableMedicalOfficers($class);
                $employee = Auth::user()->employee;
                return view('hrm::appraisal.create', compact('employee', 'class', 'medicalOfficer'));
                break;
            case 'second':
                $employees = $this->designationService->getClassEmployeeByRank(2);
                break;
            case 'third':
                $employees = $this->designationService->getClassEmployeeByRank(3);
                break;
            case 'fourth':
                $employees = $this->designationService->getClassEmployeeByRank(4);
                break;
            default:
                break;
        }

        if ($class == "second") {
            $appraisalContents = $this->appraisalService->getAppraisalContents("third");
        } else {
            $appraisalContents = $this->appraisalService->getAppraisalContents($class);
        }

        $reporter = Auth::user()->employee;
        $reporters = $employees;
        $availableSigners = $this->employeeService->getAvailableSigners($class);
        $departments = $this->departmentService->getDepartments();

        return view('hrm::appraisal.create', compact(
                'appraisalContents',
                'reporter',
                'class',
                'employees',
                'availableSigners',
                'reporters',
                'departments'
            )
        );
    }

    /**
     * @param StoreAppraisalRequest $storeAppraisalRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAppraisalRequest $storeAppraisalRequest)
    {
        if ($this->appraisalService->storeAppraisal($storeAppraisalRequest->all())) {
            Session::flash('success', trans('labels.save_success'));
            return redirect()->route('appraisals.index');
        } else {
            Session::flash('success', trans('labels.save_fail'));
            return redirect()->back();
        }

    }

    /**
     * @param Appraisal $appraisal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Appraisal $appraisal)
    {
        return view('hrm::appraisal.show', compact('appraisal'));
    }

    /**
     * @param Appraisal $appraisal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Appraisal $appraisal)
    {
        $departments = $this->departmentService->getDepartments();

        if ($appraisal->status == "verified") {
            $reporters = $this->appraisalService->getPossibleReporters($appraisal);
            return view('hrm::appraisal.edit', compact('appraisal', 'reporters', 'departments'));
        }

        $availableSigners = collect();
        if ($appraisal->status == "initialized" && $appraisal->stateHistory()->get()->last()->from == 'verified') {
            $availableSigners = $this->appraisalService->getPossibleSigners($appraisal);
        }

        $appraisalContents = $this->appraisalService->getAppraisalContents($appraisal->type);
        return view('hrm::appraisal.edit',
            compact('appraisal', 'appraisalContents', 'availableSigners', 'departments'));
    }

    /**
     * @param UpdateAppraisalRequest $updateAppraisalRequest
     * @param Appraisal $appraisal
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAppraisalRequest $updateAppraisalRequest, Appraisal $appraisal)
    {
        if ($this->appraisalService->updateAppraisal($appraisal, $updateAppraisalRequest->all())) {
            Session::flash('success', trans('labels.save_success'));
            return redirect()->route('appraisals.index');
        } else {
            Session::flash('success', trans('labels.save_success'));
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function retirement()
    {
        return view('hrm::appraisal.retirement_form');

    }

    public function getEmployeesByDepartmentId($departmentId)
    {
        $employees = $this->employeeService->getAllEmployeesByDepartmentId($departmentId);
        return $employees;
    }
}
