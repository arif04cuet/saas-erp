<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/22/19
 * Time: 12:46 PM
 */

namespace App\Repositories\workflow;


use App\Entities\workflow\WorkflowMaster;
use App\Repositories\AbstractBaseRepository;

class WorkflowMasterRepository extends AbstractBaseRepository
{
    protected $modelName = WorkflowMaster::class;
}
