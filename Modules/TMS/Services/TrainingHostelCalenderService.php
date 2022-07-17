<?php

namespace Modules\TMS\Services;


use App\Traits\CrudTrait;
use App\Utilities\EnToBnNumberConverter;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Modules\Accounts\Entities\Payslip;
use Modules\HM\Entities\Hostel;
use Modules\HM\Entities\Room;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Repositories\RoomRepository;
use Modules\HM\Services\HostelService;
use Modules\HM\Services\RoomTypeService;
use Modules\TMS\Repositories\TrainingHostelCalenderRepository;
use Modules\HM\Services\CheckinService;
use Modules\HM\Services\CheckinTraineeService;
use Modules\HM\Services\RoomService;
use Modules\TMS\Entities\Training;
use Modules\TMS\Services\TrainingsService;

class TrainingHostelCalenderService
{

    use CrudTrait;

    /**
     * @var HostelService
     */
    private $hostelService;
    /**
     * @var RoomTypeService
     */
    private $roomTypeService;

    /**
     * @var CheckinTraineeService
     */
    private $checkinTraineeService;
    /**
     * @var CheckinService
     */
    private $checkinService;
    /**
     * @var RoomRepository
     */
    private $roomRepository;

    /**
     * TrainingHostelCalenderService constructor.
     * @param HostelService $hostelService
     * @param RoomTypeService $roomTypeService
     * @param CheckinTraineeService $checkinTraineeService
     * @param RoomRepository $roomRepository
     * @param CheckinService $checkinService
     */
    public function __construct(
        HostelService $hostelService,
        RoomTypeService $roomTypeService,
        CheckinTraineeService $checkinTraineeService,
        RoomRepository $roomRepository,
        CheckinService $checkinService
    ) {
        $this->hostelService = $hostelService;
        $this->roomTypeService = $roomTypeService;
        $this->checkinTraineeService = $checkinTraineeService;
        $this->checkinService = $checkinService;
        $this->roomRepository = $roomRepository;
    }

    /**
     * @return array
     */
    public function getHostelsForDropdown()
    {
        return $this->hostelService->getHostelsForDropdown();
    }

    /**
     * prepare resources and events array for fullcalender timeline scheduler
     * @param Training $training
     * @return JsonResponse
     */
    public function getDataForCalender(
        Training $training
    ) {
        $allHostelMasterData = $this->getHostelMasterData($training);
        $hostelDropdownsWithEventsOnly = $this->getHostelsForDropdownWithEventsOnly($training);
        $resourceColumns = $this->getResourceColumns();
        return response()->json([
            'allHostelMasterData' => $allHostelMasterData,
            'hostelDropdownsWithEventsOnly' => $hostelDropdownsWithEventsOnly,
            'resourceColumns' => $resourceColumns
        ]);
    }


    public function getHostelsForDropdownWithEventsOnly(Training $training)
    {
        $masterData = $this->getHostelMasterData($training);
        $hostelKeysWithEventsOnly = $this->getHostelKeysWithEvents($masterData);
        return Hostel::query()->find($hostelKeysWithEventsOnly)->pluck('name', 'id');
    }

    private function getHostelKeysWithEvents($masterData)
    {
        return $masterData->filter(function ($d) {
            return !empty($d['events']->toArray());
        })->keys();
    }

