<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class GpfConfiguration extends Model
{
    protected $fillable = [
        'gpf_interest_percentage',
        'gpf_loan_interest_percentage',
        'min_gpf_percentage',
        'max_gpf_percentage',
        'max_loan_installment',
        'status',
        'remark'
    ];
}
