<?php

namespace App\Http\Controllers;

use App\Entities\PhysicalFacilityRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Modules\HM\Entities\BookingVendorConfirmation;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Http\Requests\StoreUpdateBookingRequest;
use Modules\HM\Http\Requests\UpdateBookingRequestStatusRequest;
use Modules\HM\Services\BookingRequestService;
use Modules\HM\Services\RoomTypeService;
use Modules\HRM\Services\DepartmentService;
use Modules\HRM\Services\DesignationService;
use Modules\HRM\Services\EmployeeService;
use Modules\TMS\Services\TrainingsService;

class PublicBookingRequestController extends Controller
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
     * @var EmployeeService
     */
    private $employeeServices;
    /**
     * @var DesignationService
     */
    private $designationService;
    /**
     * @var BookingRequestService
     */
    private $bookingRequestService;
    /**
     * @var TrainingsService
     */
    private $trainingsService;

    /**
     * PublicBookingRequestController constructor.
     * @param BookingRequestService $bookingRequestService
     * @param RoomTypeService $roomTypeService
     * @param DepartmentService $departmentService
     * @param EmployeeService $employeeServices
     * @param DesignationService $designationService
     * @param TrainingsService $trainingsService
     */
    public function __construct(
        BookingRequestService $bookingRequestService,
        RoomTypeService $roomTypeService,
        DepartmentService $departmentService,
        EmployeeService $employeeServices,
        DesignationService $designationService,
        TrainingsService $trainingsService
    ) {
        $this->roomTypeService = $roomTypeService;
        $this->departmentService = $departmentService;
        $this->employeeServices = $employeeServices;
        $this->designationService = $designationService;
        $this->bookingRequestService = $bookingRequestService;
        $this->trainingsService = $trainingsService;
    }

    public function hostel()
    {
        return view('hostel.index');
    }

    public function create()
    {
        $roomTypes = $this->roomTypeService->getRoomTypesThatHasRooms();
        $departments = $this->departmentService->findAll();
        $employees = $this->employeeServices->findAll();
        $employeeOptions = $this->employeeServices->getEmployeesForDropdown();
        $designations = $this->designationService->findAll();
        $trainings = $this->trainingsService->findAll();
        $type = 'booking';

        return view('hm::booking-request.public.create', compact(
            'roomTypes',
            'departments',
            'employees',
            'employeeOptions',
            'designations',
            'trainings',
            'type'
        ));
    }

    public function store(StoreUpdateBookingRequest $request)
    {
        $this->bookingRequestService->store($request->all());
        Session::flash('success', trans('hm::booking-request.flash_messages.create'));
        return redirect()->back();
    }

    public function confirmation($key)
    {
        $vendorRequest = BookingVendorConfirmation::where('unique_key', $key)->first();
        $roomBooking = RoomBooking::where('physical_facility_request_id',
            $vendorRequest->physical_facility_request_id)->first();

        $type = $roomBooking->type;

        if (Carbon::parse($vendorRequest->last_validity) >= Carbon::today()) {
            return view('hm::booking-request.public.confirmation',
                compact('roomBooking', 'type', 'vendorRequest'));
        } else {
            echo "Invalid link!";
        }
    }

    public function approve($vendorConfirmationID)
    {
        BookingVendorConfirmation::where('id', $vendorConfirmationID)
            ->first()
            ->update(array(
                'status' => 'approved'
            ));

        Session::flash('success', trans('labels.update_success'));

        return redirect()->home();
    }

    public function reject($roomBookingID, $vendorConfirmationID)
    {
        //dd($roomBookingID, $vendorConfirmationID);
        BookingVendorConfirmation::where('id', $vendorConfirmationID)
            ->first()
            ->update(array(
                'status' => 'rejected'
            ));

        RoomBooking::where('id', $roomBookingID)
            ->first()
            ->update(array(
                'status' => 'rejected'
            ));

        Session::flash('success', trans('labels.update_success'));

        return redirect()->home();
    }
}
