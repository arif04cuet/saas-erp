<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HM\Entities\RoomInventory;
use Modules\HM\Services\RoomInventoryService;

class RoomInventoryController extends Controller
{
    /**
     * @var RoomInventoryService
     */
    private $roomInventoryService;

    /**
     * RoomInventoryController constructor.
     * @param RoomInventoryService $roomInventoryService
     */
    public function __construct(RoomInventoryService $roomInventoryService)
    {
        $this->roomInventoryService = $roomInventoryService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('hm::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('hm::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
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
     * @return Response
     */
    public function edit()
    {
        return view('hm::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @param RoomInventory $roomInventory
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(RoomInventory $roomInventory)
    {
        $this->roomInventoryService->delete($roomInventory->id);
        Session::flash('message', 'Room inventory deleted successfully');

        return redirect()->back();
    }
}
