<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TMS\Entities\Trainee;
use Illuminate\Routing\Controller;
use Modules\TMS\Entities\Training;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\CourseEvaluationSubmission;
use Modules\TMS\Services\TrainingCourseAssessmentService;
use Modules\TMS\Entities\CourseEvaluationSubmissionDetail;
use Modules\TMS\Http\Requests\CreateCourseEvaluationRequest;
use Modules\TMS\Services\TrainingCourseMarkAllotmentTypeService;

class TrainingCourseAssessmentController extends Controller
{
    private $service;
    private $trainingCourseMarkAllotmentTypeService;

    public function __construct(
        TrainingCourseAssessmentService $trainingCourseAssessmentService,TrainingCourseMarkAllotmentTypeService $trainingCourseMarkAllotmentTypeService
    ) {
        $this->service = $trainingCourseAssessmentService;
        $this->trainingCourseMarkAllotmentTypeService = $trainingCourseMarkAllotmentTypeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $courseEvaluationLists = $this->service->courseEvaluationWithAverage($this->service::COURSE_EVALUATION_TYPE[0]);
        // dd($courseEvaluationLists);
        return view('tms::training.assessment.course_evaluation.index',
            compact('courseEvaluationLists'));
    }

    /**
     * @param TrainingCourse $course
     * @param Trainee $trainee
     * @return Factory|View
     */
    public function create(TrainingCourse $course, Trainee $trainee)
    {
        $sections = $course->evaluationSections;
        $courseObjectives = $course->objectives;

        return view(
            'tms::training.assessment.course_evaluation.create2',
            compact(
                'course',
                'trainee', 'courseObjectives',
                'sections'
            )
        );
    }
    /**
     * @param TrainingCourse $course
     * @param Trainee $trainee
     * @return Factory|View
     */
    public function questionSetupForm(TrainingCourse $course, Trainee $trainee)
    {
        $sections = $course->evaluationSections;
        $courseObjectives = $course->objectives;
        $trainings = $this->getTrainingForDropdown();
        $question_repeaters = $this->objectReturn();
        $courses = [];
        $modules = [];
        return view(
            'tms::training.assessment.course_evaluation.question-create',
            compact(
                'course',
                'trainee', 'courseObjectives',
                'sections',
                'trainings',
                'courses',
                'modules',
                'question_repeaters'
            )
        );
    }

    function objectReturn(){
        return (object)[
            'question_1' => null,
            'answer_1' => null,
            'answer_2' => null,
            'answer_3' => null,
            'answer_4' => null,
        ];
    }

    /**
     * @param Request $request
     * @param TrainingCourse $course
     * @param Trainee $trainee
     */
    public function store(Request $request, TrainingCourse $course, Trainee $trainee)
    {
        $data['questionnaires'] = $request->input('questionnaires');
        $data['objectives'] = $request->input('objectives');

        if ($this->service->store($course, $trainee, $data)) {
            Session::flash('success', trans('labels.save_success'));
            return redirect()->route('courses.public.index');
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->back()->withErrors('errors')->withInput();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Factory|RedirectResponse|View
     */
    public function show($id)
    {
        try {
            $courseEvaluationDetails = $this->service->courseEvaluationDetails($id);
            $courseEvaluationDetailsSections = collect($courseEvaluationDetails)
                ->sortBy('subSectionId')
                ->pluck('subSection', 'subSectionId')
                ->toArray();
            $courseEvaluationDetailsQuestions = collect($courseEvaluationDetails)
                ->sortBy('questionId')
                ->pluck('question', 'questionId')
                ->toArray();
            $courseEvaluationSubmission = $this->service->findOne($id, ['courses', 'trainee']);
            if ($courseEvaluationSubmission) {
                $course = $courseEvaluationSubmission->courses;
                $questionWiseAverageData = $this->service->generateChartsData($course->evaluationSections);
                // dd($course->evaluationSections);
                if (empty($questionWiseAverageData)) {
                    throw new \Exception('No data FOund !');
                }
                
                return view('tms::training.assessment.course_evaluation.show',
                    compact(
                        'courseEvaluationDetails',
                        'course',
                        'courseEvaluationSubmission',
                        'questionWiseAverageData',
                        'courseEvaluationDetailsSections',
                        'courseEvaluationDetailsQuestions'
                    )
                );
            }
            // dd('okk');
            return redirect()->route('training.course.evaluate.index')->with('error', __('labels.not_found'));

        } catch (\Exception $exception) {
            return redirect()->route('training.course.evaluate.index')->with('error',
                __('labels.generic_error_message'));
        }
    }

    /**
     * @param $id
     * @return Factory|Application|View
     */
    public
    function print(
        $id
    ) {
        $courseEvaluationDetails = $this->service->courseEvaluationDetails($id);
        $courseEvaluationDetailsSections = collect($courseEvaluationDetails)
            ->sortBy('subSectionId')
            ->pluck('subSection', 'subSectionId')
            ->toArray();
        $courseEvaluationDetailsQuestions = collect($courseEvaluationDetails)
            ->sortBy('questionId')
            ->pluck('question', 'questionId')
            ->toArray();
        $courseEvaluationSubmission = $this->service->findOne($id, ['courses', 'trainee']);
        $course = $courseEvaluationSubmission->courses;
        $questionWiseAverageData = $this->service->generateChartsData($course->evaluationSections);
        return view('tms::training.assessment.course_evaluation.print',
            compact(
                'courseEvaluationDetails',
                'course',
                'questionWiseAverageData',
                'courseEvaluationDetailsSections',
                'courseEvaluationDetailsQuestions'
            )
        );
    }

    public function viewAssesmentResult(Training $training, TrainingCourse $course)
    {
        // dd($course);
        $objectiveLabel = $this->service->getCourseEvaluationObjectiveForLabel($course);
        $sections = $course->evaluationSections;
        $allQuestionnaire = $this->service->getEvaluatedQuestions($sections);
        $allSubSections = $this->service->getAllSubSections($sections);
        $getSectionInsideSubSection = $this->service->getSectionWithSubSectionKey($sections);
        $chartsData = $this->service->generateChartsData($sections);
        // dd($sections);
        // dd($objectiveLabel, $sections, $allQuestionnaire, $allSubSections, $getSectionInsideSubSection, $chartsData);
        return view('tms::training.course.objective.evaluation_result',
            compact('training', 'course', 'objectiveLabel', 'chartsData',
                'allSubSections', 'getSectionInsideSubSection', 'allQuestionnaire'));
    }

    public function getTrainingForDropdown()
    {
        if(app()->getLocale() == 'bn'){
            $trainings = Training::all()->pluck('bangla_title','id');
        }else{
            $trainings = Training::all()->pluck('title','id');
        }
        return $trainings;
    }
    public function getCourseForDropdown()
    {
        if(app()->getLocale() == 'bn'){
            $courses = TrainingCourse::all()->pluck('name_bn','id');
        }else{
            $courses = TrainingCourse::all()->pluck('name','id');
        }
        return $courses;
    }
}
