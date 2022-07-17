<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class MasterRollSalary extends Model
{
    protected $fillable = [
        'employee_id',
        'number_of_days',
        'payment_per_day',
        'total_amount',
        'period_from',
        'period_to'
    ];

    protected $dates = ['period_from', 'period_to'];


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id')->withDefault();
    }
}
