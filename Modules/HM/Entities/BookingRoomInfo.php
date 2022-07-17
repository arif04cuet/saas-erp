<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;

class BookingRoomInfo extends Model
{
    protected $fillable = ['room_booking_id', 'room_type_id', 'quantity', 'rate_type', 'rate'];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id', 'id');
    }
}
