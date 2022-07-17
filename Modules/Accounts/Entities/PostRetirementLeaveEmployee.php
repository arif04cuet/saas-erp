<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class PostRetirementLeaveEmployee extends Model
{
    protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'eligible_month',
        'total_amount',
        'basic_salary',
        'status'
    ];

    protected $dates = ['start_date', 'end_date'];

    const status = ['draft', 'disbursed'];

    public function employee()
    {
        return $this
            ->belongsTo(Employee::class, 'employee_id', 'id')
            ->withDefault();
    }
}
