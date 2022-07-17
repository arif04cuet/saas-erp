<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\Training;
use App\Traits\DoptorAbleTrait;

class RoomBooking extends Model
{
    use DoptorAbleTrait;
    // its services are bookingRequestService ;)
    protected $fillable = [
        'shortcode',
        'start_date',
        'end_date',
        'actual_end_date',
        'booking_type',
        'status',
        'note',
        'employee_id',
        'type',
        'training_id',
        'doptor_id',
        'comment',
        'is_own_request',
        'physical_facility_request_id'
    ];


    public static function getBookingTypes()
    {
        return config('constants.booking_types');
    }

    public static function getStatuses()
    {
        return config('constants.room_booking_status');
    }

    public function requester()
    {
        return $this->hasOne(RoomBookingRequester::class, 'room_booking_id', 'id');
    }

    public function referee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function roomInfos()
    {
        return $this->hasMany(BookingRoomInfo::class, 'room_booking_id', 'id');
    }

    public function rooms()
    {
        return $this->hasMany(CheckinRoom::class, 'checkin_id', 'id');
    }

    public function guestInfos()
    {
        return $this->hasMany(BookingGuestInfo::class, 'room_booking_id', 'id');
    }

    public function booking()
    {
        return $this->hasOne(BookingCheckin::class, 'checkin_id', 'id');
    }

    public function checkins()
    {
        return $this->hasMany(BookingCheckin::class, 'booking_id', 'id');
    }

    public function checkinDetails()
    {
        return $this->hasMany(CheckinDetail::class, 'checkin_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(CheckinPayment::class, 'checkin_id', 'id');
    }

    public function forward()
    {
        return $this->hasOne(BookingRequestForward::class, 'room_booking_id', 'id');
    }

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id', 'id')
            ->withDefault();
    }

    public function getPhysicalFacilityUID()
    {
        return BookingVendorConfirmation::where(
            'physical_facility_request_id',
            $this->physical_facility_request_id
        )->first()->unique_key;
    }
}
