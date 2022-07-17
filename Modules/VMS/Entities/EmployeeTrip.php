<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeTrip extends Model
{
    protected $table = 'employee_trip';
    protected $fillable = ['employee_id', 'trip_id'];
}
