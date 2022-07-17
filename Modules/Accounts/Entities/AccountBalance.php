<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class AccountBalance extends Model
{
    protected $fillable = [
        "fiscal_year_id",
        "economy_code",
        "current_local_balance",
        "initial_local_balance",
        "current_revenue_balance",
        "initial_revenue_balance",
        //later added
        'total_local_payment',
        'total_local_receipt',
        'total_revenue_payment',
        'total_revenue_receipt',
        "status"
    ];

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class, 'fiscal_year_id', 'id')
            ->withDefault();
    }

    public function economyCode()
    {
        return $this->belongsTo(EconomyCode::class, 'economy_code', 'code')
            ->withDefault();
    }
}
