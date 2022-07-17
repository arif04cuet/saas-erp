<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 4/1/19
 * Time: 5:41 PM
 */

namespace App\Services\workflow;


use App\Repositories\AbstractBaseRepository;
use App\Repositories\workflow\WorkflowMasterRepository;
use App\Traits\CrudTrait;

class WorkflowMasterService extends AbstractBaseRepository
{
    use CrudTrait;
    /**
     * @var WorkflowMasterRepository
     */
    private $workflowMasterRepository;

    /**
     * WorkflowMasterService constructor.
     * @param WorkflowMasterRepository $workflowMasterRepository
     */
    public function __construct(WorkflowMasterRepository $workflowMasterRepository)
    {
        $this->workflowMasterRepository = $workflowMasterRepository;
        $this->setActionRepository($workflowMasterRepository);
    }
}