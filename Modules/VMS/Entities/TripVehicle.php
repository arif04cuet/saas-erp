<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TripVehicle extends Model
{
    protected $table = 'trip_vehicle';
    protected $fillable = ['trip_id', 'vehicle_id'];
}
