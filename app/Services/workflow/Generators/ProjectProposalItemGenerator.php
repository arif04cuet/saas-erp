<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/28/19
 * Time: 11:16 AM
 */

namespace App\Services\workflow\Generators;


use App\Models\DashboardItem;
use App\Models\DashboardItemSummary;
use App\Repositories\workflow\FeatureRepository;
use App\Repositories\workflow\WorkflowConversationRepository;
use App\Services\UserService;
use App\Services\workflow\WorkFlowConversationService;
use App\Services\workflow\WorkflowService;
use Modules\PMS\Services\ProjectProposalService;
use App\Constants\WorkflowStatus;

class ProjectProposalItemGenerator extends BaseDashboardItemGenerator
{
    private $workflowService;
    private $userService;
    private $projectProposalService;
    private $featureRepository;
    private $flowConversationService;
    private $featureName;


    public function __construct(WorkflowService $workflowService,
                                UserService $userService,
                                ProjectProposalService $projectProposalService,
                                FeatureRepository $featureRepository,
                                WorkFlowConversationService $flowConversationService)
    {
        $this->workflowService = $workflowService;
        $this->userService = $userService;
        $this->projectProposalService = $projectProposalService;
        $this->featureRepository = $featureRepository;
        $this->flowConversationService = $flowConversationService;
        $this->featureName = config('constants.project_proposal_feature_name');
    }

    public function generateItems(): DashboardItemSummary
    {
        $dashboardItemSummary = new DashboardItemSummary();
        $dashboardItems = array();
        $user = $this->userService->getLoggedInUser();
        $designationId = $this->userService->getDesignationId($user->username);
        $departmentId = $this->userService->getDepartmentId($user->username);

        $feature = $this->featureRepository->findOneBy(['name' => $this->featureName]);
        $workflows = $this->workflowService->getWorkflowDetailsByUserAndFeature($user->id, [$designationId], $feature->id, $departmentId);
        foreach ($workflows as $key => $workflow) {
            $dashboardItem = new DashboardItem();
            $workflowMaster = $workflow->workflowMaster;
            $workflowRuleDetails = $workflow->ruleDetails;
            $proposal = $this->projectProposalService->findOne($workflowMaster->ref_table_id);
            if (!$proposal) continue;
            $projectData = [
                'id' => $workflow->id,
                'feature_name' => $feature->name,
                'project_title' => $proposal->title,
                'requested_by' => $proposal->proposalSubmittedBy->name,
                'project_request_title' => $proposal->request->title,
                'wf_rule_details_id' => $workflowRuleDetails->id,
            ];

            $workflowConversation = $this->flowConversationService->getActiveConversationByWorkFlow($workflowMaster->id);
            $dashboardItem->setFeatureItemId($workflow->workflowMaster->feature->id);
            $dashboardItem->setFeatureName($workflowMaster->feature->name);
            $dashboardItem->setWorkFlowConversationId($workflowConversation->id);
            $dashboardItem->setCheckUrl(route('project-proposal-submitted-review', ['proposalId' => $workflowMaster->ref_table_id, 'wfMasterId' => $workflowMaster->id, 'wfConvId' => $workflowConversation->id, 'featureId' => $feature->id, 'ruleDetailsId' => $workflowRuleDetails->id ]));
            $dashboardItem->setWorkFlowMasterId($workflowMaster->id);
            $dashboardItem->setWorkFlowMasterStatus($workflowMaster->status);
            $dashboardItem->setMessage($workflowConversation->message);
            $dashboardItem->setDynamicValues($projectData);
            array_push($dashboardItems, $dashboardItem);
        }

        $dashboardItemSummary->setDashboardItems($dashboardItems);
        return $dashboardItemSummary;
    }

    public function updateItem($itemId, $status)
    {
        $proposal = $this->projectProposalService->findOne($itemId);
        if ($status == WorkflowStatus::APPROVED) {
            $this->projectProposalService->update($proposal, ['status' => WorkflowStatus::APPROVED]);
        }
    }

    public function generateRejectedItems(): DashboardItemSummary
    {
        $dashboardItemSummary = new DashboardItemSummary();
        $dashboardItems = array();
        $user = $this->userService->getLoggedInUser();
        $feature = $this->featureRepository->findOneBy(['name' => $this->featureName]);
        $workflows = $this->workflowService->getRejectedItems($user->id, $feature->id);
        foreach ($workflows as $key => $workflowMaster) {
            $dashboardItem = new DashboardItem();
            $workflowRuleDetails = $workflowMaster->ruleDetails;
            $proposal = $this->projectProposalService->findOne($workflowMaster->ref_table_id);
            $projectData = [
                'feature_name' => $feature->name,
                'project_title' => $proposal->title,
                'requested_by' => $proposal->proposalSubmittedBy->name,
                'project_request_title' => $proposal->request->title
            ];

            $workflowConversation = $this->flowConversationService->getActiveConversationByWorkFlow($workflowMaster->id);
            $dashboardItem->setFeatureItemId($feature->id);
            $dashboardItem->setFeatureName($feature->name);

            $dashboardItem->setWorkFlowConversationId($workflowConversation->id);
            $dashboardItem->setCheckUrl(route('project-proposal-submitted-resubmit', ['proposalId' =>  $workflowMaster->ref_table_id, 'feature_id' => $feature->id]));
            $dashboardItem->setWorkFlowMasterId($workflowMaster->id);
            $dashboardItem->setWorkFlowMasterStatus($workflowMaster->status);
            $dashboardItem->setMessage($workflowConversation->message);
            $dashboardItem->setCloseUrl(route('project-proposal-submitted-close', ['wfMasterId'=> $workflowMaster->id]));

            $dashboardItem->setDynamicValues($projectData);
            array_push($dashboardItems, $dashboardItem);
        }

        $dashboardItemSummary->setDashboardItems($dashboardItems);
        return $dashboardItemSummary;
    }
}
