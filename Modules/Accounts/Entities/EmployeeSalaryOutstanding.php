<?php

namespace Modules\Accounts\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class EmployeeSalaryOutstanding extends Model
{
    protected $fillable = ["employee_id", "salary_rule_id", "month", "amount", "remark", "status"];

    const STATUS = ['inactive', 'active'];


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id')->withDefault();
    }

    public function salaryRule()
    {
        return $this->belongsTo(SalaryRule::class, 'salary_rule_id', 'id')->withDefault();
    }

    // setting mutator for month field
    public function setMonthAttribute($value)
    {
        $this->attributes['month'] = Carbon::createFromFormat('F,Y', $value)->format('Y-m-d H:i:s');
    }

    // setting accessor for month field
    public function getMonthAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['month'])->format('F,Y');
    }
}
