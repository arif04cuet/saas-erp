<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/23/19
 * Time: 12:17 PM
 */

namespace App\Entities\workflow;


use Illuminate\Database\Eloquent\Model;

class WorkflowConversation extends Model
{
    protected $table = 'workflow_conversations';

    protected $fillable = ['workflow_master_id', 'workflow_details_id', 'feature_id', 'message', 'status'];

    public function workFlowMaster()
    {
        return $this->belongsTo(WorkflowMaster::class, 'workflow_master_id', 'id');
    }

    public function workFlowDetail()
    {
        return $this->belongsTo(WorkflowDetail::class, 'workflow_details_id', 'id');
    }
}
