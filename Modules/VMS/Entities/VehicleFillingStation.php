<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;

class VehicleFillingStation extends Model
{
    protected $fillable = ['name', 'address','contact_person_name', 'contact_person_mobile'];
}
