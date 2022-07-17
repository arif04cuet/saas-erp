<?php

namespace Modules\TMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Http\Requests\UpdateStoreCourseEvaluationSetting;
use Modules\TMS\Services\CourseEvaluationSettingService;

class CourseEvaluationSettingController extends Controller
{
    private $service;

    public function __construct(
        CourseEvaluationSettingService $courseEvaluationSettingService
    ) {
        $this->service = $courseEvaluationSettingService;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('tms::create');
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
     * @param Training $training
     * @param TrainingCourse $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Training $training, TrainingCourse $course)
    {
        $setting = $this->service->setting($course);

        $startDate = null;
        $endDate = null;

        if (optional($setting)->start_date) {
            $startDate = Carbon::parse($setting->start_date)->format('j F, Y');
        }

        if (optional($setting)->end_date) {
            $endDate = Carbon::parse($setting->end_date)->format('j F, Y');
        }

        return view(
            'tms::training.course.evaluation.setting.show',
            compact(
                'setting',
                'course',
                'training',
                'startDate',
                'endDate'
            )
        );

    }

    /**
     * @param Training $training
     * @param TrainingCourse $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Training $training, TrainingCourse $course)
    {
        $setting = $this->service->setting($course);
        $trainingStartDate = Carbon::parse($training->start_date)->format('m/d/Y');
        $trainingEndDate = Carbon::parse($training->end_date)->format('m/d/Y');
        $courseStartDate = Carbon::today()->format('m/d/Y');
        $courseEndDate = Carbon::today()->format('m/d/Y');
        $currentStartDate = Carbon::today()->format('d/m/Y');
        $currentEndDate = Carbon::today()->format('d/m/Y');
        $currentStatus = false;

        if (optional($course)->start_date) {
            $courseStartDate = Carbon::parse($course->start_date)->format('m/d/Y');
            $currentStartDate = Carbon::parse($course->start_date)->format('d/m/Y');
            $currentEndDate = Carbon::parse($course->start_date)->format('d/m/Y');
        }

        if (optional($course)->end_date) {
            $courseEndDate = Carbon::parse($course->end_date)->format('m/d/Y');
        }

        if (optional($setting)->start_date) {
            $currentStartDate = Carbon::parse($setting->start_date)->format('d/m/Y');
        }

        if (optional($setting)->end_date) {
            $currentEndDate = Carbon::parse($setting->end_date)->format('d/m/Y');
        }

        if (optional($setting)->status) {
            $currentStatus = $setting->status;
        }

        // dd($courseStartDate, $trainingStartDate);
        return view(
            'tms::training.course.evaluation.setting.create_edit',
            compact(
                'setting',
                'course',
                'training',
                'courseStartDate',
                'courseEndDate',
                'currentStartDate',
                'currentEndDate',
                'currentStatus',
                'trainingStartDate',
                'trainingEndDate'
            )
        );
    }

    /**
     * @param UpdateStoreCourseEvaluationSetting $request
     * @param Training $training
     * @param TrainingCourse $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(
        UpdateStoreCourseEvaluationSetting $request,
        Training $training,
        TrainingCourse $course
    ) {
        if ($this->service->storeUpdate($course, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
            return redirect()->route('trainings.courses.evaluations.settings.show', [$training, $course]);
        } else {
            Session::flash('error', trans('labels.update_fail'));
            return redirect()->back();
        }
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
