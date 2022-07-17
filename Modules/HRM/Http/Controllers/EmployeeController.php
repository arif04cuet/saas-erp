<?php

namespace Modules\HRM\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Http\Requests\StoreUpdateEmployeeGeneralInfoRequest;
use Modules\HRM\Services\AcademicDegreeService;
use Modules\HRM\Services\AcademicDepartmentService;
use Modules\HRM\Services\AcademicInstituteService;
use Modules\HRM\Services\AreaOfInterestService;
use Modules\HRM\Services\DepartmentService;
use Modules\HRM\Services\DesignationService;
// use Modules\HRM\Services\EmployeeDepartmentService;
// use Modules\HRM\Services\EmployeeDesignationService;
use Modules\HRM\Services\EmployeeReligionService;
use Modules\HRM\Services\EmployeeService;
use Modules\HRM\Services\EmployeeSpouseChildrenService;
use Modules\HRM\Services\EmployeeTrainingService;
// use Modules\HRM\Services\InstituteService;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportEmployee;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    private $employeeService;
    private $departmentService;
    private $designationService;
    private $academicInstituteService;
    private $academicDepartmentService;
    private $academicDegreeService;
    private $employeeTrainingService;
    private $employeeSpouseChildrenService;
    private $employeeReligionService;
    private $areaOfInterestService;

    public function __construct(
        EmployeeService $employeeServices,
        DepartmentService $departmentService,
        DesignationService $designationService,
        AcademicInstituteService $academicInstituteService,
        AcademicDepartmentService $academicDepartmentService,
        AcademicDegreeService $academicDegreeService,
        EmployeeTrainingService $employeeTrainingService,
        EmployeeSpouseChildrenService $employeeSpouseChildrenService,
        EmployeeReligionService $employeeReligionService,
        AreaOfInterestService $areaOfInterestService
    ) {
        $this->employeeService = $employeeServices;
        $this->departmentService = $departmentService;
        $this->designationService = $designationService;
        $this->academicInstituteService = $academicInstituteService;
        $this->academicDepartmentService = $academicDepartmentService;
        $this->academicDegreeService = $academicDegreeService;
        $this->employeeTrainingService = $employeeTrainingService;
        $this->employeeSpouseChildrenService = $employeeSpouseChildrenService;
        $this->employeeReligionService = $employeeReligionService;
        $this->areaOfInterestService = $areaOfInterestService;
    }

    public function index()
    {
        $employeeList = $this->employeeService->getEmployeeList();
        $allDepartments = $this->departmentService->findSelected(array('name'));
        $designations = $this->designationService->findSelected(['name']);
        return view('hrm::employee.index', compact('employeeList', 'allDepartments', 'designations'));
    }

    public function create(Request $request)
    {
        $employeeDepartments = $this->departmentService->getDepartments();
        $employeeDesignations = $this->designationService->getEmployeeDesignations();
        $institutes = $this->academicInstituteService->getInstitutes();
        $academicDepartments = $this->academicDepartmentService->getAcademicDepartments();
        $academicDegree = $this->academicDegreeService->getAcademicDegree();
        $academicDurations = $this->academicInstituteService->getDegreeDuration();
        $employeeTitles = $this->employeeService->getEmployeeTitles();
        $employeeTrainingDuration = $this->employeeTrainingService->getTrainingDuration();
        $employeeSalaryScale = $this->employeeService->getEmployeeSalaryScale();
        $areaOfInterests = $this->areaOfInterestService->getInterestsForDropdown();
        $employeeReligions = $this->employeeReligionService->dropDown();
        $employee_id = isset($request->employee) ? $request->employee : '';
        $photoUrl = '';
        $sections = [];

        // dd($employeeDepartments,$employeeDesignations);

        return view('hrm::employee.create', compact(
                'employeeDepartments',
                'employeeDesignations',
                'employee_id', 'institutes',
                'academicDepartments',
                'academicDegree',
                'academicDurations',
                'employeeTitles',
                'employeeTrainingDuration',
                'employeeSalaryScale',
                'photoUrl',
                'sections',
                'employeeReligions',
                'areaOfInterests'
            )
        );
    }

    public function store(StoreUpdateEmployeeGeneralInfoRequest $request)
    {
        $response = $this->employeeService->storeGeneralInfo($request->all());
        Session::flash('message', $response->getContent());

        return redirect()->route('employee.edit', ['employee' => $response->getId(), '#personall']);
    }

    public function show($id)
    {
        $employee = $this->employeeService->findOne($id, [
            'employeePersonalInfo',
            'employeeEducationInfo',
            'employeeTrainingInfo',
            'employeePublicationInfo',
            'employeeResearchInfo',
            'employeeDepartment',
            'employeeInterestInfo'
        ]);

        $employeeSpouses = $this->employeeSpouseChildrenService->spouses($id);
        $employeeChildren = $this->employeeSpouseChildrenService->children($id);

        $currentPostDuration = null;

        if (!is_null(Arr::get($employee, 'employeePersonalInfo.current_position_joining_date'))) {
            $currentPostDuration = $this->dateDifference($employee->employeePersonalInfo->current_position_joining_date);
        }
        $photoUrl = (!empty($employee->photo)) ? 'employee-profile/' . $employee->photo : 'employee-profile/default.png';

        return view('hrm::employee.show',
            compact(
                'employee',
                'currentPostDuration',
                'photoUrl',
                'employeeSpouses',
                'employeeChildren'
            )
        );
    }

    public function edit($id)
    {
        $employeeDepartments = $this->departmentService->getDepartments();
        $employeeDesignations = $this->designationService->getEmployeeDesignations();
        $institutes = $this->academicInstituteService->getInstitutes();
        $academicDepartments = $this->academicDepartmentService->getAcademicDepartments();
        $academicDegree = $this->academicDegreeService->getAcademicDegree();
        $academicDurations = $this->academicInstituteService->getDegreeDuration();
        $employeeTitles = $this->employeeService->getEmployeeTitles();
        $employeeTrainingDuration = $this->employeeTrainingService->getTrainingDuration();
        $employeeSalaryScale = $this->employeeService->getEmployeeSalaryScale();
        $areaOfInterests = $this->areaOfInterestService->getInterestsForDropdown();
        
        $employee = $this->employeeService->findOne($id, [
            'employeePersonalInfo',
            'employeeEducationInfo',
            'employeeTrainingInfo',
            'employeePublicationInfo',
            'employeeResearchInfo',
            'employeeDepartment',
        ]);

        $employeeSpouses = $this->employeeSpouseChildrenService->spouses($id);
        $employeeChildren = $this->employeeSpouseChildrenService->children($id);

        $sections = $employee->employeeDepartment->sections->pluck('name', 'id')->toArray();


        if (!empty($employee->employeePersonalInfo->date_of_birth)) {
            $employee->employeePersonalInfo->date_of_birth = date('d F, Y',
                strtotime($employee->employeePersonalInfo->date_of_birth));
        }

        if (!empty($employee->employeePersonalInfo->current_position_joining_date)) {
            $employee->employeePersonalInfo->current_position_joining_date = date('d F, Y',
                strtotime($employee->employeePersonalInfo->current_position_joining_date));
        }

        if (!empty($employee->employeePersonalInfo->current_position_expire_date)) {
            $employee->employeePersonalInfo->current_position_expire_date = date('d F, Y',
                strtotime($employee->employeePersonalInfo->current_position_expire_date));
        }

        if (!empty($employee->employeePersonalInfo->job_joining_date)) {
            $employee->employeePersonalInfo->job_joining_date = date('d F, Y',
                strtotime($employee->employeePersonalInfo->job_joining_date));
        }

        if (!empty($employee->employeePersonalInfo->house_eligibility_date)) {
            $employee->employeePersonalInfo->house_eligibility_date = date('d F, Y',
                strtotime($employee->employeePersonalInfo->house_eligibility_date));
        }

        $photoUrl = (!empty($employee->photo)) ? 'employee-profile/' . $employee->photo : 'employee-profile/default.png';

        $employeeReligions = $this->employeeReligionService->dropDown();

        return view('hrm::employee.edit', compact(
            'employeeDepartments', 'employeeDesignations',
            'employee', 'institutes', 'academicDepartments', 'academicDegree',
            'academicDurations', 'employeeTitles', 'employeeTrainingDuration',
            'employeeSalaryScale', 'photoUrl', 'sections', 'employeeSpouses',
            'employeeChildren', 'employeeReligions', 'areaOfInterests'
        ));
    }

    public function update(StoreUpdateEmployeeGeneralInfoRequest $request, $id)
    {
        $response = $this->employeeService->updateGeneralInfo($request->all(), $id);
        Session::flash('message', $response->getContent());
        $employee_id = $response->getId();

        return redirect('/hrm/employee/' . $employee_id);
    }

    public function dateDifference($date)
    {
        $then = new \DateTime(date('Y-m-d H:i:s', strtotime($date)));
        $now = new \DateTime(date('Y-m-d H:i:s', time()));
        $diff = $then->diff($now);
        return array(
            'years' => $diff->y,
            'months' => $diff->m,
            'days' => $diff->d,
            'hours' => $diff->h,
            'minutes' => $diff->i,
            'seconds' => $diff->s
        );
    }

    /**
     * @param Employee $employee
     * @return mixed|null
     */
    public function getEmployeeContract(Employee $employee)
    {
        return $this->employeeService->getEmployeeContract($employee);
    }

    /**
     * @param Employee $employee
     * @return mixed
     */
    public function getEmployeeStructure(Employee $employee)
    {
        return $this->employeeService->getEmployeeSalaryStructure($employee);
    }

    public function getEmployee(Employee $employee)
    {
        return $employee;
    }

    /**
     * Get an employee information as JSon
     * This function is used in Payslip Create UI
     * @param Employee $employee
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEmployeeAsJson(Employee $employee)
    {
        return response()->json([
            'employee' => $employee
        ]);
    }

    public function personalInformationIndex()
    {
        $employeeList = $this->employeeService->getEmployeeList();
        return view('hrm::employee.personal_information_index', compact('employeeList'));

    }
/**
 * Undocumented function
 *
 * @return void
 */
    public function importEmployee(){
        return view('hrm::employee.import_employee');
    }
/**
 * Undocumented function
 *
 * @param Request $request
 * @return void
 */
    public function importEmployeeInformationStore(Request $request){

        try {
            Excel::import(new ImportEmployee(), request()->file('attachment'));
            Session::flash('success', 'Imported Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Employee Import Error ' . $e->getMessage() . "  " . $e->getTraceAsString());
            Session::flash('error', 'Import failed');
            return redirect()->back();
        }
    }
}
