<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class VehicleMaintenanceRequisition extends Model
{
    protected $fillable = ['requester_id','requisition','vehicle_id','date','driver_id','status','update_by','approve_by','approve_date','total_amount'];


    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id')->withDefault();
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }


    public function requester()
    {
        return $this->belongsTo(Employee::class, 'requester_id', 'id')->withDefault();
    }

    public static function getStatuses()
    {
        return config('vms.requisition.status');

    }
}
