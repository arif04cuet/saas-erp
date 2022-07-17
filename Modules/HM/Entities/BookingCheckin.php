<?php

/**
 * Created by VS code.
 * User: Araf
 * Date: 19/06/2022
 * Time: 11:54 AM
 */

namespace Modules\HM\Entities;


use Illuminate\Database\Eloquent\Model;

class BookingCheckin extends Model
{
    protected $table = 'booking_checkin';

    protected $fillable = ['booking_id', 'checkin_id'];

    public function roomBooking()
    {
        return $this->belongsTo(RoomBooking::class, 'booking_id', 'id');
    }
}
