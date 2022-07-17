<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HM\Services\HostelService;
use Modules\TMS\Entities\Training;
use Modules\TMS\Entities\TrainingBatchCourse;
use Modules\TMS\Entities\TrainingCourse;
use Modules\TMS\Entities\TrainingCourseBatch;
use Modules\TMS\Services\TrainingBatchCourseService;
use Modules\TMS\Services\TrainingCourseBatchService;

class TrainingCourseBatchRoomController extends Controller
{
    const BATCH_ROOM_VIEW = 'tms::training.course.batch.room.';

    private $hostelService;
    private $batchService;

    /**
     * TrainingCourseBatchRoomController constructor.
     * @param HostelService $hostelService
     * @param TrainingCourseBatchService $batchService
     */
    public function __construct(
        HostelService $hostelService,
        TrainingCourseBatchService $batchService
    )
    {
        $this->hostelService = $hostelService;
        $this->batchService = $batchService;
    }

    public function edit(
        Training $training,
        TrainingCourse $course,
        TrainingCourseBatch $batch
    )
    {
        $hostels = $this->hostelService->findAll();
        $hostelsWithAssignedRoomCount = $hostels->map(function ($hostel) use ($batch) {
            return (object)[
                'name' => $hostel->getName(),
                'assigned_room_count' => $batch->rooms()->where('hostel_id', $hostel->id)->count()
            ];
        });

        $availableHostelRooms = $this->batchService->getAssignedAndAvailableHostelRooms($batch, $hostels);
        
        $totalSeatsAllocated = $availableHostelRooms->flatten()->filter(function ($rooms) {
            return $rooms->is_assigned;
        })->sum('capacity');
        
        $selectedRooms = $batch->rooms->pluck('id');

        // dd($course,$batch,$hostelsWithAssignedRoomCount,$availableHostelRooms,$totalSeatsAllocated,$selectedRooms);

        return view(self::BATCH_ROOM_VIEW . '.edit', compact('training',
                'course',
                'batch',
                'hostelsWithAssignedRoomCount',
                'availableHostelRooms',
                'totalSeatsAllocated',
                'selectedRooms'
            )
        );
    }

    public function update(
        Request $request,
        Training $training,
        TrainingCourse $course,
        TrainingCourseBatch $batch
    )
    {
        if ($this->batchService->syncRooms($batch, $request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('trainings.courses.batches.show', [$training->id, $course->id]);
    }

    public function show(Training $training, TrainingCourse $course, TrainingCourseBatch $batch)
    {
        $batchHostelRooms = $batch->rooms()->get()->groupBy(function ($room) {
            return $room->hostel()->first()->name;
        })->map(function ($hostelRooms, $hostelName) {
            return (object)[
                'hostel_name' => $hostelName,
                'rooms' => $hostelRooms->map(function ($room) {
                    return optional($room->roomType)->name . ' - ' . $room->room_number;
                })
            ];
        })->values();

        $batchRoomAllocationRoute = route('trainings.courses.batches.rooms.edit', [$training->id, $course->id, $batch->id]);

        return view(self::BATCH_ROOM_VIEW . '.show', compact('training',
                'course',
                'batch',
                'batchHostelRooms',
                'batchRoomAllocationRoute'
            )
        );
    }
}
