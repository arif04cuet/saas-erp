<?php

/**
 * Created by PhpStorm.
 * User: bs110
 * Date: 12/24/18
 * Time: 7:24 PM
 */

namespace Modules\TMS\Services;

use Closure;
use Carbon\Carbon;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\Cafeteria\Services\VenueService;
use Modules\HRM\Entities\Employee;
use Illuminate\Support\Facades\Log;
use App\Utilities\FiscalYearCalculator;
use Modules\TMS\Entities\TrainingHead;
use Modules\TMS\Traits\MenuAccessTrait;
use App\Utilities\DropDownDataFormatter;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingParticipant;
use Modules\TMS\Entities\TrainingSponsor;
use Modules\TMS\Repositories\TrainingRepository;
use Modules\TMS\Entities\TrainingParticipantType;
use Modules\TMS\Services\TrainingTypeService;
use Modules\TMS\Services\TmsBudgetService;
use Modules\TMS\Services\TrainingCostSegmentationService;

class TrainingsService
{
    use CrudTrait, FileTrait, MenuAccessTrait;

    private $trainingsRepository;

    private $trainingCourseAdministrationService;
    private $trainingCourseResourceService;
    private $trainingCostSegmentationService;
    /**
     * @var TrainingVenueService
     */
    private $venueService;
    /**
     * @var TrainingCourseService
     */
    private $trainingCourseService;

    private $trainingTypeService;

    private $tmsBudgetService;

    private $orderBy;
    private $operator;

    public function __construct(
        TrainingRepository $trainingsRepository,
        TrainingCourseAdministrationService $trainingCourseAdministrationService,
        TrainingCourseService $trainingCourseService,
        TrainingVenueService $venueService,
        TrainingCourseResourceService $trainingCourseResourceService,
        TrainingTypeService $trainingTypeService,
        TmsBudgetService $tmsBudgetService,
        TrainingCostSegmentationService $trainingCostSegmentationService,
    ) {
        $this->trainingsRepository = $trainingsRepository;
        $this->setActionRepository($trainingsRepository);
        $this->trainingCourseAdministrationService = $trainingCourseAdministrationService;
        $this->trainingCourseResourceService = $trainingCourseResourceService;
        $this->venueService = $venueService;
        $this->trainingCourseService = $trainingCourseService;
        $this->trainingTypeService = $trainingTypeService;
        $this->tmsBudgetService = $tmsBudgetService;
        $this->trainingCostSegmentationService = $trainingCostSegmentationService;
        $this->setOrderBy('id', 'desc');
    }

    public function generateTrainingId()
    {
        //        $prefix = "BARD-TRN-";
        //        $id = date('Y-m-s') . rand(9999, 100000);
        //        $trainingId = $prefix . $id;
        //        return $trainingId;
        return '47.63.000.052.25.'; // BEP-202 [verbal confirmation from nowshin apu]
    }

    public function store(array $data, Training $training)
    {
        return DB::transaction(function () use ($data, $training) {
            $trainingData = $this->prepareTrainingData($data, $training);
            $training = $this->save($trainingData);
            // create a course default---comments 29-03-22 by araf
            // $course = $this->trainingCourseService->createCourseFromTraining($training,
            //     $this->venueService->find($data['venue_id']));
            // update the participant and sponsor data with the training head
            // $this->updateTrainingParticipants(['training_id' => $training->id], $training);
            // $this->updateTrainingSponsors(['training_id' => $training->id], $training);
            return $training;
        });
    }

    public function updateTraining($training, array $data)
    {
        return DB::transaction(function () use ($training, $data) {
            if (array_key_exists('photo', $data)) {
                $file = $data['photo'];
                $path = $this->upload($file, 'training-photos');
                $data['photo'] = $path;
            }
            return $this->update($training, $data);
        });
    }

    public function updateTrainingDurationDeadline($training, array $data)
    {
        return DB::transaction(function () use ($training, $data) {
            $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d');
            $data['end_date'] = Carbon::parse($data['end_date'])->format('Y-m-d');
            $data['registration_deadline'] = Carbon::parse($data['registration_deadline'])->format('Y-m-d');
            return $this->update($training, $data);
        });
    }

    public function getTrainingsBasedOnDate(Carbon $date)
    {
        return $this->trainingsRepository->getTrainingsBasedOnDate($date);
    }

    public function getAllParticipantTypes()
    {
        $participantTypes = TrainingParticipantType::all()->mapWithKeys(function ($type) {
            return [$type->id => $type->title];
        });
        return $participantTypes;
    }

    public function storeTrainingParticipantType($data, $training)
    {
        $training->trainingParticipants()->saveMany(
            collect($data['participant_types'])->map(function ($type) use ($training) {
                return new TrainingParticipant([
                    'training_id' => $training->id,
                    'training_participant_type_id' => $type
                ]);
            })
        );
    }

