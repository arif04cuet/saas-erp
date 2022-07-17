<?php

namespace App\Entities\Sharing;

use App\Entities\workflow\Feature;
use App\Entities\workflow\WorkflowDetail;
use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Designation;
use Modules\PMS\Entities\ProjectDetailProposal;
use Modules\PMS\Entities\ProjectProposal;
use Modules\RMS\Entities\Research;
use Modules\RMS\Entities\ResearchDetailSubmission;
use Modules\RMS\Entities\ResearchProposalSubmission;

class ShareConversation extends Model
{
    protected $table = 'share_conversations';

    protected $fillable = ['feature_id', 'ref_table_id', 'is_group_notification', 'request_ref_id', 'department_id', 'designation_id',
        'to_user_id', 'from_user_id', 'message', 'status', 'share_rule_designation_id'];

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function researchProposal()
    {
        return $this->belongsTo(ResearchProposalSubmission::class, 'ref_table_id', 'id');
    }

    public function projectProposal()
    {
        return $this->belongsTo(ProjectProposal::class, 'ref_table_id', 'id');
    }

    public function projectDetailProposal()
    {
        return $this->belongsTo(ProjectDetailProposal::class, 'ref_table_id', 'id');
    }

    public function workflowDetails()
    {
        return $this->belongsTo(WorkflowDetail::class, 'request_ref_id', 'id');
    }

    public function shareRuleDesignation()
    {
        return $this->belongsTo(ShareRuleDesignation::class, 'share_rule_designation_id', 'id');
    }

    public function researchDetail()
    {
        return $this->belongsTo(ResearchDetailSubmission::class, 'ref_table_id', 'id');
    }

    public function research()
    {
        return $this->belongsTo(Research::class, 'ref_table_id', 'id');
    }
}
