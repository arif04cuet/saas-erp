<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HM\Entities\Hostel;
use Modules\HM\Entities\Room;
use Modules\HM\Http\Requests\CreateHostelRoomRequest;
use Modules\HM\Services\HostelService;
use Modules\HM\Services\RoomService;
use Modules\HM\Services\RoomTypeService;

class RoomController extends Controller
{
    /**
     * @var RoomService
     */
    private $roomService;

    /**
     * @var RoomTypeService
     */
    private $roomTypeService;

    private $hostelService;

    /**
     * RoomController constructor.
     * @param RoomService $roomService
     * @param RoomTypeService $roomTypeService
     * @param HostelService $hostelService
     */
    public function __construct(
        RoomService $roomService,
        RoomTypeService $roomTypeService,
        HostelService $hostelService
    ) {
        $this->roomService = $roomService;
        $this->roomTypeService = $roomTypeService;
        $this->hostelService = $hostelService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $rooms = $this->roomService->getAll();

        return view('hm::room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Hostel $hostel
     * @return Response
     */
    public function create(Hostel $hostel)
    {
        $roomTypes = $this->roomTypeService->pluck();
        $roomTypes->prepend('--Please Select--', '');
        return view('hm::.room.create', compact('roomTypes', 'hostel'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateHostelRoomRequest $request
     * @return array
     */
    public function store(CreateHostelRoomRequest $request)
    {
        $this->roomService->store($request->all());
        Session::flash('success', trans('labels.save_success'));

        return redirect()->route('hostels.show', $request['hostel_id']);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('hm::room.show');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function history()
    {
        return view('hm::room.history');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Room $room
     * @return Response
     */
    public function edit(Room $room)
    {
        $roomTypes = $this->roomTypeService->pluck();
        $hostel = $room->hostel;
        return view('hm::room.edit', compact('room', 'roomTypes', 'hostel'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Room $room
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Room $room)
    {
        try {
            $room = $this->roomService->update($room, $request->all());
            $hostel = $room->hostel;
            return redirect()
                ->route('hostels.show', $hostel)
                ->with('success', trans('labels.update_success'));
        } catch (\Exception $exception) {
            Log::error('Hostel Room Update Error: ',
                $exception->getMessage() . ' Trace: ' . $exception->getTraceAsString());
            return redirect()->route('rooms.index')->with('success', trans('labels.update_success'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->roomService->delete($id);
        Session::flash('success', 'Room deleted successfully');

        return redirect()->back();
    }
}
