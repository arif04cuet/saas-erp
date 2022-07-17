<?php

namespace Modules\RMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ResearchProposalDateExtendRequest extends Model
{
    protected $table = 'research_proposal_date_extend_requests';
    protected $fillable = ['research_request_id', 'send_to', 'remarks'];
}
