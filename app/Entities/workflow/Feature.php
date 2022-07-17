<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/21/19
 * Time: 12:13 PM
 */

namespace App\Entities\workflow;


use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'features';

    protected $fillable = ['name'];

    public function workflowRuleMaster()
    {
        return $this->hasOne(WorkflowRuleMaster::class, 'feature_id', 'id');
    }
}
