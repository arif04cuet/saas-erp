<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\EconomyCode;
use Modules\Accounts\Entities\FiscalYear;

class ProjectBudgets extends Model
{
    protected $fillable = ['project_id', 'fiscal_year_id', 'economy_code_id', 'activity_id', 'budget','revised_budget','expense'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class, 'fiscal_year_id');
    }
    public function EconomyCode()
    {
        return $this->belongsTo(EconomyCode::class, 'economy_code_id');
    }
    public function Activity()
    {
        return $this->belongsTo(ProjectActivity::class, 'activity_id');
    }
}
