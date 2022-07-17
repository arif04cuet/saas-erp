<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class GpfLoanDeposit extends Model
{
    protected $fillable = ['gpf_loan_id', 'amount', 'loan_balance', 'deposit_date', 'remarks', 'check_or_trx_no'];

    public function gpfLoan()
    {
        return $this->belongsTo(GpfLoan::class);
    }
}
