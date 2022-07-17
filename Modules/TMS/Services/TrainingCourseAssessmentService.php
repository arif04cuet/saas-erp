<?php


namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;
use function foo\func;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\CourseEvaluationSubmission;
use Modules\TMS\Entities\CourseEvaluationSubmissionDetail;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Repositories\CourseEvaluationSubmissionDetailRepository;
use Modules\TMS\Repositories\CourseEvaluationSubmissionRepository;
use Modules\TMS\Traits\MenuAccessTrait;

class TrainingCourseAssessmentService
{
    use CrudTrait;
    use MenuAccessTrait;

    public const COURSE_EVALUATION_TYPE = ['filtered'];

    private $submissionRepository;
    private $submissionDetailRepository;

    public function __construct(
        CourseEvaluationSubmissionRepository $courseEvaluationSubmissionRepository,
        CourseEvaluationSubmissionDetailRepository $courseEvaluationSubmissionDetailRepository
    ) {
        $this->submissionRepository = $courseEvaluationSubmissionRepository;
        $this->submissionDetailRepository = $courseEvaluationSubmissionDetailRepository;

        $this->setActionRepository($this->submissionRepository);
    }

    public function assessments()
    {
        $this->can = false;

        $this->isDirector(auth()->user());
        $this->isTrainingDivisionEmployee(auth()->user());
        if ($this->can) {
            //dd('Director');
            $assessments = CourseEvaluationSubmission::with('courses', 'trainee')->get();

            return $assessments->map(function ($assessment) {
                return [
                    'evaluationId' => $assessment->id,
                    'trainingName' => $assessment->courses->training->title,
                    'courseName' => $assessment->courses->name,
                    'courseNameBn' => $assessment->courses->name_bn,
                    'evaluator' => $assessment->trainee->english_name,
                    'evaluatorBn' => $assessment->trainee->bangla_name
                ];
            })->values();
        }

        $this->isTrainingCourseAdministrator(auth()->user());
        if ($this->can) {
            //dd('Admin');
            $assessments = CourseEvaluationSubmission::with('courses', 'trainee')->get();

            return $assessments = $assessments->flatMap(function ($assessment) {
                return $assessment->courses->resources->map(function ($resource) use ($assessment) {
                    $resource = $resource->reference_entity_id;

                    return $output = [
                        'evaluationId' => $assessment->id,
                        'trainingName' => $assessment->courses->training->title,
                        'courseName' => $assessment->courses->name,
                        'courseNameBn' => $assessment->courses->name_bn,
                        'evaluator' => $assessment->trainee->english_name,
                        'evaluatorBn' => $assessment->trainee->bangla_name,
                        'resourceId' => $resource
                    ];
                });
            })->where('resourceId', optional(auth()->user()->employee)->id)->values();
        }

        $this->isTrainingCourseResource(auth()->user());
        if ($this->can) {
            //dd('User');
            $assessments = CourseEvaluationSubmission::with('courses', 'trainee')->get();

            return $assessments = $assessments->flatMap(function ($assessment) {
                return $assessment->courses->resources->map(function ($resource) use ($assessment) {
                    $resource = $resource->reference_entity_id;

                    return $output = [
                        'evaluationId' => $assessment->id,
                        'trainingName' => $assessment->courses->training->title,
                        'courseName' => $assessment->courses->name,
                        'courseNameBn' => $assessment->courses->name_bn,
                        'evaluator' => $assessment->trainee->english_name,
                        'evaluatorBn' => $assessment->trainee->bangla_name,
                        'resourceId' => $resource
                    ];
                });
            })->where('resourceId', optional(auth()->user()->employee)->id)->values();
        }
    }

    /**
     * @param null $employeeId
     * @return \App\Repositories\Contracts\Collection
     */
    public function courseEvaluationsFilteredBySpeaker($employeeId = null)
    {
        /**
         * Checking if the user is Director Training or Course Administrator
         */
        $this->can = false;
        $this->isDirector(auth()->user());
        $auth = $this->can;
        $courseEvaluations = $this->findAll(null, ['courses', 'details'])
            ->filter(function ($item) use ($employeeId, $auth) {
                if ($auth) {
                    return true;
                }
                // dd($item, $employeeId, $auth);
                $employeeId = $employeeId ?? optional(Auth::user()->employee)->id;
                // dd($employeeId);
                $resourceEmployeeIds = [];
                $resources = optional($item->courses)->resources;
                $administrations = optional($item->courses)->administrations->pluck('employee_id')->toArray();
                // dd($administrations);
                foreach ($resources as $resource) {
                    if ($resource->reference_entity == Employee::class) {
                        $resourceEmployeeIds[] = $resource->reference_entity_id;
                    }
                }
                return in_array($employeeId, $resourceEmployeeIds) || in_array($employeeId, $administrations);
                //dd('how');
            });
        // dd($courseEvaluations);
        return $courseEvaluations;
    }

