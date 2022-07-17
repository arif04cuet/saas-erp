<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/23/19
 * Time: 12:16 PM
 */

namespace App\Repositories\workflow;


use App\Entities\workflow\WorkflowConversation;
use App\Repositories\AbstractBaseRepository;

class WorkflowConversationRepository extends AbstractBaseRepository
{
    protected $modelName = WorkflowConversation::class;
}