    /**
     *
     *         {
     *           "id": "1"
     *           "hostel_id": "1",
     *           "start": "2017-03-02",
     *           "end": "2017-03-23",
     *           "title": "A-12",
     *           "status": "A-12",
     *           ,
     *        },
     *
     * @param $checkinDetails
     *
     * @return array
     */
    private function prepareDataFromCheckinDetails($checkinDetails)
    {
        $masterEvents = collect();
        $id = 1;
        foreach ($checkinDetails as $checkinDetail) {
            $data = collect();
            // get booking request by checkin_id
            $bookingRequest = RoomBooking::find($checkinDetail->checkin_id);
            if (is_null($bookingRequest)) {
                //todo:: handle exception
            }
            $startDate = Carbon::parse($checkinDetail->checkin_date)->format('Y-m-d');
            $textColor = '#FFFFF';
            if (is_null($checkinDetail->checkout_date)) {
                $endDate = Carbon::parse($bookingRequest->end_date)->format('Y-m-d');
                $status = 1;
                $text = trans('tms::training_hostel.check_in');
                $backgroundColor = 'green';

            } else {
                $endDate = Carbon::parse($checkinDetail->checkout_date)->toIso8601String('Y-m-d');
                $status = 2;
                $backgroundColor = 'red';
                $text = trans('tms::training_hostel.check_out');
            }
            $masterEvents[] = (object)[
                'id' => $id++,
                'resourceId' => (integer)$checkinDetail->room->room_number,
                'hostel_id' => $checkinDetail->room->hostel_id,
                'start' => $startDate,
                'end' => $endDate,
                'title' => $text,
                'color' => $backgroundColor,
                'status' => $status,
                'status_checkin' => trans('tms::training_hostel.check_in'),
                'status_checkout' => trans('tms::training_hostel.check_out'),
                'allDayDefault' => true
            ];
        }
        return $masterEvents;
    }


    /**
     * Get all hostel information with room-details
     * @return Collection
     */
    private function getAllResources()
    {
        $hostelRoomDetails = $this->hostelService->getAvailableHostelRoomDetails();
        return $hostelRoomDetails->map(function ($h) {
            return $h->only(['room_details']);
        })->flatten()->map(function ($room) {
            $room->id = (integer)$room->room_number;
            $room->room_number = EnToBnNumberConverter::en2bn($room->room_number ?? 0);
            $room->floor = EnToBnNumberConverter::en2bn($room->floor ?? 0);
            $roomTypeName = $room->roomType->name ?? trans('labels.not_found');
            $room->room_type_name = $roomTypeName;
            return $room;
        });
    }

    /**
     * @param Training $training
     * @return array
     */
    private function getAllEvents(Training $training)
    {
        $checkinIds = $this->checkinTraineeService
            ->findBy(['training_id' => $training->id])
            ->pluck('checkin_id');

        $checkinDetails = $this->checkinService
            ->getDetailsByCheckinIds($checkinIds->toArray())
            ->unique('room_id');
        return $this->prepareDataFromCheckinDetails($checkinDetails);
    }

    /**
     * @param $resourceData
     * @param $events
     * @return Collection
     */
    private function getMasterDataFilteredByHostels($resourceData, $events)
    {
        $allHostelMasterData = collect();
        $hostels = $this->hostelService->getAll();
        foreach ($hostels as $hostel) {
            $collection = collect();
            // prepare room data
            $collection['resources'] = $resourceData->filter(function ($d) use ($hostel) {
                return $d->hostel_id == $hostel->id;
            })->flatten();
            $collection['events'] = $events->filter(function ($d) use ($hostel) {
                return $d->hostel_id == $hostel->id;
            })->values();

            $allHostelMasterData[$hostel->id] = $collection;
        }
        return $allHostelMasterData;
    }

    /**
     * @param Training $training
     * @return Collection
     */
    private function getHostelMasterData(Training $training): Collection
    {
        $resourceData = $this->getAllResources();
        $events = $this->getAllEvents($training);

        return $this->getMasterDataFilteredByHostels($resourceData, $events);
    }

    private function getResourceColumns()
    {
        return [
            (object)[
                'group' => true,
                'labelText' => trans('tms::training_hostel.floor'),
                'field' => 'floor',
                'width' => 15
            ],
            (object)[
                'labelText' => trans('tms::training_hostel.room_number'),
                'field' => 'room_number',
                'width' => 35
            ],
            (object)[
                'labelText' => trans('tms::training_hostel.room_type'),
                'field' => 'room_type_name',
                'width' => 50
            ]
        ];
    }
}

