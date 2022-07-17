<?php

namespace Modules\RMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ResearchBudget extends Model
{
    protected $fillable = ['research_id', 'activity', 'estimated_cost'];

    public function research()
    {
        return $this->belongsTo(Research::class, 'research_id');
    }
}
