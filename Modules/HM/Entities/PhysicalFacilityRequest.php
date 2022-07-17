<?php

namespace Modules\HM\Entities;

use function foo\func;
use Illuminate\Database\Eloquent\Model;

class PhysicalFacilityRequest extends Model
{
    protected $fillable = [];

    public function vendorConfirmation()
    {
        return $this->belongsTo(BookingVendorConfirmation::class, 'physical_facility_request_id', 'id');
    }
}