    public function courseEvaluationWithAverage($filterType = null)
    {
        if ($filterType == self::COURSE_EVALUATION_TYPE[0]) {
            $courseEvaluationLists = $this->courseEvaluationsFilteredBySpeaker();
        } else {
            $courseEvaluationLists = $this->findAll(null, ['courses', 'details']);
        }
        
        $output = [];
        foreach ($courseEvaluationLists as $courseEvaluationList) {

            $totalMark = 0;
            $countArray = count($courseEvaluationList->details) - 1; // To skip the user comment from count
            foreach ($courseEvaluationList->details as $key => $detail) {
                if (isset($detail->option['mark'])) {
                    $totalMark += $detail->option['mark'];
                }
            }

            if($courseEvaluationList->courses){
                $courseDetails = [
                    'trainingName' => $courseEvaluationList->courses->training['title'],
                    'trainingId' => $courseEvaluationList->courses->training['id'],
                    'courseName' => $courseEvaluationList->courses['name'],
                    'courseId' => $courseEvaluationList->courses['id'],
                    'courseEvaluationId' => $courseEvaluationList->id,
                    'averageMark' => (($totalMark / $countArray) * 100) / 5
                ];
                $output[] = $courseDetails;
            }
            
        };

        return collect($output)->groupBy('courseId')->map(function ($courseGroup) {
            return $courseGroup->flatMap(function ($course) use ($courseGroup) {
                return [
                    'trainingName' => $course['trainingName'],
                    'trainingId' => $course['trainingId'],
                    'courseName' => $course['courseName'],
                    'courseId' => $course['courseId'],
                    'courseEvaluationId' => $course['courseEvaluationId'],
                    'averageMark' => $courseGroup->avg('averageMark'),
                    'evaluatorCount' => count($courseGroup)
                ];
            });
        })->values();
    }

    public function filters($activeEvaluationCourses)
    {
        foreach ($activeEvaluationCourses as $activeEvaluationCourse) {
            $courseIds[] = $activeEvaluationCourse->training_course_id;
        }

        $trainingDetails = TrainingCourse::whereIn(
            'id', $courseIds
        )->get();

        foreach ($trainingDetails as $trainingDetail) {
            $trainingIds[] = $trainingDetail->training_id;
        }

        $trainees = Trainee::whereIn(
            'training_id', $trainingIds
        )->get();

        return $trainees->pluck('id')->toarray();
    }

    public function evaluatedTrainees()
    {
        return CourseEvaluationSubmission::all()->pluck('trainee_id')->toArray();
    }

    public function getAllTrainings()
    {
        return Training::all();
    }

    public function getAllCourses()
    {
        return TrainingCourse::all();
    }

    public function store(TrainingCourse $course, Trainee $trainee, $data = [])
    {
        return DB::transaction(function () use ($course, $trainee, $data) {
            $submission = $this->submissionRepository->save([
                'training_course_id' => $course->id,
                'trainee_id' => $trainee->id,
            ]);

            if ($submission) {
                if (!empty($data)) {
                    $details = [];
                    foreach ($data['questionnaires'] as $key => $questionnaire) {
                        $arr = explode('|', $key);
                        $questionnaireId = $arr[0];
                        $subSectionId = $arr[1];

                        $details[] = new CourseEvaluationSubmissionDetail([
                            'course_evaluation_submission_id' => $submission->id,
                            'question_type' => 'regular_question',
                            'course_evaluation_sub_section_id' => $subSectionId,
                            'training_course_objective_id' => null,
                            'course_evaluation_questionnaire_id' => $questionnaireId,
                            'course_evaluation_option_id' => !is_array($questionnaire) ? $questionnaire : null,
                            'answer' => is_array($questionnaire) ? $questionnaire[0] : null,
                        ]);
                    }
                    if (isset($data['objectives'])) {
                        foreach ($data['objectives'] as $key => $objective) {
                            $arr = explode('|', $key);
                            $objectiveId = $arr[0];
                            $subSectionId = $arr[1];
                            $details[] = new CourseEvaluationSubmissionDetail([
                                'course_evaluation_submission_id' => $submission->id,
                                'question_type' => 'objective',
                                'course_evaluation_sub_section_id' => $subSectionId,
                                'training_course_objective_id' => $objectiveId,
                                'course_evaluation_questionnaire_id' => null,
                                'course_evaluation_option_id' => !is_array($objective) ? $objective : null,
                                'answer' => is_array($objective) ? $objective[0] : null,
                            ]);
                        }
                    }

                    return $submission->details()->saveMany($details);
                }
            }

            return false;
        });
    }

