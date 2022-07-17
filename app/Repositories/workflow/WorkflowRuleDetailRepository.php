<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/21/19
 * Time: 5:46 PM
 */

namespace App\Repositories\workflow;


use App\Entities\workflow\WorkflowRuleDetail;
use App\Repositories\AbstractBaseRepository;

class WorkflowRuleDetailRepository extends AbstractBaseRepository
{
    protected $modelName = WorkflowRuleDetail::class;


}
