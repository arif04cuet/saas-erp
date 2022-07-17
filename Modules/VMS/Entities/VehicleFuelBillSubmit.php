<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class VehicleFuelBillSubmit extends Model
{
    protected $fillable = [
        'requester_id',
        'filling_station_id',
        'date',
        'amount',
        'voucher_number',
        'acknowledgement_one',
        'acknowledgement_two',
        'status'
    ];

    public function fillingStation()
    {
        return $this->belongsTo(VehicleFillingStation::class, 'filling_station_id', 'id')->withDefault();
    }

    public function requester()
    {
        return $this->belongsTo(Employee::class, 'requester_id', 'id')->withDefault();
    }

    public static function getStatuses()
    {
        return config('vms.fuelBill.status');

    }

}
