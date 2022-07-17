<?php

/**
 * Created by vs code.
 * User: araf
 * Date: 12/05/2022
 * Time: 3:57 PM
 */

namespace Modules\HM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Modules\HM\Entities\RoomBooking;

class RoomBookingRepository extends AbstractBaseRepository
{
    protected $modelName = RoomBooking::class;

    public function pluckTrainingTitleBookingId()
    {
        $doptorId = doptor();
        return $this->model->withoutGlobalScopes()
            ->leftjoin('trainings', 'room_bookings.training_id', '=', 'trainings.id')
            ->where('room_bookings.booking_type', 'training')
            ->where('room_bookings.type', 'booking')
            ->where('room_bookings.status', 'approved')
            ->where('room_bookings.doptor_id', $doptorId['id'])
            ->whereNotNull('room_bookings.training_id')
            ->pluck('trainings.title', 'room_bookings.id');
    }

    public function getApprovedBookingCheckinRecords($roomBooking)
    {
        $approvedBookingCheckinRecords = $this->model
            ->whereDate('end_date', '>=', $roomBooking->start_date)
            ->whereDate('room_bookings.start_date', '<=', $roomBooking->end_date)
            ->where('room_bookings.id', '!=', $roomBooking->id)
            ->where('room_bookings.status', 'approved')
            ->whereNull('room_bookings.actual_end_date')
            ->get();

        $bookingToCheckinRecords = DB::table('booking_checkin')
            ->pluck('booking_id')
            ->toArray();

        return $approvedBookingCheckinRecords->filter(function ($bookingCheckin) use ($bookingToCheckinRecords) {
            return !in_array($bookingCheckin->id, $bookingToCheckinRecords);
        });
    }

    /**
     * @param array $ids - Array of Physical Facility Request Id
     * @return Builder
     */
    public function getExpiredRoomBookingsByPhysicalFacilityRequest(array $ids)
    {
        $bookingTypes = RoomBooking::getBookingTypes();
        $statues = RoomBooking::getStatuses();
        return $this->model->newQuery()
            ->whereIn('physical_facility_request_id', $ids)
            ->whereStatus($statues['approved'])
            ->whereBookingType($bookingTypes['physical_facility'])
            ->get();
    }

    public function getBookingRequestOfDateRange(Carbon $startDate, Carbon $endDate)
    {
        $startDate = $startDate->format('Y-m-d');
        $endDate = $endDate->format('Y-m-d');
        return $this->model->newQuery()
            ->where('start_date', '>=', $startDate)
            ->where('end_date', '<=', $endDate)
            ->get();
    }
}
