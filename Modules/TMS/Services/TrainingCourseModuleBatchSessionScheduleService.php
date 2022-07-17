<?php


namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingCourseBatch;
use Modules\TMS\Entities\TrainingCourseModule;
use Modules\TMS\Entities\TrainingCourseModuleBatchSessionSchedule;
use Modules\TMS\Repositories\TrainingCourseModuleBatchSessionScheduleRepository;
use Modules\TMS\Repositories\TrainingCourseModuleRepository;
use Modules\TMS\Repositories\TrainingCourseModuleSessionRepository;
use Modules\TMS\Traits\MenuAccessTrait;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseModuleSession;
use Modules\TMS\Repositories\TrainingCourseBatchRepository;
use Modules\TMS\Repositories\TrainingCourseRepository;

class TrainingCourseModuleBatchSessionScheduleService
{
    use CrudTrait, MenuAccessTrait;

    /**
     * @var $repository
     */
    private $repository;

    /**
     * @var $moduleRepository
     */
    private $sessionRepository;

    /**
     * @var $trainingCourseModuleSessionService
     */
    private $trainingCourseModuleSessionService;

    private $trainingCourseAdministrationService;

    private $trainingCourseResourceService;
    private $trainingCourseModuleRepository;
    private $trainingCourseBatchRepository;
    private $trainingCourseRepository;
    private $trainingCourseModuleSessionRepository;

    protected $filters = [
        [
            'key' => 'training',
            'label' => 'title',
            'data' => [],
        ],
        [
            'key' => 'course',
            'label' => 'title',
            'data' => []
        ],
        [
            'key' => 'module',
            'label' => 'title',
            'data' => []
        ],
        [
            'key' => 'session',
            'label' => 'title',
            'data' => []
        ],
        [
            'key' => 'batch',
            'label' => 'batch',
            'data' => []
        ]
    ];

    /**
     * TrainingCourseModuleBatchSessionScheduleService constructor.
     * @param TrainingCourseModuleBatchSessionScheduleRepository $repository
     * @param TrainingCourseModuleSessionRepository $sessionRepository
     * @param TrainingCourseModuleSessionService $trainingCourseModuleSessionService
     */
    public function __construct(
        TrainingCourseModuleBatchSessionScheduleRepository $repository,
        TrainingCourseModuleSessionRepository $sessionRepository,
        TrainingCourseModuleSessionService $trainingCourseModuleSessionService,
        TrainingCourseAdministrationService $trainingCourseAdministrationService,
        TrainingCourseResourceService $trainingCourseResourceService,
        TrainingCourseModuleRepository $trainingCourseModuleRepository,
        TrainingCourseBatchRepository $trainingCourseBatchRepository,
        TrainingCourseRepository $trainingCourseRepository,
        TrainingCourseModuleSessionRepository $trainingCourseModuleSessionRepository
    ) {
        $this->trainingCourseModuleSessionService = $trainingCourseModuleSessionService;
        $this->trainingCourseAdministrationService = $trainingCourseAdministrationService;
        $this->trainingCourseResourceService = $trainingCourseResourceService;
        $this->sessionRepository = $sessionRepository;
        $this->repository = $repository;
        $this->trainingCourseModuleRepository = $trainingCourseModuleRepository;
        $this->trainingCourseBatchRepository = $trainingCourseBatchRepository;
        $this->trainingCourseRepository = $trainingCourseRepository;
        $this->trainingCourseModuleSessionRepository = $trainingCourseModuleSessionRepository;
        $this->setActionRepository($this->repository);
    }

    /**
     * @param TrainingCourseBatch $batch
     * @param TrainingCourseModule $module
     * @param array $data
     * @return mixed
     */
    public function update(TrainingCourseBatch $batch, TrainingCourseModule $module, $data = [])
    {
        return DB::transaction(function () use ($batch, $module, $data) {

            $sessionIds = array_column($data, 'training_course_module_session_id');

            $sessions = $this->trainingCourseModuleSessionService->findBy([
                'training_course_module_id' => $module->id
            ])->filter(function ($session) use ($sessionIds) {
                return !in_array($session->id, $sessionIds);
            })->pluck('id')
                ->toArray();

            $events = $this->repository->findIn('training_course_module_session_id', $sessions)
                ->filter(function ($event) use ($batch) {
                    return $event->training_course_batch_id == $batch->id;
                })->each(function ($event) {
                    $event->delete();
                });

            $data = collect($data)->filter(function ($schedule) use ($batch) {
                return $schedule['training_course_batch_id'] == $batch->id;
            });

            $update = $data->each(function ($schedule) {
                $schedule['date'] = Carbon::parse($schedule['date'])->format('Y-m-d');
                $schedule['start'] = Carbon::parse($schedule['start']);
                $schedule['end'] = Carbon::parse($schedule['end']);

                $this->repository->getModel()->updateOrCreate(
                    [
                        'training_course_module_session_id' => $schedule['training_course_module_session_id'],
                        'training_course_batch_id' => $schedule['training_course_batch_id']
                    ],
                    $schedule
                );
            });

            return $update;
        });
    }

