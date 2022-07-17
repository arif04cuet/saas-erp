<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Services\EmployeeService;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseGuest;
use Modules\TMS\Entities\TrainingCourseResource;
use Modules\TMS\Http\Requests\TrainingCourseResourceRequest;
use Modules\TMS\Services\TrainingCourseGuestService;
use Modules\TMS\Services\TrainingCourseResourceService;

class TrainingCourseResourceController extends Controller
{
    const COURSE_RESOURCE_VIEW = 'tms::training.course.resource.';
    /**
     * @var EmployeeService
     */
    private $employeeService;
    /**
     * @var TrainingCourseResourceService
     */
    private $trainingCourseResourceService;
    /**
     * @var TrainingCourseGuestService
     */
    private $trainingCourseGuestService;

    public function __construct(
        EmployeeService $employeeService,
        TrainingCourseResourceService $trainingCourseResourceService,
        TrainingCourseGuestService $trainingCourseGuestService
    ) {
        /** @var EmployeeService $employeeService */
        $this->employeeService = $employeeService;
        /** @var TrainingCourseResourceService $trainingCourseResourceService */
        $this->trainingCourseResourceService = $trainingCourseResourceService;
        /** @var TrainingCourseGuestService $trainingCourseGuestService */
        $this->trainingCourseGuestService = $trainingCourseGuestService;
    }

    /**
     * Show the specified resource.
     * @param Training $training
     * @param TrainingCourse $course
     * @return Response
     */
    public function show(Training $training, TrainingCourse $course)
    {
        // dd('ook');
        $employeeResources = $course->resources()
            ->where('reference_entity', Employee::class)
            ->get();
        $guestResources = $course->resources()
            ->where('reference_entity', TrainingCourseGuest::class)
            ->get();
        $resourceEditRoute = route('training.courses.resources.edit', [$training->id, $course->id]);

        return view('tms::training.course.resource.show', compact(
            'training',
            'course',
            'guestResources',
            'employeeResources',
            'resourceEditRoute'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Training $training
     * @param TrainingCourse $course
     * @return Response
     */
    public function edit(Training $training, TrainingCourse $course)
    {
        $employees = $this->employeeService->getEmployeesForDropdown();
        $employeeResources = $course->resources->where('reference_entity', Employee::class);
        $guestResources = $course->resources->where('reference_entity', TrainingCourseGuest::class);
        // dd('hi',$guestResources);
        return view(self::COURSE_RESOURCE_VIEW . 'edit', compact(
            'training',
            'course',
            'employees',
            'employeeResources',
            'guestResources'
        ));
    }

    /**
     * Update the specified resource in storage.
     * @param TrainingCourseResourceRequest $request
     * @param Training $training
     * @param TrainingCourse $course
     * @return RedirectResponse
     */
    public function update(TrainingCourseResourceRequest $request, Training $training, TrainingCourse $course)
    {
        if ($this->trainingCourseResourceService->updateRequest($course, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('training.courses.resources.edit', [$training->id, $course->id]);
    }
}
