<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/6/19
 * Time: 11:37 AM
 */

namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\TrainingCafeteria;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseBreak;
use Modules\TMS\Entities\TrainingVenue;
use Modules\TMS\Repositories\TrainingCourseBreakRepository;

class TrainingCourseBreakService
{
    use CrudTrait;

    private $repository;

    private $validTimeFormat;


    /**
     * TrainingCourseBreakService constructor.
     * @param TrainingCourseBreakRepository $repository
     */
    public function __construct(TrainingCourseBreakRepository $repository)
    {
        $this->validTimeFormat = "H:i A";
        $this->repository = $repository;
        $this->setActionRepository($repository);
    }

    public function updateRequest(TrainingCourse $course, array $data)
    {
        return DB::transaction(function () use ($course, $data) {

            $recurringSchedulesToBeUpdated = $this->getRecurringSchedulesIdToUpdate($data ?: []);

            $deletes = $this->getRecurringSchedulesToDelete($course, $recurringSchedulesToBeUpdated)
                ->each(function ($delete) {
                    $delete->delete();
                });

            if (!empty($data)) {
                $updateOrSaves = collect($data)->each(function ($recurringSchedule) use ($course) {
                    $course->breaks()->updateOrCreate(
                        ['id' => $recurringSchedule['id']],
                        $this->format($recurringSchedule)
                    );
                });

                return $updateOrSaves;
            }

            return $deletes;

        });
    }

    /**
     * @param $data
     * @return mixed
     */
    private function getKeyedBreaksCollection($data)
    {
        list('breakfast' => $breaks['breakfast'],
            'lunch' => $breaks['lunch'],
            'tea_break' => $breaks['tea-break'],
            'dinner' => $breaks['dinner']
            ) = $data;

        return collect($breaks);
    }

    /**
     * @param $breaks
     * @return mixed
     */
    private function filterNullBreakInputs($breaks)
    {
        $breakInputs = $breaks->filter(function ($break) {
            return isset($break['start_time'])
                && isset($break['end_time'])
                && isset($break['training_cafeteria_id']);
        });
        return $breakInputs;
    }

    private function getRecurringSchedulesIdToUpdate(array $data = [])
    {
        return array_filter(array_column($data, 'id'));
    }

    private function getRecurringSchedulesToDelete(TrainingCourse $course, $recurringSchedulesShouldBeUpdated)
    {
        return $this->repository->findBy([
            'training_course_id' => $course->id
        ])->filter(function ($recurringSchedule) use ($recurringSchedulesShouldBeUpdated) {
            return !in_array($recurringSchedule->id, $recurringSchedulesShouldBeUpdated);
        });
    }

    private function format($recurringSchedule = [])
    {
        foreach ($recurringSchedule as $key => $value) {
            switch ($key) {
                case 'start_time':
                    $recurringSchedule['start_time'] = $this->formatTime($recurringSchedule['start_time']);
                    break;
                case 'end_time':
                    $recurringSchedule['end_time'] = $this->formatTime($recurringSchedule['end_time']);
                    break;
                case 'entity_id':
                    $recurringSchedule['entity_type'] = $this->getEntityType($recurringSchedule['entity_id']);
                    $recurringSchedule['entity_id'] = $this->formatEntityId($recurringSchedule['entity_id']);
                    break;
                default:
                    break;
            }
        }

        return $recurringSchedule;
    }

    private function formatTime($time)
    {
        return Carbon::createFromFormat($this->validTimeFormat, $time);
    }

    private function getEntityType($entityId)
    {
        $entityType = explode("_", $entityId);

        switch($entityType[0]) {
            case 'venue':
                return TrainingVenue::class;
            case 'cafeteria':
                return TrainingCafeteria::class;
            default:
                return 'no type';
        }
    }

    private function formatEntityId($entityId)
    {
        $entity = explode("_", $entityId);

        return end($entity);
    }

    public function recurringSchedules(TrainingCourse $course)
    {
        $recurringSchedules = $this->repository->findBy([
            'training_course_id' => $course->id
        ]);

        return $recurringSchedules;
    }
}
