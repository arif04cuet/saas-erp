<?php

namespace Modules\RMS\Entities;

use App\Entities\Organization\Organization;
use App\Entities\User;
use App\Entities\workflow\WorkflowMaster;
use Illuminate\Database\Eloquent\Model;
use Modules\PMS\Entities\ProjectResearchTask;

class ResearchProposalSubmission extends Model
{
    protected $table = "research_proposal_submissions";
    protected $fillable = ['research_request_id', 'auth_user_id', 'title', 'status'];

    public function researchProposalSubmissionAttachments()
    {
        return $this->hasMany(ResearchProposalSubmissionAttachment::class, 'submissions_id', 'id');
    }

    public function distinctResearchProposalSubmissionAttachments()
    {
        return $this->hasMany(ResearchProposalSubmissionAttachment::class, 'submissions_id', 'id')->orderBy('created_at', 'desc');
    }

    public function tasks()
    {
        return $this->hasMany(ProjectResearchTask::class, 'task_for_id')->where('type', 'research');
    }

    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'auth_user_id', 'id');
    }

    public function organizations()
    {
        return $this->morphToMany(Organization::class, 'organizable');
    }

    public function requester()
    {
        return $this->belongsTo(ResearchRequest::class, 'research_request_id', 'id');
    }

    public function workFlowMasters()
    {
        return $this->hasMany(WorkflowMaster::class, 'ref_table_id', 'id');
    }

    public function researchRequests()
    {
        return $this->hasMany(ResearchRequest::class, 'research_request_id', 'id');
    }
}