    public function courseEvaluationDetails($id)
    {
        $submissionDetails = CourseEvaluationSubmissionDetail::where('course_evaluation_submission_id', $id)
            ->with('option', 'questionnaire', 'objective', 'subSection')
            ->get();
        $array = null;

        foreach ($submissionDetails as $submissionDetail) {
            if (isset($submissionDetail['objective'])) {
                $question = $submissionDetail['objective']['content'] ?? trans('labels.not_found');
                $questionId = $submissionDetail['objective']['id'] ;
                $type = 'objective';
            } else {
                $question = $submissionDetail['questionnaire']['title_en'] ?? trans('labels.not_found');
                $questionId = $submissionDetail['questionnaire']['id'] ;
                $type = 'questionnaire';
            }
            $array[] = [
                'subSection' => $submissionDetail['subSection']['title_en'] ?? trans('labels.not_found'),
                'subSectionId' => $submissionDetail['subSection']['id'] ,
                'question' => $question,
                'questionId' => $questionId,
                'optionName' => $submissionDetail['option']['title_en'] ?? trans('labels.not_found'),
                'optionNameBn' => $submissionDetail['option']['title_bn'] ?? trans('labels.not_found'),
                'type' => $type,
                'mark' => $submissionDetail['option']['mark'] ?? trans('labels.not_found')
            ];
        }
        return $array;

    }

    public function courseDetail($id)
    {
        $courseDetail = CourseEvaluationSubmission::where('id', $id)
            ->with('courses', 'trainee')
            ->first();
        return $courseDetail;
    }

    //return all objective for use in label.
    public function getCourseEvaluationObjectiveForLabel($course)
    {
        $objectiveLabel = [];
        foreach ($course->objectives as $objective) {
            $objectiveLabel[] = $objective->content;
        }
        return $objectiveLabel;
    }

    //returning all question related to course. But except of objective.
    public function getAllQuestionsForCharts($sections)
    {
        $allQuestionnaire = [];
        foreach ($sections as $key => $section) {
            if ($key) { //when $key is zero it means it is objective. So no need to retrieve the regular question.
                foreach ($section->subSections as $subSection) {
                    //dd('returning all question from sub section', $subSection->questionnaires);
                    if ($subSection->questionnaires) {
                        if (count($subSection->questionnaires) > 6) {
                            $wordPerLine = 1;
                        } else {
                            $wordPerLine = 2;
                        }

                        foreach ($subSection->questionnaires as $questionId => $question) {
                            $array = array_chunk(explode(' ', $question->title_en), $wordPerLine);
                            foreach ($array as $itemKey => $item) {
                                $output = implode(" ", $item);
                                $allQuestionnaire[$subSection->id][$questionId][$itemKey] = $output;
                            }

                        }
                    }
                }
            }

        }

        return $allQuestionnaire;
    }

    public function getEvaluatedQuestions($sections)
    {
        $testData = [];
        $outputData = [];
        foreach ($sections as $key => $section) {
            if ($key) {
                foreach ($section->subSections as $subSection) {
                    if ($subSection->questionnaires) {
                        // dd($subSection->evaluationSubmissionDetails);
                        foreach ($subSection->evaluationSubmissionDetails as $submissionDetail) {
                            $testData[$subSection->id][$submissionDetail->questionnaire->id] = $submissionDetail->questionnaire->title_en;
                        }
                    }
                    if (isset($testData[$subSection->id])) {
                        ksort($testData[$subSection->id]);
                        $testData[$subSection->id] = array_values($testData[$subSection->id]);
                    }
                }
            }
        }

        if (count($testData) > 0) {
            foreach ($testData as $subSectionId => $questions) {
                if (count($questions) > 6) {
                    $wordPerLine = 1;
                } else {
                    $wordPerLine = 2;
                }
                foreach ($questions as $questionId => $question) {
                    $array = array_chunk(explode(' ', $question), $wordPerLine);
                    foreach ($array as $itemKey => $item) {
                        $output = implode(" ", $item);
                        $outputData[$subSectionId][$questionId][$itemKey] = $output;
                    }

                }
            }
        }
        return $outputData;
    }

