<?php

namespace Modules\TMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseModuleSession;
use Modules\TMS\Entities\TrainingCourseResource;
use Modules\TMS\Entities\TrainingSpeakerAssessment;
use Modules\TMS\Services\TrainingSpeakerAssessmentService;

class SpeakerAssessmentChartController extends Controller
{
    private $assessmentService;

    /**
     * SpeakerAssessmentChartController constructor.
     * @param TrainingSpeakerAssessmentService $assessmentService
     */
    public function __construct(TrainingSpeakerAssessmentService $assessmentService)
    {
        $this->assessmentService = $assessmentService;
    }

    public function index(TrainingCourse $course, TrainingCourseResource $speaker)
    {
        $assessments = $this->assessmentService->findBy([
            'training_course_id' => $course->id,
            'training_course_resource_id' => $speaker->id
        ]);

        $marksBySessions = $assessments->groupBy('training_course_module_session_id')
            ->map(function ($assessmentsBySessionId) {
                $avgValuesOfEachQuestion = $this->assessmentService
                    ->getAvgValueOfAssessmentsEachQuestion($assessmentsBySessionId);
                $overallAvgValueOfSession = $avgValuesOfEachQuestion->avg('value');
                return [
                    'session_name' => Arr::get($assessmentsBySessionId->first(), 'session.title'),
                    'session_mark' => $overallAvgValueOfSession
                ];
            })
            ->values();


        $sessionsCollection = $marksBySessions->pluck('session_name');

        $sessions = [];
        if (count($sessionsCollection) > 0) {
            foreach ($sessionsCollection as $key => $session) {
                $array   = array_chunk(explode(' ', $session), 3);
                foreach ($array as $sessionKey => $item) {
                    $output = implode(" ", $item);
                    $sessions[$key][$sessionKey] = $output;
                }
            }
        }

        $marks = $marksBySessions->pluck('session_mark');

        return view('tms::training.assessment.chart.index', compact('speaker',
                'sessions',
                'marks',
                'course'
            )
        );
    }

    public function show(TrainingCourseModuleSession $session)
    {
        $speaker = optional($session)->speaker;
        $courseName = Arr::get($session, 'module.course.name');
        $moduleName = Arr::get($session, 'module.title');
        $sessionName = optional($session)->title;

        if ($schedule = $session->schedule) {
            $scheduleDuration = Carbon::parse($schedule->date)->format('j F, Y')
                . " ( " . Carbon::parse($schedule->start)->format('H:s A')
                . " - "
                . Carbon::parse($schedule->end)->format('H:s A') . " )";
        } else {
            $scheduleDuration = '';
        }

        $assessments = $this->assessmentService->findBy(['training_course_module_session_id' => $session->id]);

        $avgValuesOfEachQuestion = $this->assessmentService->getAvgValueOfAssessmentsEachQuestion($assessments);

        $questionCollections = $avgValuesOfEachQuestion->pluck('name')->map(function ($question) {
            return trans('tms::assessment_questions.' . $question);
        });
        $questions = [];
        if (count($questionCollections) > 0) {
            foreach ($questionCollections as $key => $question) {
//               dd($question);
                $array   = array_chunk(explode(' ', $question), 2);
                foreach ($array as $itemKey => $item) {
                    $output = implode(" ", $item);
                    $questions[$key][$itemKey] = $output;
                }
            }
        }
//dd($questions);
        $answers = $avgValuesOfEachQuestion->pluck('value');

        return view('tms::training.assessment.chart.show', compact('questions',
                'answers',
                'speaker',
                'courseName',
                'moduleName',
                'sessionName',
                'assessments',
                'avgValuesOfEachQuestion',
                'scheduleDuration'
            )
        );
    }
}
