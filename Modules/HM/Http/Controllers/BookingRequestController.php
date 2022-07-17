<?php

namespace Modules\HM\Http\Controllers;

use App\Services\UserService;
use App\Traits\FileTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Http\Requests\StoreUpdateBookingRequest;
use Modules\HM\Services\BookingRequestService;
use Modules\HM\Services\RoomTypeService;
use Modules\HRM\Services\DepartmentService;
use Modules\HRM\Services\DesignationService;
use Modules\HRM\Services\EmployeeService;
use Modules\TMS\Services\TrainingsService;

class BookingRequestController extends Controller
{
    use FileTrait;

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
    private $trainingService;
    /**
     * @var DesignationService
     */
    private $userService;

    /**
     * BookingRequestController constructor.
     * @param BookingRequestService $bookingRequestService
     * @param RoomTypeService $roomTypeService
     * @param DepartmentService $departmentService
     * @param EmployeeService $employeeServices
     * @param DesignationService $designationService
     * @param TrainingsService $trainingService
     * @param UserService $userService
     */
    public function __construct(
        BookingRequestService $bookingRequestService,
        RoomTypeService $roomTypeService,
        DepartmentService $departmentService,
        EmployeeService $employeeServices,
        DesignationService $designationService,
        TrainingsService $trainingService,
        UserService $userService
    ) {
        $this->roomTypeService = $roomTypeService;
        $this->departmentService = $departmentService;
        $this->bookingRequestService = $bookingRequestService;
        $this->employeeServices = $employeeServices;
        $this->designationService = $designationService;
        $this->trainingService = $trainingService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $bookingRequests = [];

        switch (1) {
            case $this->userService->isDirectorGeneral():
                // show only forwarded requests
                $bookingRequests = $this->bookingRequestService->getBookingRequestWithInIds(['physical_facility']);
                break;
            case $this->userService->isDirectorAdmin():
                // show all General requests with forwarded ones
                $bookingRequests = $this->bookingRequestService->getBookingRequestWithInIds(['general']);
                break;
            case $this->userService->isDirectorTraining():
                // show all Training and Venue requests with forwarded ones
                $bookingRequests = $this->bookingRequestService->getBookingRequestWithInIds([
                    'training',
                    'venue',
                    'physical_facility'
                ]);
                break;
            default:
                $bookingRequests = $this->bookingRequestService->findBy(
                    ['type' => 'booking'],
                    null,
                    ['column' => 'created_at', 'direction' => 'desc']
                );
                break;
        }

        return view('hm::booking-request.index', compact('bookingRequests'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $roomTypes = $this->roomTypeService->getRoomTypesThatHasRooms(true);
        $departments = $this->departmentService->findAll();
        $employees = $this->employeeServices->findAll();
        $employeeOptions = $this->employeeServices->getEmployeesForDropdown();
        $designations = $this->designationService->findAll();
        $type = 'booking';

        // Collecting Training List from Training Modules
        $trainings = $this->trainingService->findAll();

        return view(
            'hm::booking-request.create',
            compact(
                'roomTypes',
                'departments',
                'employees',
                'employeeOptions',
                'designations',
                'type',
                'trainings'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreUpdateBookingRequest $request
     * @return Response
     */
    public function store(StoreUpdateBookingRequest $request)
    {
        // dd($request->all());
        $this->bookingRequestService->store($request->all());
        Session::flash('success', trans('hm::booking-request.flash_messages.create'));
        return redirect()->route('booking-requests.index');
    }

    /**
     * Show the specified resource.
     * @param RoomBooking $roomBooking
     * @return Factory|Application|View
     */
    public function show(RoomBooking $roomBooking)
    {
        $forwardToUsers = $this->userService->getAdminExceptLoggedInUserRole();
        $type = 'booking';
        $editLink = $this->bookingRequestService->getEditLink($roomBooking);
        $isAnyGuestAssignedToRooms = $this->bookingRequestService->isAnyGuestAssignedRoom($roomBooking);
        if ($roomBooking->booking_type == 'physical_facility') {
            return view(
                'hm::booking-request.physical-facility-show',
                compact('roomBooking', 'type', 'forwardToUsers', 'isAnyGuestAssignedToRooms')
            );
        } else {
            return view(
                'hm::booking-request.show',
                compact('roomBooking', 'type', 'forwardToUsers', 'editLink', 'isAnyGuestAssignedToRooms')
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param RoomBooking $roomBooking
     * @return Response
     */
    public function edit(RoomBooking $roomBooking)
    {
        $employees = $this->employeeServices->findAll();
        $requester = $roomBooking->requester;
        $referee = $roomBooking->referee;
        $roomInfos = $roomBooking->roomInfos;
        $roomTypes = $this->roomTypeService->getRoomTypesThatHasRooms(true);
        $departments = $this->departmentService->findAll();
        $guestInfos = $roomBooking->guestInfos;
        $employeeOptions = $this->employeeServices->getEmployeesForDropdown();
        $designations = $this->designationService->findAll();
        $trainings = $this->trainingService->findAll();

        $type = 'booking';

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
        $this->bookingRequestService->updateRequest($request->all(), $roomBooking);
        Session::flash('success', trans('labels.update_success'));
        return redirect()->route('booking-requests.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
