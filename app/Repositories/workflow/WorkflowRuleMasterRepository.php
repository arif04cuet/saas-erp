<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/21/19
 * Time: 5:25 PM
 */

namespace App\Repositories\workflow;


use App\Entities\workflow\WorkflowRuleMaster;
use App\Repositories\AbstractBaseRepository;

class WorkflowRuleMasterRepository extends AbstractBaseRepository
{
    protected $modelName = WorkflowRuleMaster::class;
}
