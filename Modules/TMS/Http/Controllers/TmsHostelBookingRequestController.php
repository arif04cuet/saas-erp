<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Services\RoomTypeService;
use Modules\TMS\Http\Requests\TmsHostelBookingRequest;
use Modules\TMS\Services\TmsHostelBookingRequestService;
use Modules\TMS\Services\TrainingsService;

class TmsHostelBookingRequestController extends Controller
{
    /**
     * @var TmsHostelBookingRequestService
     */
    private $tmsHostelBookingRequestService;

    /**
     * TmsHostelBookingRequestController constructor.
     * @param TmsHostelBookingRequestService $tmsHostelBookingRequestService
     */
    public function __construct(TmsHostelBookingRequestService $tmsHostelBookingRequestService)
    {
        $this->tmsHostelBookingRequestService = $tmsHostelBookingRequestService;
    }

    /**
     * Display a listing of the resource.
     * @return void
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|Application|View
     */
    public function create()
    {
        $trainings = $this->tmsHostelBookingRequestService->getTrainingsForDropdown();
        $roomTypes = $this->tmsHostelBookingRequestService->getRoomTypesForDropdown();
        $trainingInformations = $this->tmsHostelBookingRequestService->getTrainingInformations()->toJson();
        $this->tmsHostelBookingRequestService->clearSessionValues();
        $action = 'create';
        return view('tms::hostel-booking-request.create',
            compact('trainings', 'roomTypes', 'trainingInformations', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     * @param TmsHostelBookingRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(TmsHostelBookingRequest $request)
    {
        if ($this->tmsHostelBookingRequestService->store($request->all())) {
            return redirect(route('tms.hostel-booking-requests.create'))
                ->with('success', trans('labels.save_success'));
        } else {
            if (!Session::has('error')) {
                Session::flash('error', trans('labels.save_fail'));
            }
            return redirect()->route('tms.hostel-booking-requests.create');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        return;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Factory|Application|View
     */
    public function edit($id)
    {
        $roomBookingId = $id;
        $trainings = $this->tmsHostelBookingRequestService->getTrainingsForDropdown();
        $roomTypes = $this->tmsHostelBookingRequestService->getRoomTypesForDropdown();
        $trainingInformations = $this->tmsHostelBookingRequestService->getTrainingInformations()->toJson();
        $oldResponses = $this->tmsHostelBookingRequestService->getOldTmsHostelBookingRequestInformation($id);
        if (!is_null($oldResponses)) {
            $this->tmsHostelBookingRequestService->setOldValuesToSession($oldResponses);
        }
        $action = 'edit';
        return view('tms::hostel-booking-request.create',
            compact('trainings', 'roomTypes', 'trainingInformations', 'action', 'roomBookingId'));
    }

    /**
     * Update the specified resource in storage.
     * @param TmsHostelBookingRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(TmsHostelBookingRequest $request)
    {
        if ($this->tmsHostelBookingRequestService->update($request->all())) {
            return redirect(route('booking-requests.show', $request['room_booking_id']))
                ->with('success', trans('labels.update_success'));
        } else {
            return redirect(route('booking-requests.show', $request['room_booking_id']))
                ->with('error', trans('labels.update_fail'));
        };
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}
