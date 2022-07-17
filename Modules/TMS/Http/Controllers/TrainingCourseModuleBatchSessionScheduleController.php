<?php

namespace Modules\TMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Console\SendScheduledSessionNotificationToTraineeEmail;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseBatch;
use Modules\TMS\Entities\TrainingCourseModule;
use Modules\TMS\Services\TrainingCourseModuleBatchSessionScheduleService;
use Modules\TMS\Services\TrainingVenueService;

class TrainingCourseModuleBatchSessionScheduleController extends Controller
{
    /**
     * @var $trainingVenueService
     */
    private $trainingVenueService;

    /**
     * @var TrainingCourseModuleBatchSessionScheduleService
     */
    private $trainingCourseModuleBatchSessionScheduleService;

    public function __construct(
        TrainingVenueService $trainingVenueService,
        TrainingCourseModuleBatchSessionScheduleService $trainingCourseModuleBatchSessionScheduleService
    ) {
        $this->trainingVenueService = $trainingVenueService;
        $this->trainingCourseModuleBatchSessionScheduleService = $trainingCourseModuleBatchSessionScheduleService;
    }

    /**
     * Show the specified resource.
     * @param Training $training
     * @param TrainingCourse $course
     * @param TrainingCourseModule $module
     * @param TrainingCourseBatch $batch
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(
        Training $training,
        TrainingCourse $course,
        TrainingCourseModule $module,
        TrainingCourseBatch $batch
    ) {
        $sessions = $this->trainingCourseModuleBatchSessionScheduleService->sessions(
            $batch,
            $module
        )->pluck('id')->toArray();
        $schedules = $this->trainingCourseModuleBatchSessionScheduleService->getSchedulesBySession($sessions);
        $breaks = $this->trainingCourseModuleBatchSessionScheduleService->formatCourseBreakToScheduledSession($course);
        $counter = 1;
        return view(
            'tms::training.course.module.schedule.show',
            compact(
                'training',
                'course',
                'module',
                'batch',
                'schedules',
                'counter',
                'breaks'
            )
        );
    }

    /**
     * @param Training $training
     * @param TrainingCourse $course
     * @param TrainingCourseModule $module
     * @param TrainingCourseBatch $batch
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(
        Training $training,
        TrainingCourse $course,
        TrainingCourseModule $module,
        TrainingCourseBatch $batch
    ) {
        $sessions = $this->trainingCourseModuleBatchSessionScheduleService->sessions($batch, $module);
        $venues = $this->trainingVenueService->venuesForCalendar();
        $events = $this->trainingCourseModuleBatchSessionScheduleService->events($batch, $module);
        return view(
            '
            tms::training.course.module.schedule.edit',
            compact(
                'training',
                'course',
                'module',
                'batch',
                'sessions',
                'venues',
                'events'
            )
        );
    }

    /**
     * @param Request $request
     * @param Training $training
     * @param TrainingCourse $course
     * @param TrainingCourseModule $module
     * @param TrainingCourseBatch $batch
     * @return mixed
     */
    public function update(
        Request $request,
        Training $training,
        TrainingCourse $course,
        TrainingCourseModule $module,
        TrainingCourseBatch $batch
    ) {
        $update = $this->trainingCourseModuleBatchSessionScheduleService->update(
            $batch,
            $module,
            $request->input('session_schedules')
        );

        return json_encode([
            'status' => $update ? true : false,
            'sessions' => $this->trainingCourseModuleBatchSessionScheduleService->sessions($batch, $module)
        ]);
    }

    public function notify()
    {
        try {
            throw new \Exception('Under Production !');
            // todo:: use queue to send email to the trainees
            //Artisan::call('send:session-schedule-trainee');
            Session::flash('success', trans('tms::session.flash_messages.notify_trainee.start'));
            return redirect()->back();
        } catch (\Exception $exception) {
            Session::flash('error', $exception->getMessage());
            Log::error('Notify Trainee Schedule Error: ' . $exception->getMessage() . " :Trace: " . $exception->getTraceAsString());
            return redirect()->back();
        }
    }
}
