<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;

class VehicleFuelLog extends Model
{
    protected $fillable = ['vehicle_id', 'vehicle_type_id', 'filling_station_id', 'date', 'fuel_quantity', 'fuel_type', 'amount', 'voucher_number', 'acknowledgement_slip', 'status'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id')->withDefault();
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'id')->withDefault();
    }

    public function fillingStation()
    {
        return $this->belongsTo(VehicleFillingStation::class, 'filling_station_id', 'id')->withDefault();
    }


}
