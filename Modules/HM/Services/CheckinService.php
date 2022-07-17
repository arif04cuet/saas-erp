<?php
/**
 * Created by vs code.
 * User: Araf
 * Date: 12/06/2022
 * Time: 6:17 PM
 */

namespace Modules\HM\Services;


use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\HM\Entities\RoomBooking;
use Modules\HM\Repositories\BookingGuestInfoRepository;
use Modules\HM\Repositories\CheckinRepository;
use Modules\HM\Repositories\RoomBookingRepository;

class CheckinService
{
    use CrudTrait;

    private $checkinRepository;
    private $roomService;
    private $bookingGuestInfoRepository;
    /**
     * @var RoomBookingRepository
     */
    private $roomBookingRepository;

    /**
     * CheckinService constructor.
     * @param CheckinRepository $checkinRepository
     * @param RoomService $roomService
     * @param BookingGuestInfoRepository $bookingGuestInfoRepository
     * @param RoomBookingRepository $roomBookingRepository
     */
    public function __construct(
        CheckinRepository $checkinRepository,
        RoomService $roomService,
        BookingGuestInfoRepository $bookingGuestInfoRepository,
        RoomBookingRepository $roomBookingRepository
    ) {
        $this->checkinRepository = $checkinRepository;
        $this->roomService = $roomService;
        $this->bookingGuestInfoRepository = $bookingGuestInfoRepository;
        $this->setActionRepository($this->checkinRepository);
        $this->roomBookingRepository = $roomBookingRepository;
    }

    public function store($data)
    {
        DB::transaction(function () use ($data) {
            $this->save($data);
            $guestInfo = $this->bookingGuestInfoRepository->findOne($data['booking_guest_info_id']);
            $guestInfo->update(['status' => 'checkin']);
        });
    }

    public function checkout(RoomBooking $checkin)
    {
        return DB::transaction(function () use ($checkin) {
            $checkoutTime = Carbon::now();
            $this->roomBookingRepository->update($checkin, ['actual_end_date' => $checkoutTime]);

            $checkin->checkinDetails->each(function ($checkinDetail) {
                $checkinDetail->room()->update(['status' => 'available']);
            });

            $checkin->rooms()->update(['status' => 'checkedout', 'checkout_date' => $checkoutTime]);

            $checkin->rooms()->each(function ($checkinRoom) {
                $checkinRoom->room()->update(['status' => 'available']);
            });

            $checkin->checkinDetails()->update(['checkout_date' => $checkoutTime]);

            return $checkin;
        });
    }

    private function getRoomStatus($room)
    {
        $currentCheckin = $this->checkinRepository->countByRoom($room->id);
        $capacity = $room->roomType->capacity;

        if ($currentCheckin == 0) {
            return 'available';
        } else {
            if ($currentCheckin >= $capacity) {
                return 'unavailable';
            } else {
                return 'partially-available';
            }
        }
    }

    public function getAlreadyCheckinGuestInfo($roomId, $checkinId)
    {
        return $this->checkinRepository->getCheckinInfoRoomIdAndCheckinId($roomId, $checkinId);

    }

    /**
     * @param RoomBooking $roomBooking
     * @return int
     */
    public function getCheckedInDuration(RoomBooking $roomBooking)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $roomBooking->start_date);

        $endDate = $this->getCheckedInEndDate($roomBooking);

        $duration = $startDate->diffInDays($endDate);

        return $duration ?: 1;
    }

    /**
     * @param RoomBooking $roomBooking
     * @return Carbon
     */
    public function getCheckedInEndDate(RoomBooking $roomBooking)
    {
        if ($roomBooking->actual_end_date) {
            $actualEndDate = Carbon::createFromFormat('Y-m-d', $roomBooking->actual_end_date);
            $endDate = Carbon::createFromFormat('Y-m-d', $roomBooking->end_date);

            $endDate = $endDate->greaterThanOrEqualTo($actualEndDate) ? $endDate : $actualEndDate;
        } else {
            $endDate = Carbon::createFromFormat('Y-m-d', $roomBooking->end_date);
        }

        return $endDate;
    }

    public function getTotalBill(RoomBooking $roomBooking): float
    {
        $duration = $this->getCheckedInDuration($roomBooking);

        $totalRoomRates = $roomBooking->roomInfos->sum(function ($roomInfo) {
            return floatval(bcmul($roomInfo->rate, $roomInfo->quantity));
        });

        $totalBill = bcmul($duration, $totalRoomRates);
        $vatTax = bcdiv(bcmul($totalBill, 20.00), 100.00);
        return floatval(bcadd($totalBill, $vatTax));
    }

    public function getDueAmount(RoomBooking $roomBooking): float
    {
        $totalBill = $this->getTotalBill($roomBooking);
        $totalPayments = $roomBooking->payments()->sum('amount');

        return floatval(bcsub($totalBill, $totalPayments));
    }

    /**
     * @param $checkInId
     * @param $bookingGuestInfoId
     * @param $roomId
     * @return Model
     */
    public function storeCheckInDetailsOfGuest(
        $checkInId,
        $bookingGuestInfoId,
        $roomId
    ) {
        $checkInTime = Carbon::now();
        $data = [];
        $data['checkin_id'] = $checkInId;
        $data['booking_guest_info_id'] = $bookingGuestInfoId;
        $data['room_id'] = $roomId;
        $data['checkin_date'] = $checkInTime;
        return $this->save($data);
    }

    /**
     * Get checkin details by array of checkinIds
     * @param array $checkinIds
     * @return mixed
     */
    public function getDetailsByCheckinIds(array $checkinIds)
    {
        return $this->actionRepository->getDetailsByCheckinIds($checkinIds);
    }

    /**
     *  Create a booking guest using only guest_name and his mobile_number
     *  [
     *      'name' => Guest Name
     *      'mobile_number' => Guest Contact Number
     *   ]
     * @param RoomBooking $roomBooking
     * @param array $data
     * @return array
     */

    public function prepareHostelCheckinDataWithMinimumInfo(RoomBooking $roomBooking, array $data)
    {
        $name = $data['name'] ?? '';
        $mobileNumber = $data['mobile_number'] ?? '';
        $values = explode(' ', $name);
        $firstName = $values[0] ?? '';
        $lastName = $values[1] ?? '';
        return [
            'room_booking_id' => $roomBooking->id,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'relation' => 'organization',
            'address' => '',
            'mobile_number' => $mobileNumber ?? trans('hm::booking-request.not_given'),
        ];
    }
}
