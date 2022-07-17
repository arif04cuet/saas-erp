<?php

namespace Modules\HM\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\HM\Entities\BookingCheckin;
use Modules\HM\Entities\BookingGuestInfo;
use Modules\HM\Entities\RoomBooking;
use function GuzzleHttp\Psr7\_parse_request_uri;

class CheckinPhysicalFacilityService
{
    /**
     * @var HostelService
     */
    private $hostelService;
    /**
     * @var RoomTypeService
     */
    private $roomTypeService;
    /**
     * @var CheckInApprovedTrainingService
     */
    private $checkinApprovedTrainingService;
    /**
     * @var BookingRequestService
     */
    private $bookingRequestService;

    private $checkinService;

    /**
     * CheckinPhysicalFacilityService constructor.
     * @param HostelService $hostelService
     * @param RoomTypeService $roomTypeService
     * @param BookingRequestService $bookingRequestService
     * @param CheckinService $checkinService
     * @param CheckInApprovedTrainingService $checkInApprovedTrainingService
     */

    public function __construct(
        HostelService $hostelService,
        RoomTypeService $roomTypeService,
        BookingRequestService $bookingRequestService,
        CheckinService $checkinService,
        CheckInApprovedTrainingService $checkInApprovedTrainingService
    ) {
        $this->roomTypeService = $roomTypeService;
        $this->hostelService = $hostelService;
        $this->bookingRequestService = $bookingRequestService;
        $this->checkinService = $checkinService;
        $this->checkinApprovedTrainingService = $checkInApprovedTrainingService;
    }

    public function create(RoomBooking $roomBooking)
    {
        $hostels = collect($this->hostelService->getHostelsForDropdown())->prepend('', '')->toArray();
        $roomTypes = $this->roomTypeService
            ->getRoomTypesForDropdown();
        $hostelsWithDetails = $this->hostelService->getAvailableHostelRoomDetails();
        $type = 'checkin';
        return view('hm::check-in.physical-facility.create', compact(
                'hostels',
                'roomTypes',
                'roomBooking',
                'type',
                'hostelsWithDetails')
        );
    }

    public function store(array $data)
    {

        try {
            DB::beginTransaction();
            $oldRoomBooking = RoomBooking::find($data['room_booking_id']);
            $newRoomBooking = null;

            // create another row in booking request
            if ($data['room_booking_id']) {
                $newRoomBooking = $this->checkinApprovedTrainingService
                    ->createNewRoomBookingForCheckin($oldRoomBooking);
            }

            //save requester information
            $requester = $this->checkinApprovedTrainingService->saveRoomBookingRequesterInformation(
                $oldRoomBooking, $newRoomBooking
            );
            //save room information
            $this->checkinApprovedTrainingService->saveRoomInformation($newRoomBooking, $data['assign']);

            // save checkin mapper
            BookingCheckin::create(['checkin_id' => $newRoomBooking->id, 'booking_id' => $oldRoomBooking->id]);

            // save checkin room numbers
            $this->checkinApprovedTrainingService
                ->saveRoomNumbersOfCheckIn($newRoomBooking, $data['assign']);

            // save the person as Hostel Booking Guest
            $this->saveOrganizationGuestAsBookingGuest($newRoomBooking, $data['assign']);

            // notify requester
            //$this->sendEmail($requester->email, $newRoomBooking);
            // notify directoradmin
            //$this->sendEmail('kamrul_61@yahoo.com', $newRoomBooking);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Checkin Trainee Error" . $e->getMessage() . " trace:" . $e->getTraceAsString());
            return false;
        }

    }

    /**
     *  {
     *      'assign':[
     *          'room_type_id': 1
     *          'room'    {
     *              'name',
     *              'mobile_number',
     *              'room_numbers'
     *           },
     *          'room': {...},
     *          'room': {...},
     *      ]
     *  }
     * @param RoomBooking $roomBooking
     * @param array $data
     */
    public function saveOrganizationGuestAsBookingGuest(RoomBooking $roomBooking, array $data)
    {
        foreach ($data as $rooms) {
            foreach ($rooms['room'] as $room) {
                $eachGuest = collect();
                $eachGuest = $this->checkinService->prepareHostelCheckinDataWithMinimumInfo($roomBooking, $room);
                $guest = BookingGuestInfo::create($eachGuest);
                $checkInDetails = $this->checkinApprovedTrainingService->saveCheckInDetails($roomBooking->id,
                    $room['room_numbers'], $guest->id);

            }
        }
    }
}

