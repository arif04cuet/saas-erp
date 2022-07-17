<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeInterest extends Model
{
    protected $fillable = ['area_of_interest_id', 'employee_id'];

    public function employeeInterest()
    {
        return $this->belongsTo(AreaOfInterest::class, 'area_of_interest_id', 'id');
    }
}
