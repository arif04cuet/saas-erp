<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Services\BookingRequestService;

class BookingRequestForwardController extends Controller
{
    private $bookingRequestService;

    public function __construct(BookingRequestService $bookingRequestService)
    {
        $this->bookingRequestService = $bookingRequestService;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param RoomBooking $roomBooking
     * @return mixed
     */
    public function store(Request $request, RoomBooking $roomBooking)
    {
        if ($this->bookingRequestService->forwardBookingRequest($roomBooking, $request->all())) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('success', trans('labels.save_fail'));
        }

        return redirect()->route('booking-requests.index');
    }

}
