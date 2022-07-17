<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Http\Requests\StoreUpdateTrainingCourseBatchRequest;
use Modules\TMS\Services\TrainingCourseBatchService;
use Modules\TMS\Services\TrainingCourseService;

class TrainingCourseBatchController extends Controller
{
    private $trainingCourseService;
    private $trainingCourseBatchService;

    public function __construct(
        TrainingCourseService $trainingCourseService,
        TrainingCourseBatchService $trainingCourseBatchService
    )
    {
        $this->trainingCourseService = $trainingCourseService;
        $this->trainingCourseBatchService = $trainingCourseBatchService;
    }

    /**
     * @param Training $training
     * @param TrainingCourse $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Training $training, TrainingCourse $course)
    {
        $batches = $this->trainingCourseService->batches($course);

        return view('tms::training.course.batch.show', compact(
            'batches',
            'training',
            'course'
        ));
    }

    /**
     * @param Training $training
     * @param TrainingCourse $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Training $training, TrainingCourse $course)
    {
        $batches = $this->trainingCourseService->batches($course);
        return view('tms::training.course.batch.edit', compact('training', 'course', 'batches'));
    }

    /**
     * @param StoreUpdateTrainingCourseBatchRequest $request
     * @param Training $training
     * @param TrainingCourse $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUpdateTrainingCourseBatchRequest $request, Training $training, TrainingCourse $course)
    {
        // dd($request->all()['title']['old']);
        $update = $this->trainingCourseBatchService->update(
            $request->all(),
            $course
        );

        if ($update) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route(
            'trainings.courses.batches.show',
            ['training' => $training, 'course' => $course]
        );
    }
}
