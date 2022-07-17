<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HM\Entities\Room;
use Modules\HM\Http\Requests\UpdateRoomStatusRequest;
use Modules\HM\Services\RoomService;

class RoomStatusController extends Controller
{
    /**
     * @var RoomService
     */
    private $roomService;

    /**
     * RoomStatusController constructor.
     * @param RoomService $roomService
     */
    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function update(UpdateRoomStatusRequest $request, Room $room)
    {
        $this->roomService->updateStatus($room, $request->input('status'));
        Session::flash('success', trans('labels.update_success'));

        return redirect()->back();
    }
}
