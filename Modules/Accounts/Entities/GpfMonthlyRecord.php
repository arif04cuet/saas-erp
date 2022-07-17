<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class GpfMonthlyRecord extends Model
{
    protected $fillable = [
        'employee_id',
        'payslip_id',
        'gpf_stock_amount',
        'gpf_amount',
        'gpf_advanced_amount',
        'gpf_balance',
        'loan_balance',
        'interest',
        'month',
    ];
}
