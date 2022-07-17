<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class PayslipDetail extends Model
{
    const COLUMN_PAYSLIP_ID = "payslip_id";
    const COLUMN_SALARY_RULE_ID = "salary_rule_id";
    const COLUMN_AMOUNT = "amount";
    protected $fillable = [self::COLUMN_PAYSLIP_ID, self::COLUMN_SALARY_RULE_ID, self::COLUMN_AMOUNT];


    public function payslip()
    {
        return $this->belongsTo(Payslip::class, 'payslip_id', 'id')->withDefault();
    }

    // todo:: change this to belongsToMany
    public function salaryRule()
    {
        return $this->belongsTo(SalaryRule::class, 'salary_rule_id', 'id');
    }

}
