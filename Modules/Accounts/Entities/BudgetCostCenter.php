<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class BudgetCostCenter extends Model
{
    protected $fillable = ['economy_code', 'accounts_budget_id', 'budget_amount', 'status'];

    public function budget()
    {
        return $this->belongsTo(AccountsBudget::class, 'accounts_budget_id', 'id');
    }

    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class);
    }

    public function sectors()
    {
        return $this->hasMany(BudgetCostCenterSector::class)->orderBy('sequence');
    }

    public function economyCode()
    {
        return $this->belongsTo(EconomyCode::class, 'economy_code', 'code');
    }
}
