<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Http\Requests\StoreUpdateTrainingCourseMethodRequest;
use Modules\TMS\Services\TrainingCourseMethodService;

class TrainingCourseMethodController extends Controller
{
    const COURSE_METHOD_VIEW = 'tms::training.course.method.';
    private $service;

    /**
     * TrainingCourseMethodController constructor.
     * @param TrainingCourseMethodService $service
     */
    public function __construct(TrainingCourseMethodService $service)
    {
        $this->service = $service;
    }

    public function show(Training $training, TrainingCourse $course)
    {
        $methodEditRoute = route('trainings.courses.methods.edit', [$training->id, $course->id]);

        return view(self::COURSE_METHOD_VIEW . 'show', compact('training',
                'course',
                'methodEditRoute'
            )
        );
    }

    public function edit(Training $training, TrainingCourse $course)
    {
        return view(self::COURSE_METHOD_VIEW . 'edit', compact('training', 'course'));
    }

    public function update(StoreUpdateTrainingCourseMethodRequest $request, Training $training, TrainingCourse $course)
    {
        if ($this->service->updateRequest($course, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('trainings.courses.methods.show', [$training->id, $course->id]);
    }
}
