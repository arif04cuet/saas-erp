<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/21/19
 * Time: 1:18 PM
 */

namespace App\Entities\workflow;


use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\PMS\Entities\ProjectProposal;
use Modules\RMS\Entities\Research;
use Modules\RMS\Entities\ResearchDetailSubmission;
use Modules\RMS\Entities\ResearchProposalSubmission;

class WorkflowMaster extends Model
{
    protected $table = 'workflow_masters';

    protected $fillable = ['feature_id', 'rule_master_id', 'ref_table_id', 'status', 'initiator_id', 'reinitiate_ref_id'];

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function ruleMaster()
    {
        return $this->belongsTo(WorkflowRuleMaster::class, 'rule_master_id');
    }

    public function initiator()
    {
        $this->belongsTo(User::class, 'initiator_id');
    }

    public function workFlowConversations()
    {
        return $this->hasMany(WorkflowConversation::class, 'workflow_master_id', 'id');
    }
    
    public function workflowDetails()
    {
        return $this->hasMany(WorkflowDetail::class, 'workflow_master_id')->orderBy('notification_order');
    }

    public function researchProposalSubmission()
    {
        return $this->belongsTo(ResearchProposalSubmission::class, 'ref_table_id', 'id');
    }
    public function research()
    {
        return $this->belongsTo(Research::class, 'ref_table_id', 'id');
    }
    public function researchDetail()
    {
        return $this->belongsTo(ResearchDetailSubmission::class, 'ref_table_id', 'id');
    }

    public function projectProposalSubmission()
    {
        return $this->belongsTo(ProjectProposal::class, 'ref_table_id', 'id');
    }

}
