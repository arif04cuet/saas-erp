<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;

class BookingGuestInfo extends Model
{
    protected $fillable = [
        'room_booking_id',
        'first_name',
        'middle_name',
        'last_name',
        'age',
        'gender',
        'address',
        'relation',
        'nid_no',
        'nid_doc',
        'status',
        'nationality',
        'mobile_number'
    ];

    public function getName()
    {
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name ?? trans('labels.not_found');
    }

    public function getNationality()
    {
        // workaround for showing nationality
        // table has a default 'bangali' value
        if ($this->nationality == config('hm.booking_guest_info.default_nationality')) {
            return "Bangladeshi";
        }
        return $this->nationality ?? 'Bangladeshi';
    }

    public function checkinDetail()
    {
        return $this->hasOne(CheckinDetail::class, 'booking_guest_info_id', 'id');
    }
}
