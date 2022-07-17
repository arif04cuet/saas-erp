<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class BudgetCostCenterSector extends Model
{
    protected $fillable = ['title', 'budget_cost_center_id', 'economy_sector_code', 'sequence', 'budget_amount'];

    public function economySector()
    {
        return $this->belongsTo(EconomySector::class, 'economy_sector_code', 'code');
    }
}
