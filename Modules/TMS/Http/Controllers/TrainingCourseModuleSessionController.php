<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseModule;
use Modules\TMS\Http\Requests\StoreUpdateTrainingCourseModuleSessionRequest;
use Modules\TMS\Services\TrainingCourseModuleSessionService;
use Modules\TMS\Services\TrainingCourseResourceService;

class TrainingCourseModuleSessionController extends Controller
{
    /**
     * @var $trainingCourseModuleSessionService
     */
    private $trainingCourseModuleSessionService;

    /**
     * @var $trainingCourseResourceService
     */
    private $trainingCourseResourceService;

    /**
     * TrainingCourseModuleSessionController constructor.
     * @param TrainingCourseModuleSessionService $trainingCourseModuleSessionService
     * @param TrainingCourseResourceService $trainingCourseResourceService
     */
    public function __construct(
        TrainingCourseModuleSessionService $trainingCourseModuleSessionService,
        TrainingCourseResourceService $trainingCourseResourceService
    )
    {
        $this->trainingCourseModuleSessionService = $trainingCourseModuleSessionService;
        $this->trainingCourseResourceService = $trainingCourseResourceService;
    }

    /**
     * @param Training $training
     * @param TrainingCourse $course
     * @param TrainingCourseModule $module
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(
        Training $training,
        TrainingCourse $course,
        TrainingCourseModule $module
    )
    {
        $sessions = $this->trainingCourseModuleSessionService->sessions($module);
        $resources = $this->trainingCourseResourceService->courseResourcesDropdown($course);

        return view(
            'tms::training.course.module.session.show',
            compact(
                'training',
                'course',
                'module',
                'sessions'
            )
        );
    }

    /**
     * @param Training $training
     * @param TrainingCourse $course
     * @param TrainingCourseModule $module
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(
        Training $training,
        TrainingCourse $course,
        TrainingCourseModule $module
    )
    {
        $sessions = $this->trainingCourseModuleSessionService->sessions($module);
        $resources = $this->trainingCourseResourceService->courseResourcesDropdown($course);
        return view(
            'tms::training.course.module.session.edit',
            compact(
                'training',
                'course',
                'module',
                'resources',
                'sessions'
            )
        );
    }

    /**
     * @param StoreUpdateTrainingCourseModuleSessionRequest $request
     * @param Training $training
     * @param TrainingCourse $course
     * @param TrainingCourseModule $module
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(
        StoreUpdateTrainingCourseModuleSessionRequest $request,
        Training $training,
        TrainingCourse $course,
        TrainingCourseModule $module
    )
    {
        if($this->trainingCourseModuleSessionService->createOrUpdate($module, $request->input('sessions'))) {
            Session::flash('success', trans('labels.update_success'));
            return redirect()->route('trainings.courses.modules.sessions.show', ['training' => $training, 'course' => $course, 'module' => $module]);
        }else {
            Session::flash('error', trans('labels.update_fail'));
            return redirect()->route('trainings.courses.modules.sessions.edit', ['training' => $training, 'course' => $course, 'module' => $module])
                ->withInput();
        }
    }

}