    /**
     * @param TrainingCourseBatch $batch
     * @param TrainingCourseModule $module
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|\Illuminate\Support\Collection
     */
    public function events(TrainingCourseBatch $batch, TrainingCourseModule $module)
    {
        $events = $this->repository->findAll()
            ->whereBetween('start', [$batch->start_date, $batch->end_date])
            ->whereBetween('end', [$batch->start_date, $batch->end_date])
            ->where('training_course_batch_id', $batch->id)
            ->flatten()
            ->sortByDesc('created_at')
            ->take(100)
            ->filter(function ($event) {
                return !is_null($event->session);
            })
            ->map(function ($event) use ($batch, $module) {
                $schedule = [
                    'id' => $event->training_course_module_session_id,
                    'resourceId' => $event->training_venue_id,
                    'start' => $event->start,
                    'end' => $event->end,
                    'title' => $this->getEventTitle($event),
                    'venue' => $event->training_venue_id,
                    'extendedProps' => [
                        'resource' => $event->training_venue_id,
                        'batch' => $batch->id,
                        'module' => $event->session->module->id
                    ]
                ];

                if ($event->session->module->id == $module->id) {
                    $schedule['extendedProps']['delete'] = true;
                }

                return $schedule;
            });

        $events = $events->merge($this->recurringEvents($batch, $module));

        return $events;
    }