    public function storeTrainingParticipantTypeFromTrainingHead($data, $trainingHead)
    {
        $trainingHead->trainingParticipants()->saveMany(
            collect($data)->map(function ($type) use ($trainingHead) {
                return new TrainingParticipant([
                    'training_head_id' => $trainingHead->id,
                    'training_participant_type_id' => $type
                ]);
            })
        );
    }

    public function updateTrainingParticipantTypeFromTrainingHead($data, $trainingHead)
    {
        $trainingHead->trainingParticipants()->delete();
        $trainingHead->trainingParticipants()->saveMany(
            collect($data)->map(function ($type) use ($trainingHead) {
                return new TrainingParticipant([
                    'training_head_id' => $trainingHead->id,
                    'training_participant_type_id' => $type
                ]);
            })
        );
    }

    public function updateTrainingParticipants(array $data, TrainingHead $trainingHead)
    {
        $this->actionRepository->updateTrainingParticipants($data, $trainingHead);
    }

    public function storeTrainingSponsors($data, $training)
    {
        $training->trainingSponsors()->saveMany(
            collect($data['training_sponsors'])->map(function ($sponsor) use ($training) {
                return new TrainingSponsor([
                    'training_id' => $training->id,
                    'training_organization_id' => $sponsor
                ]);
            })
        );
    }

    public function storeTrainingSponsorsFromTrainingHead($data, $trainingHead)
    {
        $trainingHead->trainingSponsors()->saveMany(
            collect($data)->map(function ($sponsor) use ($trainingHead) {
                return new TrainingSponsor([
                    'training_head_id' => $trainingHead->id,
                    'training_organization_id' => $sponsor
                ]);
            })
        );
    }

    public function updateTrainingSponsors(array $data, TrainingHead $trainingHead)
    {
        return $this->actionRepository->updateTrainingSponsors($data, $trainingHead);
    }

    public function updateTrainingSponsorsFromTrainingHead($data, $trainingHead)
    {
        $trainingHead->trainingSponsors()->delete();
        $trainingHead->trainingSponsors()->saveMany(
            collect($data)->map(function ($sponsor) use ($trainingHead) {
                return new TrainingSponsor([
                    'training_head_id' => $trainingHead->id,
                    'training_organization_id' => $sponsor
                ]);
            })
        );
    }


    public function getTrainingParticipantsByTraining($training)
    {
        return $training->trainingParticipants->map(function ($participant) {

            if ($participant->type != null) {
                return $participant->type->title;
            } else {
                return "Not Found";
            }
        })->implode(', ');
    }

    public function getTrainingSponsorsByTraining($training)
    {
        return $training->trainingSponsors->map(function ($sponsor) {
            return $sponsor->organization->name;
        })->implode(', ');
    }

    public function getTrainingParticipantsTypesForEdit($training)
    {
        return $training->trainingParticipants->map(function ($participant) {
            return $participant->type->id;
        })->toArray();
    }

    public function getTrainingSponsorsForEdit($training)
    {
        return $training->trainingSponsors->map(function ($sponsor) {
            return $sponsor->organization->id;
        })->take(1)->toArray();
    }

    public function getTrainingsForGanttChart()
    {
        return $this->findAll()
            ->filter($this->removeNullEndDateTrainings())
            ->filter($this->onlyInCurrentFiscalYear())
            ->filter($this->hasBatches())
            ->values();
    }

    /**
     * @return \Closure
     */
    private function removeNullEndDateTrainings(): \Closure
    {
        return function ($training) {
            return !is_null($training->end_date);
        };
    }

    /**
     * @return \Closure
     */
    private function onlyInCurrentFiscalYear(): \Closure
    {
        return function ($training) {
            try {
                return FiscalYearCalculator::isStartAndEndDateBetweenFiscalYear(
                    Carbon::parse($training->start_date),
                    Carbon::parse($training->end_date)
                );
            } catch (\Exception $exception) {
                Log::error("Error: " . get_class($this) . " {$exception->getMessage()}");
                return false;
            }
        };
    }

    /**
     * @return \Closure
     */
    private function hasBatches(): \Closure
    {
        return function ($training) {
            return $training->batches->count();
        };
    }

    public function trainings($skipDraftTraining = true)
    {
        $this->can = false;
        if (Gate::allows('tms-department-course-administration-menu-access')) {
            $this->can = true;
        }
        if ($this->can) {

            $trainings = $this->trainingsRepository
                ->findAll(null, null, ['column' => 'id', 'direction' => 'desc']);

            if ($skipDraftTraining) {
                $trainings = $trainings->filter(function ($training) {
                    return !is_null($training->registration_deadline);
                });
            }

            $trainings = $trainings->map(function ($training) {
                $training->total_registered_trainees = $this->trainingsRepository->getTotelRegisteredTraineeNumber($training);
                $training->modified_status = $this->getStatus($training);
                return $training;
            });

            return $trainings;
        }

        $this->isTrainingCourseAdministrator(auth()->user());

        if ($this->can) {

            $courses = $this->trainingCourseAdministrationService->findBy([
                'employee_id' => optional(auth()->user()->employee)->id
            ])->unique()
                ->pluck('training_course_id')
                ->toArray();

            $trainings = $this->trainingsRepository->findAll()
                ->filter(function ($training) use ($courses) {

                    $administrators = $training->administrators->filter(function ($administrator) {

                        return $administrator->employee_id == optional(auth()->user()->employee)->id;
                    });

                    return $administrators->count();
                });

            return $trainings;
        }

        return collect();
    }

