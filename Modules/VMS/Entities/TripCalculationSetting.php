<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TripCalculationSetting extends Model
{
    protected $fillable = [
        'title',
        'per_km_taka',
        'per_hour_taka',
        'oil_price',
        'gas_price',
        'is_exceed_setting',
        'status'
    ];

    public static function getStatus()
    {
        return config('vms.trip.setting.status');
    }
}
