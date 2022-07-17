<?php

namespace Modules\HM\Http\Controllers;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Services\BookingRequestService;

class BookingRequestCancelController extends Controller
{
    /**
     * @var BookingRequestService
     */
    private $bookingRequestService;

    public function __construct(BookingRequestService $bookingRequestService)
    {
        $this->bookingRequestService = $bookingRequestService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|View
     */
    public function check()
    {
        return view('hm::booking-request.public.cancel.check');
    }

    public function show(Request $request)
    {
        try {
            $referenceNumber = $request['reference_number'];
            $roomBooking = $this->bookingRequestService->findBy([
                'shortcode' => $referenceNumber,
                'status' => RoomBooking::getStatuses()['pending']
            ])->first();
            if (is_null($roomBooking)) {
                throw new Exception(trans('hm::booking-request.cancel.flash_messages.request_not_found',
                    ['reference' => $referenceNumber]));
            }
            return view('hm::booking-request.public.cancel.show', compact('roomBooking'));
        } catch (Exception $e) {
            Log::error('Booking Cancellation Error: ' . $e->getMessage() . ' :Trace' . $e->getTraceAsString());
            Session::flash('error', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return Response
     */
    public function cancel(Request $request)
    {
        $rejectStatus = RoomBooking::getStatuses()['rejected'];
        $roomBooking = $this->bookingRequestService->findOne($request['room_booking_id']);
        if ($this->bookingRequestService->updateStatus($roomBooking, ['status' => $rejectStatus])) {
            return redirect()->route('booking-requests.check')->with('success',
                trans('hm::booking-request.cancel.flash_messages.success'));
        } else {
            return redirect()->route('booking-requests.check')->with('error', trans('labels.generic_error_message'));
        }
    }
}
