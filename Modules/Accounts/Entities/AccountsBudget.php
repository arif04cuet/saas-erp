<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class AccountsBudget extends Model
{
    protected $fillable = ['title', 'fiscal_year_id', 'total_local', 'total_revenue', 'status'];

    public function sectors()
    {
        return $this->hasMany(AccountsBudgetSector::class);
    }

    public function budgetCostCenters()
    {
        return $this->hasMany(BudgetCostCenter::class);
    }

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class);
    }
}
