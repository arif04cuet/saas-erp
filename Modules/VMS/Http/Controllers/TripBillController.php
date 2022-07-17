<?php

namespace Modules\VMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\VMS\Entities\Trip;
use Modules\VMS\Entities\TripBillPayment;
use Modules\VMS\Services\TripBillService;
use Modules\VMS\Services\TripService;

class TripBillController extends Controller
{
    /**
     * @var TripService
     */
    private $tripService;

    /**
     * @var TripBillService
     */
    private $tripBillService;

    public function __construct(TripService $tripService, TripBillService $tripBillService)
    {
        $this->tripBillService = $tripBillService;
        $this->tripService = $tripService;
    }


    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $statusCssArray = $this->tripService->getStatusClassArray();
        $trips = $this->tripService->getTripsForBilling();
        $tripTypes = Trip::getTypes();
        return view('vms::trip.bill.index', compact('trips', 'statusCssArray', 'tripTypes'));
    }

    /**
     * Show the specified resource.
     * @param Trip $trip
     * @return Factory|Application|RedirectResponse|View
     */
    public function show(Trip $trip)
    {
        try {
            $tripTypes = Trip::getTypes();
            if ($trip->type == $tripTypes['official']) {
                throw new \Exception(trans('vms::trip.bill.flash_messages.show_official_error'));
            }
            $originalTrip = $trip;
            $trip = $this->tripBillService->calculateBillForTrip($trip);
            $activeSetting = $this->tripBillService->getActiveSettingForTrip($originalTrip);
            $paymentOptions = Trip::getPaymentOptions();
            $paymentStatus = TripBillPayment::getPaymentStatus();
            return view('vms::trip.bill.show',
                compact('trip', 'paymentOptions', 'activeSetting', 'tripTypes', 'paymentStatus'));
        } catch (\Exception $e) {
            Log::error('Vehicle Bill Error ' . $e->getMessage() . ' :Trace ' . $e->getTraceAsString());
            Session::flash('error', $e->getMessage());
            return redirect()->route('vms.trip.bill.index');
        }
    }

    public function payment(Request $request, Trip $trip)
    {
        if ($this->tripBillService->makePayment($trip, $request->all())) {
            Session::flash('success', trans('vms::trip.bill.flash_messages.payment_success'));
            return redirect()->route('vms.trip.bill.show', $trip);
        } else {
            if (Session::has('payment-error')) {
                Session::flash('error', Session::get('payment-error'));
            } else {
                Session::flash('error', trans('vms::trip.bill.flash_messages.payment_error'));
            }
            return redirect()->route('vms.trip.bill.show', $trip);
        }
    }
}
