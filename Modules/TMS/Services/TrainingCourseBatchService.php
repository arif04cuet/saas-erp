<?php


namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\HM\Entities\Room;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseBatch;
use Modules\TMS\Repositories\TrainingCourseBatchRepository;

class TrainingCourseBatchService
{
    use CrudTrait;

    /**
     * @var TrainingCourseBatchRepository
     */
    private $repository;

    public function __construct(TrainingCourseBatchRepository $trainingCourseBatchRepository)
    {
        $this->repository = $trainingCourseBatchRepository;
        $this->setActionRepository($this->repository);
    }

    public function update($data, TrainingCourse $trainingCourse)
    {
        // dd();
        return DB::transaction(function () use ($data, $trainingCourse) {
            $result = false;
            if (isset($data['title']['old']) && !empty($data['title']['old'])) {
                foreach ($data['title']['old'] as $key => $value) {
                    if (!is_null($value)) {
                        try {
                            $result = $trainingCourse->batches()->find($key)->update(
                                [   
                                    'title' => $value,
                                    'start_date' => $this->parseDateFormFormat($data['start_date']['old'][$key]),
                                    'end_date' => $this->parseDateFormFormat($data['end_date']['old'][$key]),
                                    'no_of_trainees' => $data['no_of_trainees']['old'][$key],
                                ]
                            );

                        } catch (\Exception $exception) {
                            $result = false;
                        }
                    }
                }
            }

            if (isset($data['title']['new']) && !empty($data['title']['new'])) {
                foreach ($data['title']['new'] as $key => $value) {
                    if (!is_null($value)) {
                        try {
                            $result = $trainingCourse->batches()->create(
                                [
                                    'title' => $value,
                                    'start_date' => $this->parseDateFormFormat($data['start_date']['new'][$key]),
                                    'end_date' => $this->parseDateFormFormat($data['end_date']['new'][$key]),
                                    'no_of_trainees' => $data['no_of_trainees']['new'][$key],
                                ]
                            );
                        } catch (\Exception $e) {
                            $result = false;
                        }
                    }
                }
            }

            return $result;
        });
    }

    public function syncRooms(TrainingCourseBatch $batch, array $data)
    {
        try {
            DB::beginTransaction();

            $res = $batch->rooms()->sync($data['rooms']);

            Room::whereIn('id', $res['detached'])->update([
                'status' => 'available'
            ]);

            $batch->rooms()->each(function ($room) {
                $room->update(['status' => 'unavailable']);
            });
            DB::commit();

            return true;
        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error(get_class($this) . ": {$exception->getMessage()}");
            return false;
        }
    }

    private function parseDateFormFormat($date, $format = "j F, Y")
    {
        return Carbon::createFromFormat($format, $date);
    }

    /**
     * @param TrainingCourseBatch $batch
     * @param $hostels
     * @return mixed
     */
    public function getAssignedAndAvailableHostelRooms(TrainingCourseBatch $batch, $hostels)
    {
        $availableHostelRooms = $hostels->map(function ($hostel) use ($batch) {
            $rooms = $hostel->rooms
                ->filter(function ($room) use ($batch) {
                    $isRoomAssignedToBatch = $batch->rooms()->where('room_id', $room->id)->exists();
                    return $room->status == 'available' || $isRoomAssignedToBatch;
                })
                ->values()
                ->map(function ($room) use ($batch) {
                    return (object)[
                        'id' => $room->id,
                        'name' => optional($room->roomType)->name . ' - ' . $room->room_number,
                        'capacity' => optional($room->roomType)->capacity,
                        'is_assigned' => $batch->rooms()->where('room_id', $room->id)->exists()
                    ];
                });

                return $rooms;
            });
        return $availableHostelRooms;
    }
}
