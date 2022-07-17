<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class EmployeeMonthlyPension extends Model
{
    protected $fillable = [
        'employee_id',
        'receiver',
        'month',
        'disburse_date',
        'basic_pay',
        'medical_allowance',
        'bonus',
        'deduction',
        'bonus_name',
        'total',
        'remarks',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function contract()
    {
        return $this->hasOne(MonthlyPensionContract::class, 'employee_id', 'employee_id');
    }

    public function employeeAllPensions()
    {
        return $this->hasMany(EmployeeMonthlyPension::class, 'employee_id', 'employee_id');
    }
}
