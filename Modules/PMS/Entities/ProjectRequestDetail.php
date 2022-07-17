<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectRequestDetail extends Model
{
    protected $table = 'project_request_details';
    protected $fillable = ['project_proposal_id', 'title','end_date','remarks'];

    /**
     * @var array
     */
    protected $dates = ['end_date'];

    public function projectRequestDetailAttachments()
    {
        return $this->hasMany(ProjectRequestDetailAttachment::class, 'project_request_detail_id', 'id');
    }

    public function projectApprovedProposal()
    {
        return $this->hasOne(ProjectProposal::class, 'id', 'project_proposal_id');
    }

    public function proposals()
    {
        return $this->hasMany(ProjectDetailProposal::class, 'project_request_id', 'id');
    }

    public function proposalsUnderReviewOrApproved()
    {
        return $this->hasMany(ProjectDetailProposal::class, 'project_request_id', 'id')
            ->whereIn('status', ['APPROVED', 'PENDING']);
    }
}
