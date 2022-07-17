<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Http\Requests\StoreUpdateTrainingCourseModuleRequest;
use Modules\TMS\Services\TrainingCourseModuleService;
use Modules\TMS\Services\TrainingCourseService;
use Modules\TMS\Repositories\TrainingCourseModuleRepository;

class TrainingCourseModuleController extends Controller
{
    /**
     * @var $trainingCourseService
     */
    private $trainingCourseService;

    /**
     * @var $trainingCourseModuleService
     */
    private $trainingCourseModuleService;
    private $trainingCourseModuleRepository;


    public function __construct(
        TrainingCourseService $trainingCourseService,
        TrainingCourseModuleService $trainingCourseModuleService,
        TrainingCourseModuleRepository $trainingCourseModuleRepository
    )
    {
        $this->trainingCourseService = $trainingCourseService;
        $this->trainingCourseModuleService = $trainingCourseModuleService;
        $this->trainingCourseModuleRepository = $trainingCourseModuleRepository;
    }

    /**
     * @param Training $training
     * @param TrainingCourse $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Training $training, TrainingCourse $course)
    {
        $modules = $this->trainingCourseModuleService->modules($course);

        return view(
            'tms::training.course.module.show',
            compact(
                'training',
                'course',
                'modules'
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
        $modules = $this->trainingCourseModuleService->modules($course);
        return view(
            'tms::training.course.module.edit',
            compact(
                'training',
                'course',
                'modules'
            )
        );
    }

    /**
     * @param StoreUpdateTrainingCourseModuleRequest $request
     * @param Training $training
     * @param TrainingCourse $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(
        StoreUpdateTrainingCourseModuleRequest $request,
        Training $training,
        TrainingCourse $course
    )
    {
        if ($this->trainingCourseModuleService->update($course, $request->input('modules'))) {
            Session::flash('success', trans('labels.update_success'));
            return redirect()->route('trainings.courses.modules.show', ['training' => $training, 'course' => $course]);
        } else {
            Session::flash('error', trans('labels.update_fail'));
            return redirect()->route('trainings.courses.modules.edit', ['training' => $training, 'course' => $course])
                ->withInput();
        }
    }

    public function getAllModuleByCourseId($courseId)
    {
        return $this->trainingCourseModuleRepository->findBy(['training_course_id' => $courseId]);
    }
}
