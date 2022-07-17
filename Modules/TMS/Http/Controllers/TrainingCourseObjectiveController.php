<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Http\Requests\StoreUpdateTrainingCourseObjectiveRequest;
use Modules\TMS\Services\TrainingCourseObjectiveService;

class TrainingCourseObjectiveController extends Controller
{
    const COURSE_OBJECTIVE_VIEW = 'tms::training.course.objective.';
    private $service;

    /**
     * TrainingCourseObjectiveController constructor.
     * @param TrainingCourseObjectiveService $service
     */
    public function __construct(TrainingCourseObjectiveService $service)
    {
        $this->service = $service;
    }

    public function show(Training $training, TrainingCourse $course)
    {
        $courseDescriptiveObjective = $course->objectives->where('type', 'description')->first();
        $courseDescription = optional($courseDescriptiveObjective)->content;

        $courseSpecificPointObjectives = $course->objectives->where('type', 'specific_point')->pluck('content');

        $objectiveEditRoute = route('trainings.courses.objectives.edit', [$training->id, $course->id]);

        return view(
            self::COURSE_OBJECTIVE_VIEW . 'show',
            compact(
                'training',
                'course',
                'courseDescription',
                'courseSpecificPointObjectives',
                'objectiveEditRoute'
            )
        );
    }

    public function edit(Training $training, TrainingCourse $course)
    {
        $courseDescriptiveObjective = $course->objectives->where('type', 'description')->first();
        $description = optional($courseDescriptiveObjective)->content;

        $specificObjectives = $course->objectives->where('type', 'specific_point')->pluck('content');

        return view(
            self::COURSE_OBJECTIVE_VIEW . 'edit',
            compact(
                'training',
                'course',
                'description',
                'specificObjectives'
            )
        );
    }

    public function update(StoreUpdateTrainingCourseObjectiveRequest $request, Training $training, TrainingCourse $course)
    {
        if ($this->service->updateRequest($course, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('trainings.courses.objectives.show', [$training->id, $course->id]);
    }
}
