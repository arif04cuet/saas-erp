<?php

namespace Modules\TMS\Http\Controllers;

use App\Constants\DepartmentShortName;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Services\DepartmentService;
use Modules\HRM\Services\EmployeeService;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Http\Requests\TrainingCourseAdministrationRequest;
use Modules\TMS\Services\TrainingAdministrationService;
use Modules\TMS\Services\TrainingCourseAdministrationService;

class TrainingAdministrationController extends Controller
{
    const COURSE_ADMIN_VIEW = 'tms::training.administration.';

    private $employeeService;
    private $departmentService;
    private $service;

    /**
     * TrainingCourseAdministrationController constructor.
     * @param EmployeeService $employeeService
     * @param DepartmentService $departmentService
     * @param TrainingAdministrationService $service
     */
    public function __construct(
        EmployeeService $employeeService,
        DepartmentService $departmentService,
        TrainingAdministrationService $service
    ) {
        $this->employeeService = $employeeService;
        $this->departmentService = $departmentService;
        $this->service = $service;
    }

    public function show(Training $training)
    {
        $adminEditRoute = route('trainings.administrations.edit', [$training->id]);

        return view(self::COURSE_ADMIN_VIEW . 'show', compact('training', 'adminEditRoute'));
    }

    public function edit(Training $training)
    {
        $trainingDeptEmployeeDropdown = $this->getTrainingDeptEmployeeDropdowns();

        $employees = $this->employeeService->findAll();
        $employees = $this->employeeService->getEmployeesSortedByDesignationAndServicePeriod($employees);
        $employeeDropdowns = $employees
            ->mapWithKeys($this->employeeService->empDefaultDropdown());

        $employeeDropdowns->prepend('Nobody', PHP_INT_MIN);

        $coordinator = $training->administrations()->where('role', 'coordinator')->first();
        $director = $training->administrations()->where('role', 'course_director')->first();
        $associateDirector = $training->administrations()->where('role', 'course_associate_director')
            ->first();
        $assistantDirector = $training->administrations()->where('role', 'course_assistant_director')
            ->first();
        // dd($trainingDeptEmployeeDropdown);
        return view(
            self::COURSE_ADMIN_VIEW . 'edit',
            compact(
                'training',
                'trainingDeptEmployeeDropdown',
                'employeeDropdowns',
                'coordinator',
                'director',
                'associateDirector',
                'assistantDirector'
            )
        );
    }

    public function update(TrainingCourseAdministrationRequest $request, Training $training)
    {
        if ($this->service->updateRequest($training, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('trainings.administrations.show', [$training->id]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getTrainingDeptEmployeeDropdowns()
    {
        $trainingDept = $this->departmentService->findBy(['department_code' => DepartmentShortName::TRAINING])
            ->first();
        $employeeDropdowns = $this->employeeService->findBy(['department_id' => $trainingDept->id])
            ->mapWithKeys($this->employeeService->empDefaultDropdown());
        return $employeeDropdowns;
    }
}
