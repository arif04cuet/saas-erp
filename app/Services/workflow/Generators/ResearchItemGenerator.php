<?php

namespace App\Services\workflow\Generators;

use App\Constants\WorkflowStatus;
use App\Entities\workflow\WorkflowConversation;
use App\Models\DashboardItem;
use App\Models\DashboardItemSummary;
use App\Repositories\workflow\FeatureRepository;
use App\Services\Remark\RemarkService;
use App\Services\UserService;
use App\Services\workflow\WorkFlowConversationService;
use App\Services\workflow\WorkflowService;
use Illuminate\Support\Str;
use Modules\RMS\Services\ResearchService;

class ResearchItemGenerator extends BaseDashboardItemGenerator
{
    private $workflowService;
    private $userService;
    private $featureRepository;
    private $researchService;
    private $workflowConversations;
    private $remarksService;
    private $flowConversationService;

    public function __construct(ResearchService $researchService, WorkflowService $workflowService,
                                UserService $userService, FeatureRepository $featureRepository,
                                WorkflowConversation $workflowConversation, RemarkService $remarkService, WorkFlowConversationService $workFlowConversationService)
    {
        $this->workflowService = $workflowService;
        $this->userService = $userService;
        $this->featureRepository = $featureRepository;
        $this->researchService = $researchService;
        $this->workflowConversations = $workflowConversation;
        $this->remarksService = $remarkService;
        $this->flowConversationService = $workFlowConversationService;
    }

    public function generateItems(): DashboardItemSummary
    {

        $dashboardItemSummary = new DashboardItemSummary();
        $dashboardItems = array();
        $user = $this->userService->getLoggedInUser();

        $designationId = $this->userService->getDesignationId($user->username);
        $departmentId = $this->userService->getDepartmentId($user->username);
//        dd($designationId);
        $feature = $this->featureRepository->findOneBy(['name' => config('rms.research_feature_name')]);
        $workflows = $this->workflowService->getWorkflowDetailsByUserAndFeature($user->id, [$designationId], $feature->id, $departmentId);
        foreach ($workflows as $key => $workflow) {
            $dashboardItem = new DashboardItem();
            $workflowMaster = $workflow->workflowMaster;
            $proposal = $this->researchService->findOne($workflowMaster->ref_table_id);
            $workflowRuleDetails = $workflow->ruleDetails;
            $researchData = [
                'research_title' => $proposal->title,
                'publication_description' => $proposal->publication->description,
                'submitted_by' => $proposal->researchSubmittedByUser->name,
                'remarks' => $proposal->remarks,
                'id' => $proposal->id,
            ];

            $workflowConversation = $workflow->workflowConversations[0];
            $dashboardItem->setFeatureItemId($workflow->workflowMaster->feature->id);
            $dashboardItem->setFeatureName($workflowMaster->feature->name);
            $dashboardItem->setWorkFlowConversationId($workflowConversation->id);

            $dashboardItem->setCheckUrl(
                '/rms/researches/review/' . $workflowMaster->ref_table_id .
                '/' . $workflowMaster->feature->id . '/' . $workflowMaster->id . '/' . $workflowConversation->id.'/'. $workflowRuleDetails->id);
            $dashboardItem->setWorkFlowMasterId($workflowMaster->id);
            $dashboardItem->setWorkFlowMasterStatus($workflowMaster->status);
            $dashboardItem->setMessage($workflowConversation->message);
            $dashboardItem->setDynamicValues($researchData);
            $dashboardItem->setRemarks($this->remarksService->findBy(['feature_id' => $feature->id, 'ref_table_id' => $proposal->id]));
            array_push($dashboardItems, $dashboardItem);
        }

        $dashboardItemSummary->setDashboardItems($dashboardItems);
        return $dashboardItemSummary;

    }

    public function updateItem($itemId, $status)
    {
        $proposal = $this->researchService->findOne($itemId);
        if ($status == WorkflowStatus::APPROVED) {
            $this->researchService->update($proposal, ['status' => WorkflowStatus::APPROVED]);
        }
    }

    public function generateRejectedItems(): DashboardItemSummary
    {
        $dashboardItemSummary = new DashboardItemSummary();
        $dashboardItems = array();
        $user = $this->userService->getLoggedInUser();

        $feature = $this->featureRepository->findOneBy(['name' => config('rms.research_feature_name')]);
        $workflows = $this->workflowService->getRejectedItems($user->id, $feature->id);

        foreach ($workflows as $key => $workflowMaster) {
            $dashboardItem = new DashboardItem();
            $researchData = [
                'research_title' => $workflowMaster->research->title,
                'publication_description' => $workflowMaster->research->publication->description,
                'submitted_by' => $workflowMaster->research->researchSubmittedByUser->name,
                'id' => $workflowMaster->ref_table_id,
            ];

            $workflowConversation = $this->flowConversationService->getActiveConversationByWorkFlow($workflowMaster->id);
            $dashboardItem->setFeatureItemId($feature->id);
            $dashboardItem->setFeatureName($feature->name);
            $dashboardItem->setWorkFlowConversationId($workflowConversation->id);

            $dashboardItem->setCheckUrl('/rms/researches/re-initiate/' . $workflowMaster->ref_table_id);
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
