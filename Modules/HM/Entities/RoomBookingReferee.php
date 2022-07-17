<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Department;

class RoomBookingReferee extends Model
{
    protected $fillable = ['room_booking_id', 'name', 'department_id', 'contact'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
