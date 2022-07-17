<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TmsBudgetSector extends Model
{
    protected $fillable = [
        'tms_budget_id',
        'tms_sub_sector_id',
        'no_of_days',
        'no_of_person',
        'rate',
        'total',
        'revised_no_of_person',
        'revised_rate',
        'revised_total',
        'remarks'
    ];

    public function budget()
    {
        return $this->belongsTo(TmsBudget::class, 'tms_budget_id', 'id');
    }

    public function subSector()
    {
        return $this->belongsTo(TmsSubSector::class, 'tms_sub_sector_id', 'id');
    }
}
