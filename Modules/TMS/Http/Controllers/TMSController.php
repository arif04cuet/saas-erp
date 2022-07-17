<?php

namespace Modules\TMS\Http\Controllers;

use Closure;
use Carbon\Carbon;
use App\Entities\User;
use Illuminate\View\View;
use Illuminate\Support\Arr;
use App\Traits\Authorizable;
use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Utilities\FiscalYearCalculator;
use Modules\TMS\Services\TraineeService;
use Spatie\Permission\Models\Permission;
use Modules\TMS\Services\TrainingsService;
use Modules\TMS\Constants\TrainingCategoryName;
use Modules\TMS\Services\TrainingCourseService;
use Modules\TMS\Services\TmsDashboardCalenderService;
use Modules\TMS\Services\TrainingCourseAssessmentService;
use Modules\TMS\Services\TrainingSpeakerAssessmentService;

class TMSController extends Controller
{
    private $can = false;
    private $traineeService;
    private $trainingService;
    private $assessmentService;
    private $userService;
    private $trainingCourseAssessmentService;
    private $tmsDashboardCalenderService;
    // use Authorizable;
    /**
     * @var TrainingCourseService
     */
    private $trainingCourseService;
    
    public function __construct(
        TraineeService $traineeService,
        TrainingsService $trainingService,
        TrainingSpeakerAssessmentService $assessmentService,
        UserService $userService,
        TrainingCourseService $trainingCourseService,
        TrainingCourseAssessmentService $trainingCourseAssessmentService,
        TmsDashboardCalenderService $tmsDashboardCalenderService
    ) {
        $this->traineeService = $traineeService;
        $this->trainingService = $trainingService;
        $this->assessmentService = $assessmentService;
        $this->userService = $userService;
        $this->trainingCourseAssessmentService = $trainingCourseAssessmentService;
        $this->tmsDashboardCalenderService = $tmsDashboardCalenderService;
        $this->trainingCourseService = $trainingCourseService;
    }


    /**
     * Display a listing of the resource.
     * @return Factory|Application|View
     */
    public function index()
    {
        // $this->authorize('view_tms_calendar');

        // calender related data
        list($fiscalYearStart, $fiscalYearEnd) = FiscalYearCalculator::getStartAndEndDates(Carbon::today()->addYear(-1));
        $calendarEvents = $this->tmsDashboardCalenderService->getEvents();
        $calendarResources = $this->tmsDashboardCalenderService->getResources();
        $calendarResourceColumns = $this->tmsDashboardCalenderService->getResourceColumns();
        // spearker evaluation date
        $shouldShowAssessments = $this->userService->isDirectorGeneral() || $this->userService->isDirectorTraining();
        $courses = $this->trainingCourseService->findAll(null, null, ['column' => 'created_at', 'direction' => 'desc']);
        $latestCourse = $courses->first() ? $courses->first() : (object)['id'=>''];
        
        $assessmentsBySessions = $this->assessmentService->getAssessmentInformationByCourse($latestCourse->id);
        if (is_null($latestCourse)) {
            $shouldShowAssessments = false;
        }
        // course evaluation data
        $courseEvaluationLists = $this->trainingCourseAssessmentService->courseEvaluationWithAverage();

        return view('tms::index', compact('fiscalYearStart',
                'fiscalYearEnd',
                'assessmentsBySessions',
                'shouldShowAssessments',
                'courseEvaluationLists',
                'calendarEvents',
                'calendarResources',
                'calendarResourceColumns',
                'courses',
                'latestCourse'
            )
        );
    }

    public function getTraineesOfTraining($trainingId)
    {
        return $this->traineeService->fetchTraineesWithID($trainingId);
    }

    /**
     * @return Closure
     */
    private function mapTrainingBatches(): Closure
    {
        return function ($training) {
            return $training->batches->map(function ($batch) use ($training) {
                return [
                    'org_names' => $training->trainingOrganizations->pluck('name')->implode(', '),
                    'training_name' => $training->title,
                    'course_name' => $batch->course->name,
                    'name' => $batch->title,
                    'start_date' => $batch->start_date,
                    'end_date' => $batch->end_date,
                    'no_of_trainees' => $batch->no_of_trainees
                ];
            });
        };
    }

    /**
     * @return Closure
     */
    private function getOfLevel($level): Closure
    {
        return function ($training) use ($level) {
            return $training->level == $level;
        };
    }

    /**
     * @param string $level
     * @return array
     */
    private function getTrainingBatchesByLevel(string $level): array
    {
        $foundationBatches = $this->trainingService->getTrainingsForGanttChart()
            ->filter($this->getOfLevel($level))
            ->filter(function ($training) {
                return in_array(
                    Arr::get($training, 'category.slug'),
                    [
                        TrainingCategoryName::FOUNDATION_REGULAR,
                        TrainingCategoryName::FOUNDATION_SPECIAL
                    ]
                );
            })
            ->flatMap($this->mapTrainingBatches())
            ->values();

        $attachmentBatches = $this->trainingService->getTrainingsForGanttChart()
            ->filter($this->getOfLevel($level))
            ->filter(function ($training) {
                return Arr::get($training, 'category.slug') == TrainingCategoryName::ATTACHMENT;
            })
            ->flatMap($this->mapTrainingBatches())
            ->values();

        $orgDemandedBatches = $this->trainingService->getTrainingsForGanttChart()
            ->filter($this->getOfLevel($level))
            ->filter(function ($training) {
                return Arr::get($training, 'category.slug') == TrainingCategoryName::ORGANIZATION_DEMAND;
            })
            ->flatMap($this->mapTrainingBatches())
            ->values();

        $projectBatches = $this->trainingService->getTrainingsForGanttChart()
            ->filter($this->getOfLevel($level))
            ->filter(function ($training) {
                return in_array(
                    Arr::get($training, 'category.slug'),
                    [
                        TrainingCategoryName::PROJECT_INTERNAL,
                        TrainingCategoryName::PROJECT_EXTERNAL,
                    ]
                );
            })
            ->flatMap($this->mapTrainingBatches())
            ->values();

        $selfInititatedBatches = $this->trainingService->getTrainingsForGanttChart()
            ->filter($this->getOfLevel($level))
            ->filter(function ($training) {
                return Arr::get($training, 'category.slug') == TrainingCategoryName::SELF_INITIATED;
            })
            ->flatMap($this->mapTrainingBatches())
            ->values();

        $workshopSeminarAndConfBatches = $this->trainingService->getTrainingsForGanttChart()
            ->filter($this->getOfLevel($level))
            ->filter(function ($training) {
                return in_array(
                    Arr::get($training, 'category.slug'),
                    [
                        TrainingCategoryName::WORKSHOP,
                        TrainingCategoryName::SEMINAR,
                        TrainingCategoryName::CONFERENCE,
                    ]
                );
            })
            ->flatMap($this->mapTrainingBatches())
            ->values();

        $orientationBatches = $this->trainingService->getTrainingsForGanttChart()
            ->filter($this->getOfLevel($level))
            ->filter(function ($training) {
                return Arr::get($training, 'category.slug') == TrainingCategoryName::ORIENTATION;
            })
            ->flatMap($this->mapTrainingBatches())
            ->values();
        return array(
            $foundationBatches,
            $attachmentBatches,
            $orgDemandedBatches,
            $projectBatches,
            $selfInititatedBatches,
            $workshopSeminarAndConfBatches,
            $orientationBatches
        );
    }

}
