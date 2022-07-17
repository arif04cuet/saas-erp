<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 11/04/19
 * Time: 17:27
 */

namespace App\Services\workflow\Generators;


use App\Models\DashboardItem;
use App\Models\DashboardItemSummary;
use App\Repositories\workflow\FeatureRepository;
use App\Services\Remark\RemarkService;
use App\Services\UserService;
use App\Services\workflow\WorkFlowConversationService;
use App\Services\workflow\WorkflowService;
use Modules\RMS\Services\ResearchDetailSubmissionService;
use Modules\RMS\Services\ResearchProposalSubmissionService;

class ResearchProposalDetailItemGenerator extends BaseDashboardItemGenerator
{
    private $workflowService;
    private $userService;
    private $proposalSubmissionService;
    private $featureRepository;
    private $flowConversationService;
    private $remarksService;
    private $researchDetailSubmissionService;
    private $feature;

    /**
     * ResearchProposalItemGenerator constructor.
     * @param WorkflowService $workflowService
     * @param UserService $userService
     * @param ResearchProposalSubmissionService $proposalSubmissionService
     * @param FeatureRepository $featureRepository
     *
     */
    public function __construct(WorkflowService $workflowService, UserService $userService,
                                ResearchProposalSubmissionService $proposalSubmissionService,
                                FeatureRepository $featureRepository, WorkFlowConversationService $flowConversationService,
                                RemarkService $remarkService, ResearchDetailSubmissionService $researchDetailSubmissionService)
    {
        $this->workflowService = $workflowService;
        $this->userService = $userService;
        $this->proposalSubmissionService = $proposalSubmissionService;
        $this->featureRepository = $featureRepository;
        $this->flowConversationService = $flowConversationService;
        $this->remarksService = $remarkService;
        $this->researchDetailSubmissionService = $researchDetailSubmissionService;
        $this->feature = $this->featureRepository->findOneBy(['name' => config('rms.research_proposal_detail_feature')]);
    }

    public function generateItems(): DashboardItemSummary
    {


        $dashboardItemSummary = new DashboardItemSummary();
        $dashboardItems = array();
        $user = $this->userService->getLoggedInUser();

        $designationId = $this->userService->getDesignationId($user->username);
        $departmentId = $this->userService->getDepartmentId($user->username);

        $workflows = $this->workflowService->getWorkflowDetailsByUserAndFeature($user->id, [$designationId], $this->feature->id, $departmentId);

        foreach ($workflows as $key => $workflow) {
            $dashboardItem = new DashboardItem();
            $workflowMaster = $workflow->workflowMaster;
            $researchDetail = $this->researchDetailSubmissionService->findOne($workflowMaster->ref_table_id);
            $workflowRuleDetails = $workflow->ruleDetails;
            $researchData = [
                'invitation_title' => $researchDetail->researchDetailInvitation->title,
                'title' => $researchDetail->title,
                'initiator_name' => $researchDetail->user->name,
                'remarks' => $researchDetail->remarks,
                'id' => $researchDetail->id,
            ];

            $workflowConversation = $workflow->workflowConversations[0];
            $dashboardItem->setFeatureItemId($workflow->workflowMaster->feature->id);
            $dashboardItem->setFeatureName($workflowMaster->feature->name);
            $dashboardItem->setWorkFlowConversationId($workflowConversation->id);

            $dashboardItem->setCheckUrl(
                '/rms/research-proposal-details/review/' . $workflowMaster->ref_table_id .
                '/' . $workflowMaster->feature->id . '/' . $workflowMaster->id . '/' . $workflowConversation->id . '/' . $workflowRuleDetails->id);


            $dashboardItem->setWorkFlowMasterId($workflowMaster->id);
            $dashboardItem->setWorkFlowMasterStatus($workflowMaster->status);
            $dashboardItem->setMessage($workflowConversation->message);
            $dashboardItem->setDynamicValues($researchData);
            $dashboardItem->setRemarks($this->remarksService->findBy(['feature_id' => $this->feature->id,'ref_table_id' => $researchDetail->id]));
            array_push($dashboardItems, $dashboardItem);
        }

        $dashboardItemSummary->setDashboardItems($dashboardItems);
        return $dashboardItemSummary;

    }

    public function updateItem($itemId, $status)
    {

    }
    public function generateRejectedItems(): DashboardItemSummary
    {
        $dashboardItemSummary = new DashboardItemSummary();
        $dashboardItems = array();
        $user = $this->userService->getLoggedInUser();
//        $feature = $this->featureRepository->findOneBy(['name' => config('constants.research_proposal_feature_name')]);
        $workflows = $this->workflowService->getRejectedItems($user->id, $this->feature->id);
        foreach ($workflows as $key => $workflowMaster) {
            $dashboardItem = new DashboardItem();
            $researchDetailData = [
                'detail_title' => $workflowMaster->researchDetail->title,
                'research_title' => $workflowMaster->researchDetail->researchDetailInvitation->title,
                'remarks' => $workflowMaster->researchDetail->researchDetailInvitation->remarks,
                'id' => $workflowMaster->ref_table_id,
            ];
            $workflowConversation = $this->flowConversationService->getActiveConversationByWorkFlow($workflowMaster->id);
            $dashboardItem->setFeatureItemId($this->feature->id);
            $dashboardItem->setFeatureName($this->feature->name);
            $dashboardItem->setWorkFlowConversationId($workflowConversation->id);

            $dashboardItem->setCheckUrl('/rms/research-proposal-details/re-initiate/' . $workflowMaster->ref_table_id);
            $dashboardItem->setWorkFlowMasterId($workflowMaster->id);
            $dashboardItem->setWorkFlowMasterStatus($workflowMaster->status);
            $dashboardItem->setMessage($workflowConversation->message);

            $dashboardItem->setDynamicValues($researchDetailData);
            //$dashboardItem->setRemarks($this->remarksService->findBy(['feature_id' => $feature->id, 'ref_table_id' => $workflowMaster->ref_table_id]));
            array_push($dashboardItems, $dashboardItem);
        }

        $dashboardItemSummary->setDashboardItems($dashboardItems);
        return $dashboardItemSummary;
    }


}