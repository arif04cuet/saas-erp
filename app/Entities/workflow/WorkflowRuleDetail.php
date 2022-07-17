<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/21/19
 * Time: 12:28 PM
 */

namespace App\Entities\workflow;


use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Designation;

class WorkflowRuleDetail extends Model
{
    protected $table = 'workflow_rule_details';

    protected $fillable = ['rule_master_id', 'designation_id', 'notification_order', 'number_of_responder',
        'is_group_notification', 'get_back_status', 'back_to_rule', 'proceed_to_status', 'proceed_to_rule', 'flow_type',
    'is_optional'];

    public function ruleMaster()
    {
        return $this->belongsTo(WorkflowRuleMaster::class);
    }

    public function designationId()
    {
        return $this->belongsTo(Designation::class);
    }
}
