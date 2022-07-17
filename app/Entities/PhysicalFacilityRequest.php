<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class PhysicalFacilityRequest extends Model
{
    protected $fillable = ['requester_name', 'email', 'mobile_no', 'organization', 'training'];
}
