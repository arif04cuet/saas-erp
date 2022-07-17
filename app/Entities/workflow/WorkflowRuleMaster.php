<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/21/19
 * Time: 12:15 PM
 */

namespace App\Entities\workflow;


use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Department;

class WorkflowRuleMaster extends Model
{
    protected $table = 'workflow_rule_masters';

    protected $fillable = ['feature_id', 'department_id', 'name', 'rule', 'get_back_status'];

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function ruleDetails()
    {
        return $this->hasMany(WorkflowRuleDetail::class, 'rule_master_id');
    }
}
