<?php

namespace Modules\HRM\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Entities\EmployeeEducation;
use Modules\HRM\Services\AppraisalService;
use Modules\HRM\Services\EmployeeService;

class FirstClassAppraisalController extends Controller
{
    /**
     * @var EmployeeService
     */
    private $employeeService;
    /**
     * @var AppraisalService
     */
    private $appraisalService;

    public function __construct(EmployeeService $employeeService, AppraisalService $appraisalService)
    {
        /** @var EmployeeService $employeeService */
        $this->employeeService = $employeeService;
        /** @var AppraisalService $appraisalService */
        $this->appraisalService = $appraisalService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('hrm::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $employee = Employee::findOrFail(Auth::user()->id);
        $employeeTrainingInfos = $employee->employeeTrainingInfo;
        $employeeEducationInfos = $employee->employeeEducationInfo;
        $employeePublicationInfos = $employee->employeePublicationInfo;
        $employeeResearchInfos = $employee->employeeResearchInfo;
        $reporters = $this->employeeService->getEmployeesAsReporters();
        $appraisalContents  = $this->appraisalService->getAppraisalContents();

        return view('hrm::appraisal.first-class.create', compact(
                'employee',
                'reporters',
                'employeeEducationInfos',
                'employeeTrainingInfos',
                'employeePublicationInfos',
                'employeeResearchInfos',
                'appraisalContents'
            ));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('hrm::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('hrm::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
