<?php

namespace Modules\RMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ResearchProposalSubmissionAttachment extends Model
{
    protected $table = "research_proposal_submission_attachments";
    protected $fillable = ['submissions_id', 'attachments', 'file_name'];
}
