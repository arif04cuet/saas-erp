<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Services\BookingRequestService;
use Modules\HM\Services\CheckInApprovedTrainingService;
use Modules\HM\Services\HostelService;
use Modules\HM\Services\RoomTypeService;
use Modules\TMS\Services\TraineeService;

class CheckInApprovedTrainingController extends Controller
{
    /**
     * @var BookingRequestService
     */
    private $bookingRequestService;
    /**
     * @var HostelService
     */
    private $hostelService;

    /**
     * @var RoomTypeService
     */
    private $roomTypeService;

    /**
     * @var TraineeService
     */
    private $traineeService;
    /**
     * @var CheckInApprovedTrainingService
     */
    private $checkInApprovedTrainingService;

    /**
     * CheckInApprovedTrainingController constructor.
     * @param BookingRequestService $bookingRequestService
     * @param RoomTypeService $roomTypeService
     * @param HostelService $hostelService
     * @param CheckInApprovedTrainingService $checkInApprovedTrainingService
     * @param TraineeService $traineeService
     */
    public function __construct(
        BookingRequestService $bookingRequestService,
        RoomTypeService $roomTypeService,
        HostelService $hostelService,
        CheckInApprovedTrainingService $checkInApprovedTrainingService,
        TraineeService $traineeService
    ) {
        $this->bookingRequestService = $bookingRequestService;
        $this->hostelService = $hostelService;
        $this->roomTypeService = $roomTypeService;
        $this->checkInApprovedTrainingService = $checkInApprovedTrainingService;
        $this->traineeService = $traineeService;
    }


    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        return view('hm::check-in.approved-training.index');
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $bookingRequests = $this->bookingRequestService
            ->pluckTrainingTitleBookingIdForApprovedBooking();
        $hostels = collect($this->hostelService->getHostelsForDropdown())->prepend('', '')->toArray();
        $roomTypes = $this->roomTypeService
            ->getRoomTypesForDropdown();
        $hostelsWithDetails = $this->hostelService->getAvailableHostelRoomDetails();

        return view(
            'hm::check-in.approved-training.create',
            compact(
                'hostels',
                'hostelsWithDetails',
                'roomTypes',
                'bookingRequests'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->checkInApprovedTrainingService->store($request->all())) {
            return redirect(route('check-in.index'))
                ->with('success', trans('labels.save_success'));
        } else {
            return redirect(route('check-in.index'))
                ->with('error', trans('labels.save_fail'));
        }
    }

    /**
     * @param RoomBooking $roomBooking
     * @return RoomBooking
     */
    public function show(RoomBooking $roomBooking)
    {
        return $roomBooking;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        return view('hm::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function json(RoomBooking $roomBooking)
    {
        $training = $roomBooking->training;
        $traineesForDropDown = $this->checkInApprovedTrainingService->filterTraineeByHostelCheckInForDropDown($training);
        $dynamicContent = $this->checkInApprovedTrainingService
            ->getDynamicContent($roomBooking, $training);
        return response()->json(
            array(
                'trainingId' => $training->id,
                'roomBookingId' => $roomBooking->id,
                'traineesForDropdown' => $traineesForDropDown,
                'html' => $dynamicContent->render()
            )
        );
    }
}
