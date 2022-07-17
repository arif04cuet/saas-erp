<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Services\EmployeeService;
use Modules\TMS\Entities\AssessmentQuestionType;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseModuleSession;
use Modules\TMS\Entities\TrainingCourseResource;
use Modules\TMS\Http\Requests\PublicSpeakerEvaluationRequest;
use Modules\TMS\Services\TrainingSpeakerAssessmentService;
use Illuminate\Http\Request;
use DB;

class TrainingSpeakerAssessmentController extends Controller
{
    private $trainingSpeakerAssessmentService;
    private $employeeService;

    public function __construct(
        TrainingSpeakerAssessmentService $trainingSpeakerAssessmentService,
        EmployeeService $employeeService
    ) {
        $this->trainingSpeakerAssessmentService = $trainingSpeakerAssessmentService;
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $evaluations = $this->trainingSpeakerAssessmentService->assessments();
        $sessionsAssessments = $this->trainingSpeakerAssessmentService->getAssessmentsBySessions2($evaluations);
        $sessionsAssessments = $this->trainingSpeakerAssessmentService->filterSessionAssessmentsByUser($sessionsAssessments);
        
        $questions = collect();
        foreach (AssessmentQuestionType::all() as $questionType) {
            foreach ($questionType->assessmentQuestions as $question) {
                $questions->push($question);
            }
        }
        return view('tms::training.assessment.index', compact('sessionsAssessments', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     * @param TrainingCourse $course
     * @param TrainingCourseModuleSession $session
     * @param TrainingCourseResource $speaker
     * @param Trainee $trainee
     * @return Response
     */
    public function create(
        TrainingCourse $course,
        TrainingCourseModuleSession $session,
        TrainingCourseResource $speaker,
        Trainee $trainee
    ) {
        $assessmentQuestionsTypes = AssessmentQuestionType::all();

        return view('tms::training.assessment.create', compact(
                'course',
                'session',
                'speaker',
                'trainee',
                'assessmentQuestionsTypes'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param PublicSpeakerEvaluationRequest $request
     * @return Response
     */
    public function store(PublicSpeakerEvaluationRequest $request)
    {

        if ($this->trainingSpeakerAssessmentService->store($request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('trainings.public.index');
    }

    public function show(Employee $employee, string $sessioName)
    {
        $percentileSessionEvaluations = $this->trainingSpeakerAssessmentService
            ->getSessionEvaluationFor($sessioName, $employee->id);

        $totalAverageScore = $percentileSessionEvaluations->sum('average_percentage') / $percentileSessionEvaluations->count();

        return view('tms::training.assessment.show', compact(
                'employee',
                'sessioName',
                'totalAverageScore',
                'percentileSessionEvaluations'
            )
        );
    }

    public function getFilter($sessionsAssessments)
    {
        $training_name = [];
        $course_name = [];
        $session_name = [];
        $module_name = [];
        $speaker_name = [];

        foreach ($sessionsAssessments as $key => $value) {

            $training_name [$key] = $value->training_name;
            $course_name [$key] = $value->course_name;
            $session_name [$key] = $value->session_name;
            $module_name [$key] = $value->module_name;
            $speaker_name [$key] = $value->speaker_name;


        }

        $data = [
            array_unique($training_name),
            array_unique($course_name),
            array_unique($session_name),
            array_unique($module_name),
            array_unique($speaker_name),
        ];

        return $data;
    }


    public function getDepandancy($sessionsAssessments, $filterName, $name)
    {
        $dependancy = [];
        foreach ($filterName as $filter) {
            $dependancy[$filter] = $sessionsAssessments->where($name, $filter);
        }

        return $dependancy;
    }

    public function getfileterData()
    {

        $evaluations = $this->trainingSpeakerAssessmentService->assessments();
        $sessionsAssessments = $this->trainingSpeakerAssessmentService->getAssessmentsBySessions2($evaluations);
        $filters = $this->getFilter($sessionsAssessments);

        $training_dependancy = $this->getDepandancy($sessionsAssessments, $filters[0], 'training_name');
        $course_dependancy = $this->getDepandancy($sessionsAssessments, $filters[1], 'course_name');
        $session_dependancy = $this->getDepandancy($sessionsAssessments, $filters[2], 'session_name');
        $module_dependancy = $this->getDepandancy($sessionsAssessments, $filters[3], 'module_name');
        $speaker_dependancy = $this->getDepandancy($sessionsAssessments, $filters[4], 'speaker_name');

        $data = [
            "course_dependancy" => $course_dependancy,
            "training_dependancy" => $training_dependancy,
            "session_dependancy" => $session_dependancy,
            "module_dependancy" => $module_dependancy,
            "speaker_dependancy" => $speaker_dependancy,
            "filters" => $filters
        ];

        return $data;
    }

    public function getJsonByCourse($courseId)
    {
        return $this->trainingSpeakerAssessmentService->getAssessmentInformationByCourse($courseId);
    }
}
