<?php

namespace Modules\RMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ResearchRequest extends Model
{
    protected $fillable = ['title','end_date','remarks', 'status'];
    protected $table = 'research_requests';

    /**
     * @var array
     */
    protected $dates = ['end_date'];

    public function researchRequestAttachments()
    {
        return $this->hasMany(ResearchRequestAttachment::class, 'research_request_id', 'id');
    }

    public function researchRequestReceivers()
    {
        return $this->hasMany(ResearchRequestReceiver::class, 'research_request_id', 'id');
    }

    public function researchProposals()
    {
        return $this->hasMany(ResearchProposalSubmission::class, 'research_request_id', 'id');
    }

    public function proposalsSubmittedByInvitedUserUnderReviewOrApproved()
    {
        return $this->hasMany(ResearchProposalSubmission::class, 'research_request_id', 'id')
            ->where('auth_user_id', auth()->user()->id)
            ->whereIn('status', ['APPROVED', 'PENDING']);
    }
}