    public function getAllSubSections($sections)
    {
        $allSubSections = [];
        foreach ($sections as $key => $section) {
            foreach ($section->subSections as $subSection) {
                $allSubSections[$subSection->id] = $subSection;

            }
        }
        return $allSubSections;
    }


    // @getSectionWithSubSectionKey will return the section. And subsection id is used as key.
    public function getSectionWithSubSectionKey($sections)
    {
        $getSectionInsideSubSection = [];
        foreach ($sections as $key => $section) {
            foreach ($section->subSections as $subSection) {
                $getSectionInsideSubSection[$subSection->id][] = $section->toArray();

            }
        }
        return $getSectionInsideSubSection;
    }


    public function generateChartsData($sections)
    {

        //dd($sections);
        $markWiseNumberOfVote = $this->getMarkWiseNumberOfVote($sections);
        // dd($markWiseNumberOfVote);
        $countNumberOfVoteAndMultiplication = $this->countAndMultiplicationNumberOfVote($markWiseNumberOfVote);
        // dd($countNumberOfVoteAndMultiplication);

        $chartsData = [];
        $totalMultiplyResult = 0;
        $totalNumberOfVote = 0;
        $currentObjectiveId = 0;
        foreach ($countNumberOfVoteAndMultiplication as $sectionType => $subSectionWiseEvaluationMark) {
            foreach ($subSectionWiseEvaluationMark as $subSectionId => $selectedOptions) {
                foreach ($selectedOptions as $quesOrObjectiveId => $options) {
                    if ($currentObjectiveId != $quesOrObjectiveId) {
                        $totalMultiplyResult = 0;
                        $totalNumberOfVote = 0;
                    }
                    foreach ($options as $key => $option) {
                        $totalMultiplyResult += $option['multiply_result'];
                        $totalNumberOfVote += $option['number_of_vote'];
                        $chartsData[$sectionType][$subSectionId][$quesOrObjectiveId] = round($totalMultiplyResult / $totalNumberOfVote,
                            2);
                    }
                    $currentObjectiveId = $quesOrObjectiveId;

                }
            }
        }
        // dd($chartsData);
        return $chartsData;
    }

    //return mark wise array
    public function getMarkWiseNumberOfVote($sections)
    {
        // dd($sections);
        $markWiseNumberOfVote = [];
        foreach ($sections as $key => $section) {
            // dd($section);
            foreach ($section->subSections as $subSection) {
                // dd($subSection);
                foreach ($subSection->evaluationSubmissionDetails as $submissionDetail) {
                //    dd($submissionDetail);
                    if (isset($submissionDetail->option->mark)) {
                        if ($submissionDetail->training_course_objective_id) {
                            $objectiveId = $submissionDetail->training_course_objective_id;
                            $markWiseNumberOfVote['objective'][$subSection->id][$objectiveId][$submissionDetail->option->mark][] = $submissionDetail->option->mark;
                        } elseif ($submissionDetail->course_evaluation_questionnaire_id) {
                            $questionId = $submissionDetail->course_evaluation_questionnaire_id;
                            $markWiseNumberOfVote['questionnaire'][$subSection->id][$questionId][$submissionDetail->option->mark][] = $submissionDetail->option->mark;
                        }
                    }
                }
            }
        }
        return $markWiseNumberOfVote;
    }

    // counting the selected option and multiplying it and return the array
    public function countAndMultiplicationNumberOfVote($markWiseNumberOfVote)
    {
        $countNumberOfVoteAndMultiplication = [];
        foreach ($markWiseNumberOfVote as $sectionType => $subSections) {
            foreach ($subSections as $subSectionId => $subSection) {
                foreach ($subSection as $questionId => $options) {
                    foreach ($options as $mark => $option) {
                        $countNumberOfVoteAndMultiplication[$sectionType][$subSectionId][$questionId][$mark]['multiply_result'] = $mark * count($option);
                        $countNumberOfVoteAndMultiplication[$sectionType][$subSectionId][$questionId][$mark]['number_of_vote'] = count($option);
                    }
                }
            }
        }
        return $countNumberOfVoteAndMultiplication;
    }


}
