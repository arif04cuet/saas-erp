<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\EconomyCode;

class DraftProposalBudget extends Model
{
    protected $fillable = ['budgetable_id', 'budgetable_type', 'economy_code_id', 'section_type', 'unit', 'unit_rate', 'quantity', 'total_expense', 'total_expense_percentage', 'gov_source', 'own_financing_source', 'other_source'];

    public function budgetable(){
        return $this->morphTo();
    }

    public function economyCode(){
        return $this->belongsTo(EconomyCode::class, 'economy_code_id');
    }

    public function budgetFiscalValue(){
        return $this->hasMany(DraftProposalBudgetFiscalValue::class, 'budget_id');
    }
}