    /**
     * @param TrainingCourseBatch $batch
     * @param TrainingCourseModule $module
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function sessions(TrainingCourseBatch $batch, TrainingCourseModule $module)
    {
        $sessions = $this->sessionRepository->findBy([
            'training_course_module_id' => $module->id
        ])->map(function ($session) use ($batch) {
            $isScheduled = $this->repository->findBy([
                'training_course_module_session_id' => $session->id,
                'training_course_batch_id' => $batch->id
            ])->first();

            $session->is_scheduled = $isScheduled ? true : false;

            return $session;
        });

        return $sessions;
    }

    public function filters($schedules)
    {
        if ($schedules instanceof Collection) {

            $schedules->each(function ($schedule) {
                $this->seedFilter($schedule);
            });
        }

        return collect($this->filters);
    }

    public function scheduledSessions($entity)
    {
        $className = get_class($entity);

        $scheduleSessions = $this->repository->findAll();

        switch ($className) {
            case Training::class:
                $scheduleSessions = $scheduleSessions->filter(function ($schedule) use ($entity) {
                    $trainingId = optional($schedule->session->module->course->training)->id;

                    return $trainingId === $entity->id;
                });
                break;
            default:
                break;
        }

        return $scheduleSessions;
    }

    public function schedules(Carbon $date)
    {
        $schedules = $this->repository->findBy([
            'date' => $date
        ]);

        return $schedules;
    }

    private function seedFilter($schedule)
    {
        collect($this->filters)->each(function ($filter, $key) use ($schedule) {
            switch ($filter['key']) {
                case 'training':
                    //before moving on.. make sure we have a training
                    if (optional($schedule->session->module->course->training)) {
                        if (isset($this->filters[$key]['data'])) {
                            if (
                                array_search(
                                    optional($schedule->session->module->course->training)->id,
                                    array_column($this->filters[$key]['data'], 'id')
                                ) === false
                            ) {
                                $training = $this->trainingCourseRepository->getTrainingBytrainingId($schedule->session->module->course->training->id);
                                $this->filters[$key]['data'][] = [
                                    'id' => optional($schedule->session->module->course->training)->id,
                                    'title' => optional($schedule->session->module->course->training)->title,
                                    'courses_under_training' => $training,
                                ];
                            }
                        }
                    }
                    break;
                case 'course':
                    if (optional($schedule->session->module->course)) {
                        if (isset($this->filters[$key]['data'])) {
                            if (
                                array_search(
                                    optional($schedule->session->module->course)->id,
                                    array_column($this->filters[$key]['data'], 'id')
                                ) === false
                            ) {

                                $moduls = $this->trainingCourseModuleRepository->getModelByTrainingCourseId($schedule->session->module->course->id);
                                $batches = $this->trainingCourseBatchRepository->getBatchsByTrainingCourseId($schedule->session->module->course->id);

                                $this->filters[$key]['data'][] = [
                                    'id' => optional($schedule->session->module->course)->id,
                                    'title' => optional($schedule->session->module->course)->name,
                                    'moduls' => $moduls,
                                    'batches' => $batches
                                ];
                            }
                        }
                    }
                    break;
                case 'module':
                    if (optional($schedule->session->module)) {
                        if (isset($this->filters[$key]['data'])) {
                            if (
                                array_search(
                                    optional($schedule->session->module)->id,
                                    array_column($this->filters[$key]['data'], 'id')
                                ) === false
                            ) {
                                $sessions = $this->trainingCourseModuleSessionRepository->getSessionbyTrainingCourseModuleId($schedule->session->module->id);
                                $this->filters[$key]['data'][] = [
                                    'id' => optional($schedule->session->module)->id,
                                    'title' => optional($schedule->session->module)->title,
                                    'sessions' => $sessions
                                ];
                            }
                        }
                    }
                    break;
                case 'session':
                    if (optional($schedule->session)) {
                        if (isset($this->filters[$key]['data'])) {
                            if (
                                array_search(
                                    optional($schedule->session)->id,
                                    array_column($this->filters[$key]['data'], 'id')
                                ) === false
                            ) {
                                $this->filters[$key]['data'][] = [
                                    'id' => optional($schedule->session)->id,
                                    'title' => optional($schedule->session)->title,
                                    'speaker' => optional($schedule->session->speaker)->getResourceName()
                                ];
                            }
                        }
                    }
                    break;
                case 'batch':
                    if (optional($schedule->batch)) {
                        if (isset($this->filters[$key]['data'])) {
                            if (
                                array_search(
                                    optional($schedule->batch)->id,
                                    array_column($this->filters[$key]['data'], 'id')
                                ) === false
                            ) {
                                $this->filters[$key]['data'][] = [
                                    'id' => optional($schedule->batch)->id,
                                    'title' => optional($schedule->batch)->title
                                ];
                            }
                        }
                    }
                    break;
                default:
                    break;
            }
        });
    }

    public function sessionsScheduled()
    {
        $this->can = false;

        $this->isDirector(auth()->user());
        $this->isTrainingDivisionEmployee(auth()->user());

        if ($this->can) {
            $sessionsScheduled = $this->repository->findAll();

            return $sessionsScheduled;
        }

        $this->isTrainingCourseAdministrator(auth()->user());

        if ($this->can) {

            $courses = $this->trainingCourseAdministrationService->findBy([
                'employee_id' => optional(auth()->user()->employee)->id
            ])->unique()
                ->pluck('training_course_id')
                ->toArray();

            $sessionsScheduled = $this->repository->findAll()
                ->filter(function ($schedule) use ($courses) {
                    return in_array(optional($schedule->session->module->course)->id, $courses);
                });

            return $sessionsScheduled;
        }

        $this->isTrainingCourseResource(auth()->user());

        if ($this->can) {
            $sessionsScheduled = $this->repository->findAll()
                ->filter(function ($schedule) {

                    $resourceType = get_class(optional($schedule->session->speaker)->getResource());

                    if ($resourceType != Employee::class) {
                        return false;
                    }

                    return ($schedule->session->speaker->getResource()->id === optional(auth()->user()->employee)->id);
                });

            return $sessionsScheduled;
        }

        return collect();
    }

    public function scheduledSessionsAboutToExpire()
    {
        $scheduledSessions = $this->repository->findAll();

        return $scheduledSessions;
    }

    public function scheduledSessionsExpired()
    {
        $scheduledSessions = $this->repository->findAll();

        return $scheduledSessions;
    }

    private function recurringEvents(TrainingCourseBatch $batch, TrainingCourseModule $module)
    {
        $recurringEvents = collect();

        $course = $module->course;

        $recurringSchedules = $course->breaks;

        if ($recurringSchedules->count()) {

            $recurringSchedules->each(function ($recurringSchedule) use (&$recurringEvents, $batch, $module) {
                $recurringEventId = $recurringSchedule->getRecurringEventId();
                $recurringEventResourceId = $recurringSchedule->getRecurringEventResourceId();
                $startDate = Carbon::yesterday();
                $endDate = Carbon::today();

                while ($startDate->lessThanOrEqualTo($endDate)) {

                    $recurringEvents->push([
                        'id' => $recurringEventId,
                        'resourceId' => $recurringEventResourceId,
                        'start' => $startDate->format('Y-m-d') . ' ' . $recurringSchedule->start_time,
                        'end' => $startDate->format('Y-m-d') . ' ' . $recurringSchedule->end_time,
                        'title' => $recurringSchedule->title,
                        'extendedProps' => [
                            'resource' => $recurringEventResourceId,
                            'batch' => $batch->id,
                            'module' => $module->id,
                            'delete' => false
                        ]
                    ]);

                    $startDate->addDay();
                }
            });
        }

        return $recurringEvents;
    }

    public function getFilterData()
    {
        return $this->repository->getFilterData();
    }

    public function addSpeakerToFilterData($filterdata, $sessionData)
    {
        foreach ($filterdata as $key => $data) {
            foreach ($sessionData as $key => $session) {
                if ($session['id'] == $data->session_id) {
                    $data->speaker = $session['speaker'];
                }
            }
        }
        return $filterdata;
    }

    public function getSchedulesBySession(array $sessions)
    {
        return $this->actionRepository->getSchedulesBySession($sessions);
    }

    public function formatCourseBreakToScheduledSession(TrainingCourse $course)
    {
        $data = [];
        $recurringSchedules = $course->breaks;
        if (!$recurringSchedules->count()) {
            return $data;
        };
        $recurringSchedules->each(function ($recurringSchedule) use (&$data, $course) {
            $data[] = [
                'course_name' => $course->name ?? trans('labels.not_found'),
                'module_name' => trans('labels.not_applicable'),
                'session_name' => optional($recurringSchedule)->title,
                'session_date' => Carbon::parse($recurringSchedule->start_time)->format('j F, Y'),
                'session_start' => Carbon::parse($recurringSchedule->start_time)->format('h:i A'),
                'session_end' => Carbon::parse($recurringSchedule->end_time)->format('h:i A'),
                'speaker_name' => trans('labels.not_applicable'),
                'venue_name' => optional($recurringSchedule)->scheduledVenueTitle(),
            ];
        });
        return collect($data);
    }

    public function getExpiredScheduledSessions()
    {
        return $this->findAll()
            ->filter(function ($schedule) {
                if (Carbon::now() >= Carbon::parse($schedule->end)->addHours($schedule->session->speaker_expire_timeline)) {
                    return true;
                } else {
                    return false;
                }
            });
    }

    private function getEventTitle($event)
    {
        $moduleTitle = optional($event->session->module)->title ?? trans('labels.not_found');
        $sessionTitle = optional($event->session)->title ?? trans('labels.not_found');
        $speakerTitle = optional($event->session->speaker)->getResourceName() ?? trans('labels.not_found');

        return __('tms::module.title') . ': ' . $moduleTitle . ' ; ' .
            __('tms::session.title') . ': ' . $sessionTitle . ' ; '
            . __('tms::session.speaker') . ': ' . $speakerTitle;
    }

    /**
     * @param Collection $totalTrainees
     * @param TrainingCourseModuleSession $trainingCourseModuleSession
     * @return Collection
     */
    public function getTraineesWhoDidntEvaluate(
        Collection $totalTrainees,
        TrainingCourseModuleSession $trainingCourseModuleSession
    ) {
        $totalTraineeIds = $totalTrainees->pluck('id')->toArray();
        $totalTraineeIdsWhoEvaluated = $trainingCourseModuleSession->assessments
            ->pluck('trainee_id')->toArray();
        $traineesWhoDidNotEvaluated = (array_diff($totalTraineeIds, $totalTraineeIdsWhoEvaluated));
        return $totalTrainees->filter(function ($trainee) use ($totalTraineeIds, $traineesWhoDidNotEvaluated) {
            return in_array($trainee->id, $traineesWhoDidNotEvaluated);
        })->values();
    }
}
