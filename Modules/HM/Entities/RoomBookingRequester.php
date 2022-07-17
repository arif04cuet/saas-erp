<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;

class RoomBookingRequester extends Model
{
    protected $fillable = [
        'room_booking_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'contact',
        'address',
        'email',
        'nid',
        'passport_no',
        'organization',
        'designation',
        'organization_type',
        'org_address',
        'photo',
        'nid_doc',
        'passport_doc'
    ];

    public function getName()
    {
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }

    public function roomBooking()
    {
        return $this->hasOne(RoomBooking::class,'id', 'room_booking_id');
    }
}
