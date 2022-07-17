<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;

class BookingVendorConfirmation extends Model
{
    protected $fillable = [
        'status',
        'unique_key',
        'last_validity',
        'physical_facility_request_id',
    ];

}
