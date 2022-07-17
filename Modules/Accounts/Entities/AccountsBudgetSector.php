<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class AccountsBudgetSector extends Model
{
    protected $fillable = [
        'accounts_budget_id',
        'code',
        'local_amount',
        'revenue_amount',
        'revised_local_amount',
        'revised_revenue_amount',
    ];

    public function economyCode()
    {
        return $this->hasOne(EconomyCode::class, 'code', 'code');
    }
}
