<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Http\Requests\StoreUpdateTrainingCourseRuleGuidelineRequest;
use Modules\TMS\Services\TrainingCourseRuleService;

class TrainingCourseRuleGuidelineController extends Controller
{
    const RULE_GUIDELINE_VIEW = 'tms::training.course.rule_guideline.';
    private $service;

    /**
     * TrainingCourseRuleGuidelineController constructor.
     * @param TrainingCourseRuleService $service
     */
    public function __construct(TrainingCourseRuleService $service)
    {
        $this->service = $service;
    }

    public function show(Training $training, TrainingCourse $course)
    {
        $descriptiveCourseGuideline = $course->guidelines->where('type', 'description')->first();
        $descriptiveGuideline = optional($descriptiveCourseGuideline)->content;

        $specificGuidelines = $course->guidelines->where('type', 'specific_point')->pluck('content');

        $rulesEditRoute = route('trainings.courses.rules-guidelines.edit', [$training->id, $course->id]);

        return view(self::RULE_GUIDELINE_VIEW . 'show', compact(
                'training',
                'course',
                'descriptiveGuideline',
                'specificGuidelines',
                'rulesEditRoute'
            )
        );
    }

    public function edit(Training $training, TrainingCourse $course)
    {
        $descriptiveRuleAndStrategy = $course->guidelines->where('type', 'description')->first();

        $description = optional($descriptiveRuleAndStrategy)->content;

        $specificPoints = $course->guidelines()->where('type', 'specific_point')->get();

        return view(self::RULE_GUIDELINE_VIEW . 'edit', compact(
                'training',
                'course',
                'description',
                'specificPoints'
            )
        );
    }

    public function update(StoreUpdateTrainingCourseRuleGuidelineRequest $request, Training $training, TrainingCourse $course)
    {
        if ($this->service->updateRequest($course, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('trainings.courses.rules-guidelines.show', [$training->id, $course->id]);
    }
}
