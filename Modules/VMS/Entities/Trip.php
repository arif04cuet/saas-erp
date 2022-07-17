<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;
use Modules\PMS\Entities\Project;
use Modules\TMS\Entities\Training;

class Trip extends Model
{
    protected $fillable = [
        'title',
        'requester_id',
        'vehicle_type_id',
        'trip_calculation_setting_id',
        'billed_to',
        'training_id',
        'project_id',
        'no_of_passenger',
        'destination',
        'type',
        'distance',
        'completed_distance',
        'start_date_time',
        'actual_start_date_time',
        'end_date_time',
        'actual_end_date_time',
        'reason',
        'status'
    ];

    protected $dates = ['start_date_time', 'actual_start_date_time', 'end_date_time', 'actual_end_date_time'];

    public static function getStatuses()
    {
        return config('vms.trip.status');
    }

    public static function getTypes()
    {
        return config('vms.trip.type');
    }

    public static function getPaymentOptions()
    {
        return config('vms.trip.payment_options');
    }

    public static function getPaymentStatus()
    {
        return config('vms.trip.payment_status');
    }

    public static function getDistanceOptions()
    {
        return config('vms.trip.distance');
    }

    public function requester()
    {
        return $this->belongsTo(Employee::class, 'requester_id', 'id')->withDefault();
    }

    public function billedTo()
    {
        return $this->belongsTo(Employee::class, 'billed_to', 'id')->withDefault();
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'trip_vehicle');
    }

    public function tripCalculationSetting()
    {
        return $this->belongsTo(TripCalculationSetting::class, 'trip_calculation_setting_id', 'id')
            ->withDefault();
    }

    public function tripBillPayment()
    {
        return $this->hasOne(TripBillPayment::class, 'trip_id', 'id');
    }

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id', 'id')->withDefault();
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id')->withDefault();
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'id')
            ->withDefault();
    }

}
