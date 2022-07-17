<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;

class BookingRequestForward extends Model
{
    protected $fillable = ['room_booking_id', 'forwarded_to', 'forwarded_by', 'comment'];

    public function roomBooking()
    {
        return $this->hasOne(RoomBooking::class,'id', 'room_booking_id');
    }
}
