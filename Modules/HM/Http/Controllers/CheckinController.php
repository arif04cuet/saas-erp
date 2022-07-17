<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Http\Requests\StoreUpdateBookingRequest;
use Modules\HM\Services\BookingRequestService;
use Modules\HM\Services\CheckinPhysicalFacilityService;
use Modules\HM\Services\HostelService;
use Modules\HM\Services\RoomService;
use Modules\HM\Services\RoomTypeService;
use Modules\HRM\Services\DepartmentService;
use Modules\HRM\Services\DesignationService;
use Modules\HRM\Services\EmployeeService;
use Modules\TMS\Services\TrainingsService;

class CheckinController extends Controller
{
    /**
     * @var RoomTypeService
     */
    private $roomTypeService;
    /**
     * @var DepartmentService
     */
    private $departmentService;
    /**
     * @var BookingRequestService
     */
    private $bookingRequestService;
    /**
     * @var EmployeeService
     */
    private $employeeServices;
    /**
     * @var DesignationService
     */
    private $designationService;
    /**
     * @var TrainingsService
     */
    private $trainingsService;
    /**
     * @var HostelService
     */
    private $hostelService;
    /**
     * @var RoomService
     */
    private $roomService;
    /**
     * @var CheckinPhysicalFacilityService
     */
    private $checkinPhysicalFacilityService;

    /**
     * BookingRequestController constructor.
     * @param BookingRequestService $bookingRequestService
     * @param CheckinPhysicalFacilityService $checkinPhysicalFacilityService
     * @param RoomTypeService $roomTypeService
     * @param DepartmentService $departmentService
     * @param EmployeeService $employeeServices
     * @param DesignationService $designationService
     * @param TrainingsService $trainingsService
     * @param HostelService $hostelService
     * @param RoomService $roomService
     */
    public function __construct(
        BookingRequestService $bookingRequestService,
        CheckinPhysicalFacilityService $checkinPhysicalFacilityService,
        RoomTypeService $roomTypeService,
        DepartmentService $departmentService,
        EmployeeService $employeeServices,
        DesignationService $designationService,
        TrainingsService $trainingsService,
        HostelService $hostelService,
        RoomService $roomService
    ) {
        $this->roomTypeService = $roomTypeService;
        $this->departmentService = $departmentService;
        $this->bookingRequestService = $bookingRequestService;
        $this->employeeServices = $employeeServices;
        $this->designationService = $designationService;
        $this->trainingsService = $trainingsService;
        $this->hostelService = $hostelService;
        $this->roomService = $roomService;
        $this->checkinPhysicalFacilityService = $checkinPhysicalFacilityService;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $checkins = $this->bookingRequestService->findBy(['type' => 'checkin'], null,
            ['column' => 'created_at', 'direction' => 'desc']);
        return view('hm::check-in.index', compact('checkins'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function createOptions()
    {
        return view('hm::check-in.create-options');
    }

    /**
     * Show the form for creating a new resource.
     * @param RoomBooking $roomBooking
     * @return Factory|Application|View
     */
    public function create(RoomBooking $roomBooking = null)
    {
        if (!is_null($roomBooking)) {
            if ($roomBooking->booking_type == RoomBooking::getBookingTypes()['physical_facility']) {
                return $this->checkinPhysicalFacilityService->create($roomBooking);
            }
        }

        $roomTypes = $this->roomTypeService->findAll();
        $departments = $this->departmentService->findAll();
        $employees = $this->employeeServices->findAll();
        $employeeOptions = $this->employeeServices->getEmployeesForDropdown();
        $designations = $this->designationService->findAll();
        $type = 'checkin';
        $checkinType = $roomBooking ? 'from-booking' : 'walkin';
        $viewName = $checkinType == 'walkin' ? 'hm::booking-request.create' : 'hm::booking-request.edit';
        $trainings = $this->trainingsService->findAll();

        $roomDetails = [];
        $hostels = $this->hostelService->getAll();

        foreach ($hostels as $hostel) {
            $availableRooms = $this->roomService->getActiveRoomStatusOfHostel($hostel);
            $roomDetails[$hostel->name] = $this->roomService->sortRoomsByLevel($availableRooms);
        }
        return view($viewName, compact(
            'roomTypes',
            'departments',
            'employees',
            'employeeOptions',
            'designations',
            'type',
            'checkinType',
            'trainings',
            'hostels',
            'roomDetails',
            'roomBooking'
        ));
    }

    public function store(StoreUpdateBookingRequest $request, $roomBookingId = null)
    {
        $data = $request->all();
        // dd($data);
        if ($roomBookingId) {
            $data['booking_id'] = $roomBookingId;
        }
        $checkin = $this->bookingRequestService->store($data, 'checkin');
        Session::flash('success', trans('labels.save_success'));
        return redirect(route('hostel.selection', ['roomCheckinId' => $checkin->id]));
    }

    /**
     * Display a listing of the resource.
     * @param bool $isTraining
     * @return Response
     */
    public function approvedRequests($isTraining = false)
    {
        $bookingRequests = $isTraining
            ? $this->bookingRequestService->pluckTrainingTitleBookingIdForApprovedBooking()
            : $this->bookingRequestService->pluckContactBookingIdForApprovedBooking();
        return view('hm::check-in.approved-booking-requests', compact('bookingRequests'));
    }

    /**
     * Show the specified resource.
     * @param RoomBooking $roomBooking
     * @return Factory|Application|Response|View
     */
    public function show(RoomBooking $roomBooking)
    {
        $type = 'checkin';
        $isAnyGuestAssignedToRooms = $this->bookingRequestService->isAnyGuestAssignedRoom($roomBooking);
        if ($roomBooking->type != 'checkin') {
            abort(404);
        }
        return view('hm::booking-request.show', compact('roomBooking', 'type', 'isAnyGuestAssignedToRooms'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param RoomBooking $roomBooking
     * @return Response
     */
    public function edit(RoomBooking $roomBooking, $bookingId)
    {
        $employees = $this->employeeServices->findAll();
        $requester = $roomBooking->requester;
        $referee = $roomBooking->referee;
        $roomInfos = $roomBooking->roomInfos;
        $roomTypes = $this->roomTypeService->findAll();
        $departments = $this->departmentService->findAll();
        $guestInfos = $roomBooking->guestInfos;
        $employeeOptions = $this->employeeServices->getEmployeesForDropdown();
        $designations = $this->designationService->findAll();
        $trainings = $this->trainingsService->findAll();

        $type = 'checkin';

        return view('hm::booking-request.edit', compact(
            'requester',
            'departments',
            'roomInfos',
            'guestInfos',
            'roomBooking',
            'roomTypes',
            'referee',
            'employeeOptions',
            'employees',
            'designations',
            'bookingType',
            'trainings',
            'type'
        ));
    }


    /**
     * Update the specified resource in storage.
     * @param StoreUpdateBookingRequest $request
     * @param RoomBooking $roomBooking
     * @return Response
     */
    public function update(StoreUpdateBookingRequest $request, RoomBooking $roomBooking)
    {
        $checkin = $this->bookingRequestService->update($request->all(), $roomBooking);
        Session::flash('update', trans('labels.update_success'));

        return redirect(route('hostel.selection', ['roomBookingId' => $checkin->id]));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

}
