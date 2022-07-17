<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Http\Requests\StoreUpdateTrainingCourseMarkAllotmentRequest;
use Modules\TMS\Services\TrainingCourseMarkAllotmentService;
use Modules\TMS\Services\TrainingCourseMarkAllotmentTypeService;
use Modules\TMS\Services\TrainingCourseService;

class TrainingCourseMarkAllotmentController extends Controller
{
    /**
     * @var TrainingCourseService
     */
    private $trainingCourseService;

    /**
     * @var TrainingCourseMarkAllotmentTypeService
     */
    private $trainingCourseMarkAllotmentTypeService;

    /**
     * @var TrainingCourseMarkAllotmentService
     */
    private $trainingCourseMarkAllotmentService;

    /**
     * TrainingCourseMarkAllotmentController constructor.
     * @param TrainingCourseService $trainingCourseService
     * @param TrainingCourseMarkAllotmentTypeService $trainingCourseMarkAllotmentTypesService
     * @param TrainingCourseMarkAllotmentService $trainingCourseMarkAllotmentService
     */
    public function __construct(
        TrainingCourseService $trainingCourseService,
        TrainingCourseMarkAllotmentTypeService $trainingCourseMarkAllotmentTypesService,
        TrainingCourseMarkAllotmentService $trainingCourseMarkAllotmentService
    )
    {
        $this->trainingCourseService = $trainingCourseService;
        $this->trainingCourseMarkAllotmentTypeService = $trainingCourseMarkAllotmentTypesService;
        $this->trainingCourseMarkAllotmentService = $trainingCourseMarkAllotmentService;
    }

    /**
     * @param Training $training
     * @param TrainingCourse $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Training $training, TrainingCourse $course)
    {
        $markAllotments = $this->trainingCourseService->markAllotments($course);

        return view(
            'tms::training.course.mark_allotment.show',
            compact(
                'markAllotments',
                'training',
                'course'
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
        $markAllotments = $this->trainingCourseService->markAllotments($course);
        $markAllotmentTypes = $this->trainingCourseMarkAllotmentTypeService->formattedDropdown();

        return view(
            'tms::training.course.mark_allotment.edit',
            compact(
                'markAllotments',
                'training',
                'course',
                'markAllotmentTypes'
            )
        );
    }

    /**
     * @param StoreUpdateTrainingCourseMarkAllotmentRequest $request
     * @param Training $training
     * @param TrainingCourse $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUpdateTrainingCourseMarkAllotmentRequest $request, Training $training, TrainingCourse $course)
    {
        if($this->trainingCourseMarkAllotmentService->update($request->input('mark_allotment'), $course)) {
            Session::flash('success', trans('labels.update_success'));
        }else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('trainings.courses.marks.allotments.show', ['training'=> $training, 'course' => $course]);
    }
}
