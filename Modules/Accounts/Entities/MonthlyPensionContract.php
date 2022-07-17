<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Modules\HRM\Entities\Employee;

class MonthlyPensionContract extends Model
{
    protected $fillable = [
        'ppo_number',
        'employee_id',
        'receiver',
        'nominee_id',
        'has_payroll_increment',
        'initial_basic',
        'current_basic',
        'increment',
        'increment_percentage',
        'total',
        'disbursement_type',
        'bank_account_information',
        'status'
    ];

    public static function getReceiver()
    {
        if (app()->isLocale('bn')) {
            return config('constants.pension.contract.receiver_type_bangla');
        } else {
            return config('constants.pension.contract.receiver_type');
        }
    }

    public static function getDisbursementTypes()
    {
        if (app()->isLocale('bn')) {
            return config('constants.pension.contract.disbursement_type_bn');
        } else {
            return config('constants.pension.contract.disbursement_type');
        }
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function monthlyPensions()
    {
        return $this->hasMany(EmployeeMonthlyPension::class, 'employee_id', 'employee_id');
    }

    public function nominee()
    {
        return $this->belongsTo(PensionNominee::class);
    }

    public function getReceiverInfo()
    {
        $nomineeTypes = array_keys(config('constants.pension.contract.receiver_type'));
        if ($this->receiver == $nomineeTypes[1]) {
            $info = $this->nominee ? ' (' . $this->nominee . ' )' : '';
        } else {
            $info = '';
        }
        return __('accounts::pension.nominee.' . $this->receiver) . $info;
    }
}
