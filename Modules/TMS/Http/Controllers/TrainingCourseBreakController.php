<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Http\Requests\TrainingCourseBreakRequest;
use Modules\TMS\Services\TrainingCafeteriaService;
use Modules\TMS\Services\TrainingCourseBreakService;
use Modules\TMS\Services\TrainingVenueService;

class TrainingCourseBreakController extends Controller
{
    const COURSE_BREAK_VIEW = 'tms::training.course.break.';
    private $service;
    private $cafeteriaService;
    private $trainingVenueService;

    /**
     * TrainingCourseBreakController constructor.
     * @param TrainingCourseBreakService $service
     * @param TrainingCafeteriaService $cafeteriaService
     * @param TrainingVenueService $trainingVenueService
     */
    public function __construct(
        TrainingCourseBreakService $service,
        TrainingCafeteriaService $cafeteriaService,
        TrainingVenueService $trainingVenueService
    )
    {
        $this->service = $service;
        $this->cafeteriaService = $cafeteriaService;
        $this->trainingVenueService = $trainingVenueService;
    }

    public function show(Training $training, TrainingCourse $course)
    {
        $recurringSchedulesEditRoute = route('trainings.courses.breaks.edit', [$training->id, $course->id]);
        return view(self::COURSE_BREAK_VIEW . 'show', compact('training', 'course', 'recurringSchedulesEditRoute'));
    }

    public function edit(Training $training, TrainingCourse $course)
    {
        $recurringSchedules = $this->service->recurringSchedules($course);

        $venueDropDowns = $this->trainingVenueService
            ->venuesDropDownForRecurringSessions()
            ->mapToGroups(function ($venue, $key) {
                return [$venue->type => [$venue->id => $venue->title]];
            })->map(function ($type) {
                $values = [];
                collect($type)->each(function ($data) use (&$values) {
                    collect($data)->each(function ($item, $key) use (&$values) {
                        $values[$key] = $item;
                    });
                });
                return $values;
            });

            // dd($venueDropDowns);
        
        return view(self::COURSE_BREAK_VIEW . 'edit', compact('training',
                'course',
                'recurringSchedules',
                'venueDropDowns'
            )
        );
    }

    public function update(TrainingCourseBreakRequest $request, Training $training, TrainingCourse $course)
    {
        if ($this->service->updateRequest($course, $request->input('recurring_schedules') ?: [])) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('trainings.courses.breaks.show', [$training->id, $course->id]);
    }
}
