<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryRule extends Model
{

    const BASIC_SALARY_CODE = 'Basic';
    const EDUCATION_ALLOWANCE_CODE = 'EA';
    const HRA_ALLOWANCE_CODE = 'HRA';
    const GPF_CODE = 'GPFC';
    const GPF_ALLOWANCE = 'GPFA';
    const GPFC_CUSTOM_CALCULATION_MONTH = 6;
    const rebelRules = [
        self::BASIC_SALARY_CODE,
        self::EDUCATION_ALLOWANCE_CODE,
        self::HRA_ALLOWANCE_CODE,
        self::GPF_CODE
    ];
    const MAX_AMOUNT_FOR_EA = 1000;
    const MAX_AGE_LIMIT_OF_CHILDREN = 23;
    protected $fillable = [
        "name",
        "bangla_name",
        "salary_category_id",
        "code",
        "sequence",
        "debit_account",
        "credit_account",
        "show_on_payslip",
        "condition_type",
        "range_based_on",
        "max_range",
        "min_range",
        "condition_expression",
        "amount_type",
        "min_amount",
        "max_amount",
        "percentage_based_on",
        "quantity",
        "percentage",
        "fixed_amount",
        "contribution_register"
    ];

    public static function getBonusCodes()
    {
        return config('constants.accounts.payslip.bonus_codes.all_bonus_codes');
    }

    public static function getOnlyFestivalBonusCodes()
    {
        return config('constants.accounts.payslip.bonus_codes.festival_bonus_codes');
    }

    public static function getOnlyBoishakhiBonusCodes()
    {
        return config('constants.accounts.payslip.bonus_codes.boishakhi_bonus_codes');
    }


    public function salaryCategory()
    {
        return $this->belongsTo(SalaryCategory::class, 'salary_category_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(SalaryRuleChild::class);
    }

    /**
     *  call - this->debit_economy_code
     */
    public function getDebitEconomyCodeAttribute()
    {
        return $this->belongsTo(EconomyCode::class, 'debit_account', 'code')->first();
    }

    /**
     * call - this->credit_economy_code
     */
    public function getCreditEconomyCodeAttribute()
    {
        return $this->belongsTo(EconomyCode::class, 'credit_account', 'code')->first();
    }

    /**
     *  Many to Many -  Salary Structure and Salary Rule
     */
    public function salaryStructures()
    {
        return $this->belongsToMany(SalaryStructure::class, 'salary_structure_rules');
    }

    public function percentageBasedRule()
    {
        return $this->belongsTo(SalaryRule::class, 'percentage_based_on', 'id')->withDefault();
    }

    public function conditionBasedRule()
    {
        return $this->belongsTo(SalaryRule::class, 'range_based_on', 'id')->withDefault();
    }

    public function getName()
    {
        if (app()->isLocale('en')) {
            return $this->name ?? trans('labels.not_found');
        } else {
            return $this->bangla_name ?? trans('labels.not_found');
        }
    }

}
