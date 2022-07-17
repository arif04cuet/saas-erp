<?php


namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Services\EmployeeService;
use Modules\TMS\Entities\AssessmentQuestion;
use Modules\TMS\Entities\TrainingCourseModuleSession;
use Modules\TMS\Entities\TrainingCourseResource;
use Modules\TMS\Repositories\TrainingSpeakerAssessmentRepository;
use Modules\TMS\Traits\MenuAccessTrait;

class TrainingSpeakerAssessmentService
{
    use CrudTrait, MenuAccessTrait;

    /**
     * @var TrainingSpeakerAssessmentRepository
     */
    private $trainingSpeakerAssessmentRepository;

    private $trainingCourseAdministrationService;

    private $trainingCourseResourceService;

    /**
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * TrainingSpeakerAssessmentService constructor.
     * @param TrainingSpeakerAssessmentRepository $trainingSpeakerAssessmentRepository
     * @param TrainingCourseAdministrationService $trainingCourseAdministrationService
     * @param TrainingCourseResourceService $trainingCourseResourceService
     */
    public function __construct(
        TrainingSpeakerAssessmentRepository $trainingSpeakerAssessmentRepository,
        TrainingCourseAdministrationService $trainingCourseAdministrationService,
        TrainingCourseResourceService $trainingCourseResourceService
    ) {
        $this->trainingSpeakerAssessmentRepository = $trainingSpeakerAssessmentRepository;
        $this->setActionRepository($trainingSpeakerAssessmentRepository);
        $this->trainingCourseAdministrationService = $trainingCourseAdministrationService;
        $this->trainingCourseResourceService = $trainingCourseResourceService;
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['date'] = Carbon::now();

            $trainingSpeakerAssessment = $this->save($data);

            foreach ($data['assessmentQA'] as $questionId => $answer) {
                $trainingSpeakerAssessment->assessmentQuestions()->attach($questionId, ['value' => $answer]);
            }

            return $trainingSpeakerAssessment;
        });
    }

    public function getEvaluations()
    {
        return $evaluations = $this->findAll()
            ->groupBy(['training_id', 'session_name', 'employee_id'])
            ->flatMap(function ($trainingAssessments) {
                return $trainingAssessments->flatMap(function ($sessionAssessments) {
                    return $sessionAssessments->map(function ($employeeAssessments) {
                        $assessment = $employeeAssessments->first();

                        $employee = $assessment->employee;

                        $averageScore = $employeeAssessments->avg('score');

                        return (object)[
                            'training_title' => $assessment->training->training_title,
                            'session_name' => $assessment->session_name,
                            'employee_id' => $assessment->employee_id,
                            'employee_name' => $employee->getName(),
                            'average_score' => $averageScore,
                        ];
                    });
                });
            });
    }

    public function getSessionEvaluationFor(string $sessionName, int $employeeId)
    {
        return $this->findBy(['session_name' => $sessionName, 'employee_id' => $employeeId])
            ->flatMap(function ($assessment) {
                return $assessment->assessmentQuestions;
            })
            ->groupBy('pivot.assessment_question_id')
            ->map(function ($questionGroup) {
                $ratio = bcdiv($questionGroup->avg('pivot.value'), 5, 1);
                $averagePercentage = bcmul($ratio, 100, 1);

                return (object)[
                    'question' => $questionGroup->first()->name,
                    'average_percentage' => $averagePercentage,
                ];
            })
            ->values();
    }

    /**
     * @param $assessments
     * @return mixed
     */
    public function getAvgValueOfAssessmentsEachQuestion($assessments)
    {
        $groupByAssessmentQuestions = $assessments->flatMap(function ($assessment) {
            return $assessment->assessmentQuestions;
        })->groupBy('name');

        $individualQuestionAvgValues = $groupByAssessmentQuestions
            ->map(function ($groupedQA, $question) {
                return (object)[
                    'name' => $question,
                    'value' => $groupedQA->avg('pivot.value')
                ];
            })->values();
        return $individualQuestionAvgValues;
    }


    /**
     * @param $evaluations
     * @return mixed
     */
    public function getAssessmentsBySessions($evaluations)
    {
        $sessionsAssessments = $evaluations->groupBy('training_course_module_session_id')
            ->map(function ($assessmentsBySessionId) {
                $assessment = $assessmentsBySessionId->first();

                $trainingId = Arr::get($assessment, 'course.training.id');
                $trainingName = Arr::get($assessment, 'course.training.title');
                $courseId = Arr::get($assessment, 'course.id');
                $courseName = Arr::get($assessment, 'course.name');
                $sessionId = Arr::get($assessment, 'session.id');
                $sessionName = Arr::get($assessment, 'session.title');
                $moduleName = Arr::get($assessment, 'session.module.title');
                $speaker = Arr::get($assessment, 'speaker');
                $speakerName = optional($speaker)->getResourceName() ?? '';
                $speakerId = optional($speaker)->id;

                $avgValuesOfEachQuestion = $this->getAvgValueOfAssessmentsEachQuestion($assessmentsBySessionId);

                $avgSessionAssessmentPercent = bcdiv(
                    $avgValuesOfEachQuestion->sum(function ($questionAnswer) {
                        return bcmul(bcdiv($questionAnswer->value, 5, 2), 100, 2);
                    }),
                    $avgValuesOfEachQuestion->count(),
                    2
                );

                return (object)[
                    'training_id' => $trainingId,
                    'training_name' => $trainingName,
                    'course_id' => $courseId,
                    'course_name' => $courseName,
                    'session_id' => $sessionId,
                    'session_name' => $sessionName,
                    'module_name' => $moduleName,
                    'speaker_id' => $speakerId,
                    'speaker_name' => $speakerName,
                    'individual_question_avg_values' => $avgValuesOfEachQuestion,
                    'avg_session_assessment_percentage' => $avgSessionAssessmentPercent,
                ];
            })
            ->values();
        return $sessionsAssessments;
    }

    public function assessments()
    {
        $this->can = false;

        $this->isDirector(auth()->user());
        $this->isTrainingDivisionEmployee(auth()->user());
        if ($this->can) {
            $assessments = $this->trainingSpeakerAssessmentRepository->findAll();

            return $assessments;
        }

        $this->isTrainingCourseResource(auth()->user());
        if ($this->can) {

            $resources = $this->trainingCourseResourceService->findBy([
                'reference_entity' => Employee::class,
                'reference_entity_id' => optional(auth()->user()->employee)->id
            ])->unique()
                ->pluck('id')
                ->toArray();
            
            $assessments = $this->trainingSpeakerAssessmentRepository->findIn(
                'training_course_resource_id',
                $resources
            );
            return $assessments;
        }

        $this->isTrainingCourseAdministrator(auth()->user());
        if ($this->can) {
            $courses = $this->trainingCourseAdministrationService->findBy([
                'employee_id' => optional(auth()->user()->employee)->id
            ])->unique()
                ->pluck('training_course_id')
                ->toArray();

            $assessments = $this->trainingSpeakerAssessmentRepository->findIn('training_course_id', $courses);

            return $assessments;
        }


        return collect();
    }

    public function getAssessmentsBySessions2($evaluations)
    {
        $data = [];
        // dd($evaluations);
        $evaluations->groupBy('training_course_module_session_id')
            ->each(function ($assessments, $key) use (&$data) {

                $session = TrainingCourseModuleSession::find($key);
                $assessment = $assessments->first();
                $answersForQuestions = [];
                $overallAverage = 0.00;
                if ($session) {
                    $answers = $session->submissions
                    ->groupBy('assessment_question_id')
                    ->each(function ($questions, $questionKey) use (&$answersForQuestions, &$overallAverage) {

                        $answersForQuestions[] = [
                            'name' => AssessmentQuestion::find($questionKey)->name,
                            'value' => bcdiv($questions->sum('value'), $questions->count(), 10)
                        ];

                        $overallAverage += bcdiv($questions->sum('value'), $questions->count(), 10);
                    });
                }
                $trainingId = Arr::get($assessment, 'course.training.id');
                $trainingName = Arr::get($assessment, 'course.training.title');
                $courseId = Arr::get($assessment, 'course.id');
                $courseName = Arr::get($assessment, 'course.name');
                $sessionId = Arr::get($assessment, 'session.id');
                $sessionName = Arr::get($assessment, 'session.title');
                $moduleName = Arr::get($assessment, 'session.module.title');
                $moduleId = Arr::get($assessment, 'session.module.id');
                $speaker = Arr::get($assessment, 'speaker');
                $speakerName = optional($speaker)->getResourceName() ?? '';
                $speakerId = optional($speaker)->id;
                $avgSessionPercentage = bcdiv(bcmul($overallAverage, 100.00, 10), 30.00, 10);
                $finalAverage = bcmul(bcdiv($avgSessionPercentage, 100, 2), 5, 2);
                $assessmentValueInWord = assessment_value_in_word($finalAverage);

                // url's
                if($courseId && $speakerId && $sessionId) {
                    $courseUrl = route(
                        'speakers.evaluations.charts.index',
                        ['course' => $courseId, 'speaker' => $speakerId]
                    );

                    $sessionUrl = route('speakers.evaluations.charts.show', [$sessionId]);
                    $data[] = (object)[
                        'training_id' => $trainingId,
                        'training_name' => $trainingName,
                        'course_id' => $courseId,
                        'course_name' => $courseName,
                        'course_url' => $courseUrl,
                        'session_id' => $sessionId,
                        'session_name' => $sessionName,
                        'session_url' => $sessionUrl,
                        'module_name' => $moduleName,
                        'module_id' => $moduleId,
                        'speaker_id' => $speakerId,
                        'speaker_name' => $speakerName,
                        'individual_question_avg_values' => collect($answersForQuestions),
                        'avg_session_assessment_percentage' => $avgSessionPercentage,
                        'assessment_value_in_word' => $assessmentValueInWord,
                        'final_average' => $finalAverage
                    ];
                }
                // dd('hi');
            });
        return collect($data)->values();
    }

    public function getAssessmentInformationByCourse($courseId)
    {
        return $this->getAssessmentsBySessions2($this->findBy([
            'training_course_id' => $courseId
        ]));
    }

    public function filterSessionAssessmentsByUser($sessionsAssessments)
    {
        $user = auth()->user();
        $employee = $user->employee;
        $speaker = null;
        if ($user->hasAnyRole(['ROLE_DIRECTOR_TRAINING'])) {
            return $sessionsAssessments;
        } else {
            return $sessionsAssessments->filter(function ($a) use ($user, $employee, $speaker) {
                $speaker = TrainingCourseResource::find($a->speaker_id);
                if (is_null($speaker)) {
                    return false;
                }
                if (is_null($employee)) {
                    return false;
                }
                if ($speaker->reference_entity === Employee::class) {
                    if ($speaker->reference_entity_id == $employee->id) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    // for guest, allow nothing
                    return false;
                }
            });
        }
    }
}
