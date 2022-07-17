<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class MasterRollEmployee extends Model
{
    protected $fillable = [
        'employee_id',
        'payment_per_day'
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id')->withDefault();
    }
}
