<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\TMS\Entities\Trainee;
use Modules\TMS\Entities\Training;

class CheckinTrainee extends Model
{
    protected $fillable = ["training_id", "trainee_id", "checkin_id", "booking_guest_info_id"];

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id', 'id')->withDefault();
    }

    public function trainee()
    {
        return $this->belongsTo(Trainee::class, 'trainee_id', 'id')
            ->withDefault();
    }

    public function bookingGuestInfo()
    {
        return $this->belongsTo(BookingGuestInfo::class, 'booking_guest_inf0', 'id')
            ->withDefault();
    }

    public function checkin()
    {
        return $this->belongsTo(RoomBooking::class, 'checkin_id', 'id')
            ->withDefault();
    }
}
