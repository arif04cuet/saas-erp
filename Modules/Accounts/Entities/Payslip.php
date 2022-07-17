<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class Payslip extends Model
{
    const COLUMN_EMPLOYEE_ID = 'employee_id';
    const COLUMN_PAYSLIP_BATCH_ID = 'payslip_batch_id';
    const COLUMN_TOTAL_AMOUNT = 'total_amount';
    const COLUMN_PERIOD_FROM = 'period_from';
    const COLUMN_PERIOD_TO = 'period_to';
    const COLUMN_PAYSLIP_NAME = 'payslip_name';
    const COLUMN_REFERENCE = 'reference';
    const COLUMN_TYPE = 'type';
    const COLUMN_STATUS = 'status';
    // journal related constant
    const SALARY_JOURNAL_ID = null;
    const SALARY_JOURNAL_PAYABLE_CODE = '8172108';

    protected $fillable = [
        self::COLUMN_EMPLOYEE_ID,
        self::COLUMN_PAYSLIP_BATCH_ID,
        self::COLUMN_TOTAL_AMOUNT,
        self::COLUMN_PERIOD_TO,
        self::COLUMN_PERIOD_FROM,
        self::COLUMN_PAYSLIP_NAME,
        self::COLUMN_REFERENCE,
        self::COLUMN_TYPE,
        self::COLUMN_STATUS
    ];
    protected $dates = ['created_at', 'period_from', 'period_to'];


    public static function getTypes()
    {
        return config('constants.accounts.payslip.payslip_types');
    }

    public static function getTypesForDropdown()
    {
        if (app()->isLocale('bn')) {
            return config('constants.accounts.payslip.dropdown.payslip_types_bn');
        } else {
            return config('constants.accounts.payslip.dropdown.payslip_types');
        }
    }

    public function payslipDetails()
    {
        return $this->hasMany(PayslipDetail::class, 'payslip_id', 'id');
    }


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function payslipBatch()
    {
        return $this->belongsTo(PayslipBatch::class, 'payslip_batch_id', 'id')->withDefault();
    }

    public function gpfMonthlyRecord()
    {
        return $this->hasOne(GpfMonthlyRecord::class);
    }
}
