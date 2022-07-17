<?php

namespace Modules\HM\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\HM\Entities\Room;
use Modules\HM\Services\HostelService;
use Modules\HM\Services\RoomService;

class HMController extends Controller
{
    private $hostelService;
    private $roomService;

    /**
     * HostelController constructor.
     * @param HostelService $hostelService
     * @param RoomService $roomService
     */
    public function __construct(HostelService $hostelService, RoomService $roomService)
    {
        $this->hostelService = $hostelService;
        $this->roomService = $roomService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $roomDetails = [];
        $hostels = $this->hostelService->getAll();
        foreach ($hostels as $hostel) {
            $availableRooms = $this->roomService->getActiveRoomStatusOfHostel($hostel);
            $roomDetails[$hostel->name] = $this->roomService->sortRoomsByLevel($availableRooms);
        }
        $allHostelRoomsWithStatus = collect($roomDetails)->flatten()->flatten();
        $allRoomsCountBasedOnStatus = $this->roomService->getRoomStatusCount($allHostelRoomsWithStatus);
        // $allRoomsCountBasedOnStatus = $this->hostelService->getRoomsCountBasedOnStatus($allHostelRoomsWithStatus);
        $roomStatuses = Room::getRoomStatuses();
        $startDate = Carbon::today();
        $endDate = Carbon::today();
        $searchView = $this->hostelService->getSearchView($startDate, $endDate);
        return view(
            'hm::index',
            compact(
                'hostels',
                'roomStatuses',
                'roomDetails',
                'allRoomsCountBasedOnStatus',
                'startDate',
                'endDate',
                'searchView'
            )
        );
    }

    public function show()
    {
        return $this->hostelService->getRoomsCountBasedOnStatus();
    }
}
