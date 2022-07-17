<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'vehicle_type_id',
        'unique_id',
        'name',
        'model',
        'registration_number',
        'price',
        'seat',
        'cc',
        'chassis_number',
        'purchase_date',
        'insurance',
        'fitness',
        'fuel_type',
        'status',
    ];

    public static function getStatuses($keysOnly = false)
    {
        $statuses = config('vms.vehicle.status');
        if ($keysOnly) {
            return array_keys($statuses);
        }
        return $statuses;
    }

    public static function getFuelTypes($keysOnly = false)
    {
        $statuses = config('vms.vehicle.fuel_types');
        if ($keysOnly) {
            return array_keys($statuses);
        }
        return $statuses;
    }

    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'trip_vehicle');
    }

//--------------------------------------------------------------------------------
//                              ORM relations
//---------------------------------------------------------------------------------

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'id')->withDefault();
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class);
    }
}
