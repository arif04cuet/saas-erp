<?php

namespace Modules\PMS\Entities;

use App\Entities\Organization\Organization;
use App\Entities\monthlyUpdate\MonthlyUpdate;
use App\Entities\User;
use App\Entities\workflow\WorkflowMaster;
use Illuminate\Database\Eloquent\Model;

class ProjectProposal extends Model
{
    protected $table = 'project_proposals';

    protected $fillable = ['project_request_id', 'auth_user_id', 'title', 'status'];

    public function projectProposalFiles()
    {
        return $this->hasMany(ProjectProposalFile::class, 'proposal_id', 'id');
    }

    public function distinctProjectProposalFiles()
    {
        return $this->hasMany(ProjectProposalFile::class, 'proposal_id', 'id')->orderBy('created_at', 'desc');
    }

    public function projectResearchOrg()
    {
        return $this->hasMany(ProjectResearchOrganization::class, 'organization_for_id', 'id');
    }

    public function task()
    {
        return $this->hasMany(ProjectResearchTask::class, 'task_for_id')->where('type', 'project');
    }

    public function organizations()
    {
        return $this->morphToMany(Organization::class, 'organizable');
    }

    public function monthlyUpdates()
    {
        return $this->hasMany(MonthlyUpdate::class, 'update_for_id')->where('type', 'project');
    }

    public function proposalSubmittedBy()
    {
        return $this->belongsTo(User::class, 'auth_user_id', 'id');
    }

    public function workFlowMasters()
    {
        return $this->hasMany(WorkflowMaster::class, 'ref_table_id', 'id');
    }

    public function request()
    {
        return $this->belongsTo(ProjectRequest::class, 'project_request_id', 'id');
    }
}
