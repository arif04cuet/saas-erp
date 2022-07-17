<?php

namespace Modules\PMS\Entities;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;

class ProjectDetailProposal extends Model
{
    protected $table = 'project_detail_proposals';

    protected $fillable = ['project_request_id', 'auth_user_id', 'title', 'status', 'project_id'];

    public function projectDetailProposalFiles()
    {
        return $this->hasMany(ProjectDetailProposalAttachment::class, 'project_request_id', 'id');
    }

    public function distinctProjectDetailProposalFiles()
    {
        return $this->hasMany(ProjectDetailProposalAttachment::class, 'project_request_id', 'id')->orderBy('created_at', 'desc');
    }

    public function proposalSubmittedBy()
    {
        return $this->belongsTo(User::class, 'auth_user_id', 'id');
    }

    public function request()
    {
        return $this->belongsTo(ProjectRequestDetail::class, 'project_request_id', 'id');
    }

    public function budgets()
    {
        return $this->morphMany(DraftProposalBudget::class, 'budgetable', 'budgetable_type', 'budgetable_id', 'id');
    }
}
