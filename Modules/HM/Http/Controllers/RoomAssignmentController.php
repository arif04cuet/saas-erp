<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 12/26/18
 * Time: 1:05 PM
 */

namespace Modules\HM\Http\Controllers;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\HM\Services\BookingRequestService;
use Modules\HM\Services\CheckinService;
use Modules\HM\Services\HostelService;
use Modules\HM\Services\RoomService;

class RoomAssignmentController extends Controller
{
    private $hostelService;
    private $roomService;
    private $roomBookingService;
    private $checkinService;

    /**
     * RoomAssignmentController constructor.
     * @param HostelService $hostelService
     * @param RoomService $roomService
     * @param BookingRequestService $roomBookingService
     * @param CheckinService $checkinService
     */
    public function __construct(HostelService $hostelService, RoomService $roomService, BookingRequestService $roomBookingService, CheckinService $checkinService)
    {
        $this->hostelService = $hostelService;
        $this->roomService = $roomService;
        $this->checkinService = $checkinService;
        $this->roomBookingService = $roomBookingService;
    }


    public function index(Request $request)
    {
        $roomCheckinDetails = $this->roomBookingService->findOrFail($request['roomCheckinId']);
        $roomIds = [];
        $hostelIds = [];
        $checkInRooms = $roomCheckinDetails->rooms;
        foreach ($checkInRooms as $checkInRoom) {
            array_push($roomIds, $checkInRoom->room->id);
            array_push($hostelIds, $checkInRoom->room->hostel_id);
        }
        $roomDetails = [];
        $hostels = $this->hostelService->getHostelByWithRooms($hostelIds, $roomIds);

        foreach ($hostels as $hostel) {
            $roomDetails[$hostel->name] = $this->roomService->sortRoomsByLevel($hostel->rooms);
        }

        $selectedHostelId = $request['selectedHostelId'];

        $allRoomsCountBasedOnStatus = $this->hostelService->getRoomsCountBasedOnStatus();
        $guests = $this->roomBookingService->getBookingGuestInfo($roomCheckinDetails->id, 'booked');
        $alreadyAssignedGuest = $this->roomBookingService->getBookingGuestInfo($roomCheckinDetails->id, 'checkin');

        $guests->prepend(__('hm::checkin.select_guest'), '');
        $today = Carbon::now()->format('d M, Y');
        return view('hm::check-in.seat', compact('hostels', 'roomDetails', 'roomCheckinDetails', 'guests',
            'allRoomsCountBasedOnStatus', 'today', 'selectedHostelId', 'alreadyAssignedGuest'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['checkin_date'] = new \DateTime();
        $this->checkinService->store($data);
        Session::flash('success', __('hm::checkin.room_allocation_success'));
        return redirect(route('room.assign', ['selectedHostelId' => $request['selected_hostel_id'], 'roomCheckinId' => $request['checkin_id']]));
    }

    public function getHostelList(Request $request)
    {
        $roomCheckinId = $request['roomCheckinId'];
        $roomCheckinDetails = $this->roomBookingService->findOrFail($request['roomCheckinId']);
        $roomIds = [];
        $hostelIds = [];
        $checkInRooms = $roomCheckinDetails->rooms;
        foreach ($checkInRooms as $checkInRoom) {
            array_push($roomIds, $checkInRoom->room->id);
            array_push($hostelIds, $checkInRoom->room->hostel_id);
        }
        $hostels = $this->hostelService->getHostelByBookedRooms($hostelIds);
        return view('hm::check-in.hostel', compact('hostels', 'roomCheckinId'));
    }

    public function getAlreadyAssignedGuest($roomId, $checkinId)
    {
        $guestList = $this->checkinService->getAlreadyCheckinGuestInfo($roomId, $checkinId);
        echo json_encode($guestList);

    }
}
