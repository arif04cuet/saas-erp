<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HM\Entities\RoomType;
use Modules\HM\Http\Requests\StoreUpdateRoomTypeRequest;
use Modules\HM\Services\RoomTypeService;

class RoomTypeController extends Controller
{
    private $roomTypeService;

    /**
     * RoomTypeController constructor.
     * @param RoomTypeService $roomTypeService
     */
    public function __construct(RoomTypeService $roomTypeService)
    {
        $this->roomTypeService = $roomTypeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $roomTypes = $this->roomTypeService->findAll();

        return view('hm::room-type.index', compact('roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('hm::room-type.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreUpdateRoomTypeRequest $request
     * @return Response
     */
    public function store(StoreUpdateRoomTypeRequest $request)
    {
        $this->roomTypeService->save($request->all());
        Session::flash('success', trans('labels.save_success'));

        return redirect()->route('room-types.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('hm::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param RoomType $roomType
     * @return Response
     */
    public function edit(RoomType $roomType)
    {
        return view('hm::room-type.edit', compact('roomType'));
    }

    /**
     * Update the specified resource in storage.
     * @param StoreUpdateRoomTypeRequest $request
     * @param RoomType $roomType
     * @return Response
     */
    public function update(StoreUpdateRoomTypeRequest $request, RoomType $roomType)
    {
        $this->roomTypeService->update($roomType, $request->all());
        Session::flash('success', trans('labels.update_success'));

        return redirect()->route('room-types.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param RoomType $roomType
     * @return Response
     */
    public function destroy(RoomType $roomType)
    {
        $this->roomTypeService->destroy($roomType);
        Session::flash('warning', trans('labels.delete_success'));
        return redirect()->back();
    }
}