    public function getTotelRegistaredTrainee($training)
    {
        return $training->trainee()->get()->count();
    }

    public function getTrainings($operatorNotion = "available")
    {
        $today = Carbon::today('Asia/Dhaka');

        return $this->trainingsRepository
            ->findAll(null, null, $this->orderBy)
            ->filter(function ($training) use ($today, $operatorNotion) {
                $deadline = optional($training)->registration_deadline
                    ? Carbon::parse($training->registration_deadline)
                    : null;
                return $deadline
                    ? ($operatorNotion == "available"
                        ? $deadline->greaterThanOrEqualTo($today)
                        : $deadline->lessThan($today))
                    : false;
            });
    }

    private function setOrderBy($column = 'id', $direction = "desc")
    {
        $this->orderBy = [
            'column' => $column,
            'direction' => $direction,
        ];
    }

    private function setOperator($operatorNotion)
    {
        $this->operator = $operatorNotion == "available" ? '>=' : "<";
    }

    public function getStatus($training)
    {
        $today = Carbon::today('Asia/Dhaka');

        if (!is_null($training->end_date) && !is_null($training->start_date)) {
            $endDate = Carbon::parse($training->end_date);
            $startDate = Carbon::parse($training->start_date);

            if ($startDate->lessThanOrEqualTo($today) && $endDate->greaterThanOrEqualTo($today)) {
                return 'running';
            } else {
                if ($endDate->lessThan($today)) {
                    return 'completed';
                } else {
                    if ($startDate->greaterThan($today)) {
                        return 'upcoming';
                    }
                }
            }
        }

        return 'draft';
    }

    public function getTrainingsForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $trainings = $query ? $this->trainingsRepository->findBy($query) : $this->trainingsRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $trainings,
            $implementedKey,
            $implementedValue ?: function ($training) {
                return $training->title;
            },
            $isEmptyOption
        );
    }

    public function getTrainingVenuesForDropdown()
    {
        return $this->venueService->getTrainingVenuesForDropdown();
    }
    public function getTrainingTypesForDropdown()
    {
        return $this->trainingTypeService->getTrainingTypesForDropdown();
    }
    public function getBudgetsForDropdown()
    {
        return $this->tmsBudgetService->getBudgetsForDropdown();
    }

    // public function getTrainingHeadsForDropdown()
    // {
    //     return $this->actionRepository->getTrainingHeadsForDropdown();
    // }

    //-----------------------------------------------------------------------------
    //                                  Private Functions
    //-----------------------------------------------------------------------------
    public function prepareTrainingData(array $data, Training $training)
    {
        // $uId = $this->generateTrainingId() . $data['uid'];
        $uId = $data['uid'];
        $startDate = Carbon::parse($data['start_date'])->format('Y-m-d');
        $endDate = Carbon::parse($data['end_date'])->format('Y-m-d');
        $registrationDeadline = Carbon::parse($data['registration_deadline'])->format('Y-m-d');

        $level = 'nation';

        if (array_key_exists('photo', $data)) {
            $file = $data['photo'];
            $path = $this->upload($file, 'training-photos');
        }

        return [
            'uid' => $uId,
            'training_head_id' => 1,
            'title' => $data['title'] ?? trans('labels.not_found'),
            'bangla_title' => $data['bangla_title'] ?? trans('labels.not_found'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'registration_deadline' => $registrationDeadline,
            'no_of_trainee' => $data['no_of_trainee'],
            'no_of_batches' => $data['no_of_batches'],
            'level' => $level,
            'budget_id' => $data['budget_id'],
            'venue_id' => $data['venue_id'],
            'through_training' => $data['through_training'],
            'photo' => $path,
            'accommodation' => $data['accommodation'],
            'enroll_type' => $data['enroll_type'],
            'lang_preference' => $data['lang_preference'],
        ];
    }

    /**
     * this methor use in mmms module traning selection
     */

    public function getActiveTrainings()
    {
        $today = date('Y-m-d');
        return Training::where('start_date', '<', $today)->where('end_date', '>', $today)->pluck('title', 'id');
    }
    public function getOfflineTrainings()
    {
        return Training::where('through_training', 'offline')->get();
    }
    public function getOnlineTrainings()
    {
        return Training::where('through_training', 'online')->get();
    }

    public function costSegmentation(Training $training)
    {
        return $this->trainingCostSegmentationService->findBy([
            'training_id' => $training->id
        ]);
    }
}
