<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/24/18
 * Time: 3:58 PM
 */

namespace Modules\HM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\HM\Entities\Room;

class RoomRepository extends AbstractBaseRepository
{
    protected $modelName = Room::class;

    public function saveAll($rooms)
    {
        //TODO: Need to update the implementation for saving multiple items
        foreach ($rooms as $room) {
            $room->save();
        }
    }

    public function exists(array $roomNumbers, $hostelId)
    {
        return Room::where('hostel_id', $hostelId)->whereIn('room_number', $roomNumbers)->exists();
    }

    public function getRoomCountByRoomType($hostelId = null)
    {
        $where = $hostelId ? ['hostel_id' => $hostelId] : [];
        return DB::table('rooms')
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->selectRaw('room_types.name as room_type, count(rooms.room_number) as room_count')
            ->groupBy('rooms.room_type_id')
            ->where($where)
            ->get();
    }

    public function getRoomCountByStatus($hostelId = null)
    {
        $where = $hostelId ? ['hostel_id' => $hostelId] : [];
        return DB::table('rooms')
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->selectRaw('rooms.status, count(rooms.room_number) as room_count')
            ->groupBy('rooms.status')
            ->where($where)
            ->get();
    }

    public function getAllRoomsByRoomIds(array $roomIds)
    {
        return $this->getModel()->newQuery()->whereIn('id', $roomIds)->get();
    }

    /**
     * Check if a room is available between a date range
     * @param Room $room
     * @param Carbon $startDate
     * @param Carbon $endDate
     */
    public function checkAvailability(Room $room, Carbon $startDate, Carbon $endDate)
    {
        $startDate = $startDate->format('Y-m-h');
        $endDate = $endDate->format('Y-m-h');
        $ongoingCheckInInfos = $room->checkInRooms()->whereStatus('checkedin')->get();
        $ongoingCheckInInfos = $ongoingCheckInInfos->filter(function ($info) use ($startDate, $endDate) {
            $bookingInformation = $info->checkin;
            if (!is_null($bookingInformation)) {
                if ($bookingInformation->end_date >= $startDate) {
                    return false;
                }
                return true;
            }
            return false;
        });
        return $ongoingCheckInInfos->count();
    }

    public function getAllActiveGuestsOfRoom(Room $room)
    {
        $activeCheckIns = $room->checkInRooms()->whereNull('checkout_date')->get();
        $guestInfos = collect();
        foreach ($activeCheckIns as $activeCheckIn) {
            $roomBooking = $activeCheckIn->checkin;
            $guestInfos = $guestInfos->merge($roomBooking->guestInfos);
        }
        return $guestInfos;
    }
}
