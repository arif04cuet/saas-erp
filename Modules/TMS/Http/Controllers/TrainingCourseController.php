<?php

namespace Modules\TMS\Http\Controllers;

use Psy\Util\Str;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\TMS\Entities\Training;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Services\TrainingsService;
use Modules\TMS\Services\TrainingVenueService;
use Modules\TMS\Services\TrainingCourseService;
use Modules\TMS\Repositories\TrainingCourseRepository;
use Modules\TMS\Services\TrainingParticipantTypeService;
use Modules\TMS\Http\Requests\StoreUpdateTrainingCourseRequest;

class TrainingCourseController extends Controller
{
    const COURSE_VIEW = 'tms::training.course.';
    private $trainingService;
    private $courseService;
    private $venueService;
    private $trainingParticipantTypeService;
    private $trainingCourseRepository;

    /**
     * TrainingCourseController constructor.
     * @param TrainingCourseService $courseService
     * @param TrainingVenueService $venueService
     */
    public function __construct(TrainingsService $trainingService, TrainingCourseService $courseService, TrainingVenueService $venueService, TrainingParticipantTypeService $trainingParticipantTypeService, TrainingCourseRepository $trainingCourseRepository)
    {
        $this->trainingService = $trainingService;
        $this->courseService = $courseService;
        $this->venueService = $venueService;
        $this->trainingParticipantTypeService = $trainingParticipantTypeService;
        $this->trainingCourseRepository = $trainingCourseRepository;
    }

    public function index(Training $training)
    {
        $course = $this->courseService->findBy(
            ['training_id' => $training->id],
            null,
            ['column' => 'id', 'direction' => 'desc']
        )->first();
        if (!$course) {
            // previously user had to create course manually, now create for them default course
            // So for the test training data which did not have course default, might cause error  [BEP-602]
            return redirect()->route('training.show', $training)->with('error', 'Course Detail Not Found !');
        }
        return view(self::COURSE_VIEW . 'show', compact('training', 'course'));
    }

    public function trainingWiseCourse(Training $training)
    {
        $courses = $this->courseService->findBy(
            ['training_id' => $training->id],
            null,
            ['column' => 'id', 'direction' => 'desc']
        );
        return view(self::COURSE_VIEW . 'training-wise-course-list', compact('training', 'courses'));
    }
    public function courseListOfflineTraining()
    {
        $trainingIds = $this->trainingService->getOfflineTrainings()->pluck('id');
        $courses = $this->courseService->getOfflineCourse($trainingIds);
        return view(self::COURSE_VIEW . 'offline_course.index', compact('courses'));
    }
    public function courseListOnlineTraining()
    {
        $trainingIds = $this->trainingService->getOnlineTrainings()->pluck('id');
        $courses = $this->courseService->getOnlineCourse($trainingIds);
        return view(self::COURSE_VIEW . 'online_course.index', compact('courses'));
    }

    public function segment($url, $index, $default)
    {
        return Arr::get($this->segments($url), $index - 1, $default);
    }

    public function segments($url)
    {
        $segments = explode('/', $url);
        return array_values(array_filter($segments, function ($v) {
            return $v != '';
        }));
    }

    public function create(Training $training)
    {
        $uid = 'TMS-TR-CR-' . time();
        $venue_title = !App::isLocale('bn') ? 'title' : 'title_bn';
        $venues = $this->venueService->findAll()->pluck($venue_title, 'id');
        $participants = $training->participants->pluck('title')->implode(', ');
        $participant_type_title = !App::isLocale('bn') ? 'title' : 'bangla_title';
        $trainee_types = $this->trainingParticipantTypeService->findAll()->pluck($participant_type_title, 'id');
        $trainingStartDate = Carbon::parse($training->start_date)->format('m/d/Y');
        $trainingEndDate = Carbon::parse($training->end_date)->format('m/d/Y');
        list($startDate, $endDate) = [$trainingStartDate, $trainingEndDate];
        $through_training = $training->through_training;

        if ($through_training == 'online') {
            return view(
                self::COURSE_VIEW . 'create',
                compact(
                    'uid',
                    'venues',
                    'training',
                    'participants',
                    'startDate',
                    'endDate',
                    'through_training',
                )
            );
        }
        return view(
            self::COURSE_VIEW . 'create',
            compact(
                'uid',
                'venues',
                'training',
                'participants',
                'startDate',
                'endDate',
                'through_training',
                'trainee_types',
            )
        );
    }

    public function store(StoreUpdateTrainingCourseRequest $request, Training $training)
    {
        if ($course = $this->courseService->store($request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('success', trans('labels.save_fail'));
        }

        return redirect()->route('trainings.courses.show', [$training->id, $course->id]);
    }

    public function show(Training $training, TrainingCourse $course)
    {
        return view(self::COURSE_VIEW . 'show', compact('training', 'course'));
    }

    public function edit(Training $training, TrainingCourse $course)
    {
        $uid = $course->uid;
        $venue_title = !App::isLocale('bn') ? 'title' : 'title_bn';
        $venues = $this->venueService->findAll()->pluck($venue_title, 'id');
        $participants = $training->participants->pluck('title')->implode(', ');
        $participant_type_title = !App::isLocale('bn') ? 'title' : 'bangla_title';
        $trainee_types = $this->trainingParticipantTypeService->findAll()->pluck($participant_type_title, 'id');
        $trainingStartDate = Carbon::parse($training->start_date)->format('m/d/Y');
        $trainingEndDate = Carbon::parse($training->end_date)->format('m/d/Y');
        list($startDate, $endDate) = [$trainingStartDate, $trainingEndDate];
        $through_training = $training->through_training;

        if ($through_training == 'online') {
            return view(
                self::COURSE_VIEW . 'edit',
                compact(
                    'training',
                    'course',
                    'uid',
                    'venues',
                    'participants',
                    'startDate',
                    'endDate',
                    'through_training'
                )
            );
        }
        return view(
            self::COURSE_VIEW . 'edit',
            compact(
                'training',
                'course',
                'uid',
                'venues',
                'participants',
                'startDate',
                'endDate',
                'trainee_types',
                'through_training'
            )
        );
    }

    public function update(StoreUpdateTrainingCourseRequest $request, Training $training, TrainingCourse $course)
    {
        if ($this->courseService->updateRequest($course, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->route('trainings.courses.show', [$training->id, $course->id]);
    }

    public function getAllCourseByTrainingId($trainingId)
    {
        return $this->trainingCourseRepository->findBy(['training_id' => $trainingId]);
    }
}
