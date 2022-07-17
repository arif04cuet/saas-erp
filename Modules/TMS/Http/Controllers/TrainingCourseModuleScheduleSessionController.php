<?php

namespace Modules\TMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\Training;
use Modules\TMS\Services\CourseEvaluationSettingService;
use Modules\TMS\Services\TraineeService;
use Modules\TMS\Services\TrainingCourseAssessmentService;
use Modules\TMS\Services\TrainingCourseModuleBatchSessionScheduleService;
use Modules\TMS\Services\TrainingSpeakerAssessmentService;
use DB;

class TrainingCourseModuleScheduleSessionController extends Controller
{
    private $trainingCourseModuleBatchSessionScheduleService;
    private $trainingSpeakerAssessmentService;
    private $traineeService;
    private $courseEvaluationSettingService;
    private $trainingCourseAssessmentService;

    public function __construct(
        TrainingCourseModuleBatchSessionScheduleService $trainingCourseModuleBatchSessionScheduleService,
        TrainingSpeakerAssessmentService $trainingSpeakerAssessmentService,
        TraineeService $traineeService,
        CourseEvaluationSettingService $courseEvaluationSettingService,
        TrainingCourseAssessmentService $trainingCourseAssessmentService
    )
    {
        $this->trainingCourseModuleBatchSessionScheduleService = $trainingCourseModuleBatchSessionScheduleService;
        $this->trainingSpeakerAssessmentService = $trainingSpeakerAssessmentService;
        $this->traineeService = $traineeService;
        $this->courseEvaluationSettingService = $courseEvaluationSettingService;
        $this->trainingCourseAssessmentService = $trainingCourseAssessmentService;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $scheduledSessions = $this->trainingCourseModuleBatchSessionScheduleService->sessionsScheduled();
        $filters = $this->trainingCourseModuleBatchSessionScheduleService->filters($scheduledSessions);
        $filterKeys = array_column($filters->toArray(), 'key');
        $filterdata = $this->trainingCourseModuleBatchSessionScheduleService->getFilterData();
        $filterdata = $this->trainingCourseModuleBatchSessionScheduleService->addSpeakerToFilterData($filterdata,$filters[3]['data']);

        return view(
            'tms::training.course.module.session.schedule.index',
            compact(
                'scheduledSessions',
                'filters',
                'filterKeys',
                'filterdata'
            )
        );
    }

    public function evaluations()
    {
        $scheduledSessions = $this->trainingCourseModuleBatchSessionScheduleService->sessionsScheduled()
            ->filter(function ($schedule) {
                if(Carbon::now() >= Carbon::parse($schedule->end)->addHours($schedule->session->speaker_expire_timeline)) {
                    return true;
                }else {
                    return false;
                }
            });

        $filters = $this->trainingCourseModuleBatchSessionScheduleService->filters($scheduledSessions);

        $filterKeys = array_column($filters->toArray(), 'key');

        $scheduledSessions->each(function ($schedule) {
            $trainees = optional($schedule->session->module->course->training)->trainee;
            $totalTraineeIds = $trainees->pluck('id')->toArray();
            $totalTraineeIdsWhoEvaluated = optional($schedule->session)->assessments()
                ->pluck('trainee_id')->toArray();

            $traineesWhoDidNotEvaluated = (array_diff($totalTraineeIds, $totalTraineeIdsWhoEvaluated));

            $schedule->trainees = $this->traineeService->findIn('id', $traineesWhoDidNotEvaluated);

        });

        return view(
            'tms::training.course.module.session.schedule.assessment.index',
            compact(
                'scheduledSessions',
                'filters',
                'filterKeys'
            )
        );
    }

    public function courseEvaluation()
    {
        $activeEvaluationCourses = $this->courseEvaluationSettingService->activeCourses();

        $traineeIds = $this->trainingCourseAssessmentService->filters($activeEvaluationCourses);
        $evaluatedTraineeIds = $this->trainingCourseAssessmentService->evaluatedTrainees();

        $traineeWhoDidNotEvaluated = array_diff($traineeIds, $evaluatedTraineeIds);

        $getTrainings = $this->trainingCourseAssessmentService->getAllTrainings();
        $getCourses = $this->trainingCourseAssessmentService->getAllCourses();

        $didNotEvaluatedCourseTrainees =  $this->traineeService->findIn('id', $traineeWhoDidNotEvaluated);


        return view(
            'tms::training.assessment.course_evaluation.did-not-evaluated.index',
            compact('didNotEvaluatedCourseTrainees','getCourses', 'getTrainings')
            );
    }
}
