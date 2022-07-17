<?php

namespace Modules\TMS\Http\Controllers;

use App\Constants\DepartmentShortName;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Services\DepartmentService;
use Modules\HRM\Services\EmployeeService;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Http\Requests\TrainingCourseAdministrationRequest;
use Modules\TMS\Services\TrainingCourseAdministrationService;

class TrainingCourseAdministrationController extends Controller
{
    const COURSE_ADMIN_VIEW = 'tms::training.course.administration.';

    private $employeeService;
    private $departmentService;
    private $service;

    /**
     * TrainingCourseAdministrationController constructor.
     * @param EmployeeService $employeeService
     * @param DepartmentService $departmentService
     * @param TrainingCourseAdministrationService $service
     */
    public function __construct(
        EmployeeService $employeeService,
        DepartmentService $departmentService,
        TrainingCourseAdministrationService $service
    ) {
        $this->employeeService = $employeeService;
        $this->departmentService = $departmentService;
        $this->service = $service;
    }

    public function show(Training $training, TrainingCourse $course)
    {
        $adminEditRoute = route('trainings.courses.administrations.edit', [$training->id, $course->id]);

        return view(self::COURSE_ADMIN_VIEW . 'show', compact('training', 'course', 'adminEditRoute'));
    }

    public function edit(Training $training, TrainingCourse $course)
    {
        $trainingDeptEmployeeDropdown = $this->getTrainingDeptEmployeeDropdowns();

        $employeeDropdowns = $this->employeeService->findAll()
            ->filter(function ($employee) {
                return $employee->designation;
            })
            ->filter(function ($employee) {
                return $employee->designation->rank_id <= 3;
            })
            ->mapWithKeys($this->employeeService->empDefaultDropdown());

        $employeeDropdowns->prepend('Nobody', PHP_INT_MIN);

        $coordinator = $course->administrations()->where('role', 'coordinator')->first();
        $director = $course->administrations()->where('role', 'course_director')->first();
        $associateDirector = $course->administrations()->where('role', 'course_associate_director')
            ->first();
        $assistantDirector = $course->administrations()->where('role', 'course_assistant_director')
            ->first();

        return view(
            self::COURSE_ADMIN_VIEW . 'edit',
            compact(
                'training',
                'course',
                'trainingDeptEmployeeDropdown',
                'employeeDropdowns',
                'coordinator',
                'director',
                'associateDirector',
                'assistantDirector'
            )
        );
    }

    public function update(TrainingCourseAdministrationRequest $request, Training $training, TrainingCourse $course)
    {
        if ($this->service->updateRequest($course, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            if (!Session::has('error')) {
                Session::flash('error', trans('labels.update_fail'));
            }
        }

        return redirect()->route('trainings.courses.administrations.show', [$training->id, $course->id]);
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
