<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    protected $fillable = ['title','end_date','remarks'];
    protected $table = 'project_requests';

    /**
     * @var array
     */
    protected $dates = ['end_date'];

    public function projectRequestAttachments()
    {
        return $this->hasMany(ProjectRequestAttachment::class, 'project_request_id', 'id');
    }

    public function projectRequestReceivers()
    {
        return $this->hasMany(ProjectRequestReceiver::class, 'project_request_id', 'id');
    }

    public function proposals()
    {
        return $this->hasMany(ProjectProposal::class, 'project_request_id', 'id');
    }

    public function proposalsSubmittedByInvitedUserUnderReviewOrApproved()
    {
        return $this->hasMany(ProjectProposal::class, 'project_request_id', 'id')
            ->where('auth_user_id', auth()->user()->id)
            ->whereIn('status', ['APPROVED', 'PENDING']);
    }
}
