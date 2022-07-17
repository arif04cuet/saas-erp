<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/11/18
 * Time: 6:43 PM
 */

namespace Modules\HM\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Modules\HM\Entities\Hostel;
use Modules\HM\Entities\Room;
use Modules\HM\Repositories\HostelRepository;
use Closure;

class HostelService
{
    use CrudTrait;

    /**
     * @var HostelRepository
     */
    private $hostelRepository;
    /**
     * @var RoomService
     */
    private $roomService;
    /**
     * @var BookingRequestService
     */
    private $bookingRequestService;

    /**
     * HostelService constructor.
     * @param HostelRepository $hostelRepository
     * @param RoomService $roomService
     */
    public function __construct(
        HostelRepository $hostelRepository,
        RoomService $roomService,
        BookingRequestService $bookingRequestService
    ) {
        $this->hostelRepository = $hostelRepository;
        $this->roomService = $roomService;
        $this->bookingRequestService = $bookingRequestService;
        $this->setActionRepository($this->hostelRepository);
    }

    public function getAll()
    {
        return $this->hostelRepository->findAll();
    }

    public function store(array $data)
    {
        $hostel = $this->save($data);
        if (isset($data['rooms']) && !empty($data['rooms'])) {
            $rooms = $this->roomService->getRoomsFromRoomEntry($data['rooms']);
            $hostel->rooms()->saveMany($rooms);
        }
    }

    public function destroy(Hostel $hostel)
    {
        DB::transaction(function () use ($hostel) {
            $hostel->rooms()->delete();
            $hostel->delete();
        });
    }

    public function groupHostelRoomsByType($rooms)
    {
        $roomList = [];
        foreach ($rooms as $room) {
            if (!array_key_exists($room->roomType->name, $roomList)) {
                $roomList[$room->roomType->name] = [$room];
            } else {
                array_push($roomList[$room->roomType->name], $room);
            }
        }

        return $roomList;
    }

    public function getHostelAndRoomDetails()
    {
        $hostelDetails = [];
        $hostels = $this->findAll();
        foreach ($hostels as $hostel) {
            $roomDetails = $this->roomService->getRoomCountByRoomType($hostel->id);
            $hostelDetails[$hostel->name] = ['hostelDetails' => $hostel, 'roomDetails' => $roomDetails];
        }
        return $hostelDetails;
    }

    public function getHostelByBookedRooms($hostelIds)
    {
        $hostelDetails = [];
        $hostels = $this->getHostelByIds($hostelIds);
        foreach ($hostels as $hostel) {
            $roomDetails = $this->roomService->getRoomCountByRoomType($hostel->id);
            $hostelDetails[$hostel->name] = ['hostelDetails' => $hostel, 'roomDetails' => $roomDetails];
        }
        return $hostelDetails;
    }

    public function getHostelByIds($hostelIds)
    {
        $hostels = $this->hostelRepository->findIn('id', $hostelIds);
        return $hostels;
    }

    public function getHostelByWithRooms($hostelIds, $roomIds)
    {
        $hostels = $this->hostelRepository->getHostelsWithSelectedRooms($hostelIds, $roomIds);
        return $hostels;
    }

    public function getRoomsCountBasedOnStatus($hostelId = null)
    {
        $overAllStatus = [
            'booked' => 0,
            'available' => 0,
            'partially_available' => 0,
            'not_in_service' => 0
        ];

        $allRoomsCount = $this->roomService->getRoomCountByStatus($hostelId)->toArray();
        $allRoomsCount = array_column($allRoomsCount, 'room_count', 'status');
        $overAllStatus['available'] = (isset($allRoomsCount['available']) ? $allRoomsCount['available'] : 0);
        $overAllStatus['partially-available'] = (isset($allRoomsCount['partially-available']) ? $allRoomsCount['partially-available'] : 0);
        $overAllStatus['booked'] = (isset($allRoomsCount['unavailable']) ? $allRoomsCount['unavailable'] : 0);
        $overAllStatus['not_in_service'] = (isset($allRoomsCount['not-in-service']) ? $allRoomsCount['not-in-service'] : 0);

        return $overAllStatus;
    }

    /**
     * This method returns hostel and their room details
     * sorted desc by room level
     * @return LengthAwarePaginator|Builder[]|Collection|Model[]
     */
    public function getAvailableHostelRoomDetails()
    {
        $hostels = $this->getAll();

        $hostels = $hostels->each(function ($h) {
            $availableRooms = $this->roomService->getActiveRoomStatusOfHostel($h);
            unset($h->rooms);
            $h->room_details = $this->roomService->sortRoomsByLevel($availableRooms);
        });
        return $hostels;
    }

    public function getHostelsForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        $emptyOption = false
    ) {
        $hostels = $this->hostelRepository->findAll();

        $hostelOptions = [];

        foreach ($hostels as $hostel) {
            $hostelId = $implementedKey ? $implementedKey($hostel) : $hostel->id;

            $implementedValue = $implementedValue ?: function ($hostel) {
                return optional($hostel)->name;
            };

            $hostelOptions[$hostelId] = $implementedValue($hostel);
        }

        return $hostelOptions;
    }

    /**
     * This method returns a view which can search and show result for all hostel information between two dates
     * can be used anywhere, just plug and play in a view or ajax call
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return string
     */
    public function getSearchView(Carbon $startDate, Carbon $endDate)
    {
        $roomBookings = $this->bookingRequestService->getBookingRequestOfDateRange($startDate, $endDate);
        $hostelSummary = $this->getHostelSummaryOfDateRange($startDate, $endDate);
        return view('hm::hostel.vacancy_search_view',
            compact('roomBookings', 'hostelSummary', 'startDate', 'endDate'))->render();
    }

    public function getHostelSummaryOfDateRange(Carbon $startDate, Carbon $endDate)
    {
        $hostels = $this->getAll();
        $roomStatuses = Room::getRoomStatuses();
        return $hostels->map(function ($hostel) use ($startDate, $endDate, $roomStatuses) {
            $allHostelRooms = $hostel->rooms;
            $filteredRooms = $allHostelRooms->filter(function ($room) use ($startDate, $endDate, $roomStatuses) {
                if ($room->status == $roomStatuses[2]) {   // '2' => 'unavailable'
                    if (!$this->roomService->checkAvailability($room, $startDate, $endDate)) {
                        return false;
                    }
                    return true;
                }
                return true;
            });
            $partiallyAvailable = $allHostelRooms->filter(function ($room) use ($roomStatuses) {
                if (($room->status == $roomStatuses[2]) && $this->roomService->isRoomPartiallyAvailable($room)) {
                    return true;
                }
                return false;
            });

            $totalRooms = $hostel->rooms->count() ?? 0;
            $partiallyAvailableRooms = $partiallyAvailable->count() ?? 0;
            $totalAvailable = $filteredRooms->count() ?? 0;
            $notAvailable = $totalRooms - $totalAvailable;

            return (object)[
                'name' => $hostel->getName(),
                'floor' => $hostel->total_floor ?? 0,
                'total_rooms' => $totalRooms,
                'partially_available' => $partiallyAvailableRooms,
                'total_available' => $totalAvailable,
            ];
        });
    }


}
