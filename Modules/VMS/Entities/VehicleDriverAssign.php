<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;

class VehicleDriverAssign extends Model
{
    protected $fillable = ['driver_id', 'vehicle_id',];
    protected $table = 'driver_vehicle';

    public function vehicle()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id')->withDefault();
    }

    public function driver()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
}
