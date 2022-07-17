<?php

namespace App\Http\Controllers;

use App\Services\PhysicalFacilityRequestService;
use Illuminate\Http\Request;
use Modules\HM\Services\RoomTypeService;

class PhysicalFacilityRequestController extends Controller
{
    /**
     * @var RoomTypeService
     */
    private $roomTypeService;
    /**
     * @var PhysicalFacilityRequestService
     */
    private $physicalFacilityRequestService;

    /**
     * PhysicalFacilityRequestController constructor.
     * @param RoomTypeService $roomTypeService
     * @param PhysicalFacilityRequestService $physicalFacilityRequestService
     */
    public function __construct(
        RoomTypeService $roomTypeService,
        PhysicalFacilityRequestService $physicalFacilityRequestService
    ) {
        $this->roomTypeService = $roomTypeService;
        $this->physicalFacilityRequestService = $physicalFacilityRequestService;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        $roomTypes = $this->roomTypeService->getRoomTypesThatHasRooms();
        $page = 'create';
        return view('physical-facility-request.create', compact('page', 'roomTypes'));
    }

    public function store(Request $request)
    {
        $save = $this->physicalFacilityRequestService->store($request->all());
        return redirect()->back();
    }

}
