<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class EmployeeLumpSum extends Model
{
    protected $fillable = [
        'employee_id',
        'basic_salary',
        'eligible_pension',
        'monthly_pension',
        'lump_sum_amount',
        'status',
        'receiver',
        'nominee_id',
    ];
    const status = ['draft', 'disbursed'];
    const receiver = ['self' => 'Self', 'nominee' => 'Nominee'];

    public static function getReceiver()
    {
        if (app()->isLocale('bn')) {
            return config('constants.pension.contract.receiver_type_bangla');
        } else {
            return config('constants.pension.contract.receiver_type');
        }
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id')->withDefault();
    }

    public function deductions()
    {
        return $this->hasMany(LumpSumDeduction::class, 'employee_id', 'employee_id');
    }

    public function nominee()
    {
        return $this->belongsTo(PensionNominee::class);
    }

    public function pensionContracts()
    {
        return $this->hasMany(MonthlyPensionContract::class, 'employee_id', 'employee_id');
    }
}
