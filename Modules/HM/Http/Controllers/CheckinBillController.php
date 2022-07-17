<?php

namespace Modules\HM\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Services\BookingRequestService;
use Modules\HM\Services\CheckinService;

class CheckinBillController extends Controller
{
    private $checkinService;

    /**
     * CheckinBillController constructor.
     * @param CheckinService $checkinService
     */
    public function __construct(CheckinService $checkinService)
    {
        $this->checkinService = $checkinService;
    }

    /**
     * Display a listing of the resource.
     * @param RoomBooking $roomBooking
     * @return Response
     */
    public function index(RoomBooking $roomBooking)
    {
        $duration = $this->checkinService->getCheckedInDuration($roomBooking);

        $endDate = $this->checkinService->getCheckedInEndDate($roomBooking);

        $totalBill = $this->checkinService->getTotalBill($roomBooking);

        return view('hm::check-in.bill.index')->with([
            'checkin' => $roomBooking,
            'duration' => $duration,
            'endDate' => $endDate,
            'totalBill' => $totalBill
        ]);
    }
}
