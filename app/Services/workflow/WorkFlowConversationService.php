<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/22/19
 * Time: 1:13 PM
 */

namespace App\Services\workflow;


use App\Constants\WorkflowConversationStatus;
use App\Repositories\workflow\WorkflowConversationRepository;
use App\Traits\CrudTrait;

class WorkFlowConversationService
{
    use CrudTrait;

    private $flowConversationRepository;

    /**
     * WorkFlowConversationService constructor.
     * @param WorkflowConversationRepository $flowConversationRepository
     */
    public function __construct(WorkflowConversationRepository $flowConversationRepository)
    {
        $this->flowConversationRepository = $flowConversationRepository;
        $this->setActionRepository($this->flowConversationRepository);
    }

    public function closeConversation($flowMasterId, $flowDetailsId)
    {
        $flowConversations = $this->getActiveConversationByWorkFlowAndDetails($flowMasterId, $flowDetailsId);
        foreach ($flowConversations as $flowConversation) {
            $flowConversation->status = 'CLOSED';
            $flowConversation->update();
        }
    }

    public function closeByFlowMaster($flowMasterId)
    {
        $flowConversation = $this->getActiveConversationByWorkFlow($flowMasterId);
        if ($flowConversation) {
            $flowConversation->status = 'CLOSED';
            $flowConversation->update();
        }
    }

    public function getActiveConversationByWorkFlowAndDetails($flowMasterId, $flowDetailsId)
    {
        return $this->flowConversationRepository->findBy(['workflow_master_id' => $flowMasterId, 'workflow_details_id' => $flowDetailsId, 'status' => WorkflowConversationStatus::ACTIVE]);
    }

    public function getActiveConversationByWorkFlow($flowMasterId)
    {
        return $this->flowConversationRepository->findOneBy(['workflow_master_id' => $flowMasterId, 'status' => WorkflowConversationStatus::ACTIVE]);
    }

    public function getActiveConversation($workFlowConversationId)
    {
        return $this->flowConversationRepository->findBy(['id' => $workFlowConversationId, 'status' => 'ACTIVE']);
    }
}
