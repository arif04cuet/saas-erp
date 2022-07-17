<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/28/19
 * Time: 11:16 AM
 */

namespace App\Services\workflow\Generators;


use App\Constants\WorkflowStatus;
use App\Models\DashboardItem;
use App\Models\DashboardItemSummary;
use App\Repositories\workflow\FeatureRepository;
use App\Services\Remark\RemarkService;
use App\Services\UserService;
use App\Services\workflow\WorkFlowConversationService;
use App\Services\workflow\WorkflowService;
use Modules\RMS\Services\ResearchProposalSubmissionService;

class ResearchProposalItemGenerator extends BaseDashboardItemGenerator
{
    private $workflowService;
    private $userService;
    private $proposalSubmissionService;
    private $featureRepository;
    private $flowConversationService;
    private $remarksService;

    /**
     * ResearchProposalItemGenerator constructor.
     * @param WorkflowService $workflowService
     * @param UserService $userService
     * @param ResearchProposalSubmissionService $proposalSubmissionService
     * @param FeatureRepository $featureRepository
     *
     */
    public function __construct(WorkflowService $workflowService, UserService $userService, ResearchProposalSubmissionService $proposalSubmissionService,
                                FeatureRepository $featureRepository, WorkFlowConversationService $flowConversationService, RemarkService $remarkService)
    {
        $this->workflowService = $workflowService;
        $this->userService = $userService;
        $this->proposalSubmissionService = $proposalSubmissionService;
        $this->featureRepository = $featureRepository;
        $this->flowConversationService = $flowConversationService;
        $this->remarksService = $remarkService;
    }


    public function generateItems(): DashboardItemSummary
    {

        $dashboardItemSummary = new DashboardItemSummary();
        $dashboardItems = array();
        $user = $this->userService->getLoggedInUser();

        $designationId = $this->userService->getDesignationId($user->username);
        $departmentId = $this->userService->getDepartmentId($user->username);
        $feature = $this->featureRepository->findOneBy(['name' => config('constants.research_proposal_feature_name')]);
        $workflows = $this->workflowService->getWorkflowDetailsByUserAndFeature($user->id, [$designationId], $feature->id, $departmentId);
        foreach ($workflows as $key => $workflow) {
            $dashboardItem = new DashboardItem();
            $workflowMaster = $workflow->workflowMaster;
            $proposal = $this->proposalSubmissionService->findOne($workflowMaster->ref_table_id);
            $workflowRuleDetails = $workflow->ruleDetails;
            $researchData = [
                'proposal_title' => $proposal->title,
                'research_title' => $proposal->requester->title,
                'remarks' => $proposal->remarks,
                'id' => $proposal->id,
                'workflow_rule_details_id' => $workflowRuleDetails->id,
                'initiator_name' => $proposal->submittedBy->name,
            ];

            $workflowConversation = $workflow->workflowConversations[0];
            $dashboardItem->setFeatureItemId($workflow->workflowMaster->feature->id);
            $dashboardItem->setFeatureName($workflowMaster->feature->name);
            $dashboardItem->setWorkFlowConversationId($workflowConversation->id);

            $dashboardItem->setCheckUrl(
                '/rms/research-proposal-submission/review/' . $workflowMaster->ref_table_id .
                '/' . $workflowMaster->feature->name . '/' . $workflowMaster->id . '/' . $workflowConversation->id . '/' . $workflowRuleDetails->id);
            $dashboardItem->setWorkFlowMasterId($workflowMaster->id);
            $dashboardItem->setWorkFlowMasterStatus($workflowMaster->status);
            $dashboardItem->setMessage($workflowConversation->message);
            $dashboardItem->setDynamicValues($researchData);
//            $dashboardItem->setRemarks($this->remarksService->findBy(['feature_id' => $feature->id,'ref_table_id' => $proposal->id]));
            array_push($dashboardItems, $dashboardItem);
        }

        $dashboardItemSummary->setDashboardItems($dashboardItems);
        return $dashboardItemSummary;
    }

    public function updateItem($itemId, $status)
    {
        $proposal = $this->proposalSubmissionService->findOne($itemId);
        if ($status == WorkflowStatus::APPROVED) {
            $this->proposalSubmissionService->update($proposal, ['status' => WorkflowStatus::APPROVED]);
        }
    }

    public function generateRejectedItems(): DashboardItemSummary
    {
        $dashboardItemSummary = new DashboardItemSummary();
        $dashboardItems = array();
        $user = $this->userService->getLoggedInUser();
        $feature = $this->featureRepository->findOneBy(['name' => config('constants.research_proposal_feature_name')]);
        $workflows = $this->workflowService->getRejectedItems($user->id, $feature->id);
        foreach ($workflows as $key => $workflowMaster) {

            $dashboardItem = new DashboardItem();
            $researchData = [
                'proposal_title' => $workflowMaster->researchProposalSubmission->title,
                'research_title' => $workflowMaster->researchProposalSubmission->requester->title,
                'remarks' => $workflowMaster->researchProposalSubmission->requester->remarks,
                'id' => $workflowMaster->ref_table_id,
            ];

            $workflowConversation = $this->flowConversationService->getActiveConversationByWorkFlow($workflowMaster->id);
            $dashboardItem->setFeatureItemId($feature->id);
            $dashboardItem->setFeatureName($feature->name);
            $dashboardItem->setWorkFlowConversationId($workflowConversation->id);

            $dashboardItem->setCheckUrl('/rms/research-proposal-submission/re-initiate/' . $workflowMaster->ref_table_id);
            $dashboardItem->setWorkFlowMasterId($workflowMaster->id);
            $dashboardItem->setWorkFlowMasterStatus($workflowMaster->status);
            $dashboardItem->setMessage($workflowConversation->message);

            $dashboardItem->setDynamicValues($researchData);
            //$dashboardItem->setRemarks($this->remarksService->findBy(['feature_id' => $feature->id, 'ref_table_id' => $workflowMaster->ref_table_id]));
            array_push($dashboardItems, $dashboardItem);
        }

        $dashboardItemSummary->setDashboardItems($dashboardItems);
        return $dashboardItemSummary;
    }
}
