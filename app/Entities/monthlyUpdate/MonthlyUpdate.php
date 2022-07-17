<?php

namespace App\Entities\monthlyUpdate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\PMS\Entities\Project;
use Modules\PMS\Entities\ProjectProposal;
use Modules\RMS\Entities\Research;
use Modules\RMS\Entities\ResearchProposalSubmission;
use App\Entities\monthlyUpdate\MonthlyUpdateAttachment;

Relation::morphMap([
    'research' => Research::class,
    'project' => Project::class,
]);
class MonthlyUpdate extends Model
{
    protected $fillable = [
        'monthly_updatable_id',
        'monthly_updatable_type',
        'date',
        'achievement',
        'planning',
        'tasks'
    ];

    public function attachments()
    {
        return $this->hasMany(MonthlyUpdateAttachment::class, 'monthly_updatable_id');
    }
}

