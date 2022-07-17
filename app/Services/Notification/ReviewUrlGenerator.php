<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 4/3/19
 * Time: 5:36 PM
 */

namespace App\Services\Notification;


use App\Entities\workflow\Feature;
use App\Services\workflow\WorkFlowConversationService;
use App\Services\workflow\WorkflowMasterService;
use App\Services\workflow\WorkflowService;
use Illuminate\Database\Eloquent\Model;
use Modules\PMS\Entities\ProjectProposal;

class ReviewUrlGenerator
{
    /**
     * @var WorkflowMasterService
     */
    private $workflowMasterService;
    /**
     * @var WorkFlowConversationService
     */
    private $workFlowConversationService;
    private $workflowService;

    /**
     * ReviewUrlGenerator constructor.
     * @param WorkflowMasterService $workflowMasterService
     * @param WorkFlowConversationService $workFlowConversationService
     */
    public function __construct(
        WorkflowMasterService $workflowMasterService,
        WorkFlowConversationService $workFlowConversationService,
        WorkflowService $workflowService
    )
    {
        $this->workflowMasterService = $workflowMasterService;
        $this->workFlowConversationService = $workFlowConversationService;
        $this->workflowService = $workflowService;
    }

    public function getReviewUrl($routeName, Feature $feature, Model $notifiable): string
    {
        $workflowMaster = $this->workflowMasterService->findBy([
            'feature_id' => $feature->id,
            'rule_master_id' => $feature->workflowRuleMaster->id,
            'ref_table_id' => $notifiable->id,
        ])->first();
//        $workflowRuleDetail = $feature->workflowRuleMaster->ruleDetails
//            ->where('rule_master_id', $feature->workflowRuleMaster->id)
//            ->where('notification_order', 1)
//            ->first();;
        $workflowDetail = $this->workflowService->getActiveWorkflowByWFMasterId($workflowMaster->id);
        if(is_null($workflowDetail)) return "#";

        $workflowConversation = $this->workFlowConversationService->getActiveConversationByWorkFlow($workflowMaster->id);
        $url = route(
            $routeName,
            [
                'proposalId' => $workflowMaster->ref_table_id,
                'wfMasterId' => $workflowMaster->id,
                'wfConvId' => $workflowConversation->id,
                'feature_id' => $feature->id,
                'ruleDetailsId' => $workflowDetail->rule_detail_id
            ]);

        return $url;
    }

    public function getRmsReviewUrl($routeName, Feature $feature, Model $notifiable): string
    {
        $workflowMaster = $this->workflowMasterService->findBy([
            'feature_id' => $feature->id,
            'rule_master_id' => $feature->workflowRuleMaster->id,
            'ref_table_id' => $notifiable->id,
        ])->first();

//        $workflowRuleDetail = $feature->workflowRuleMaster->ruleDetails
//            ->where('rule_master_id', $feature->workflowRuleMaster->id)
//            ->where('notification_order', 1)
//            ->first();;
        $workflowRuleDetail = $this->workflowService->getActiveWorkflowByWFMasterId($workflowMaster->id);
        $workflowConversation = $this->workFlowConversationService->getActiveConversationByWorkFlow($workflowMaster->id);

        $url = route(
            $routeName,
            [
                'researchProposalSubmissionId' => $workflowMaster->ref_table_id,
                'featureName' => $feature->name,
                'workflowMasterId' => $workflowMaster->id,
                'workflowConversationId' => $workflowConversation->id,
                'workflowRuleDetailsId' => $workflowRuleDetail->rule_detail_id
            ]);

        return $url;
    }

    public function getRDetailReviewUrl($routeName, Feature $feature, Model $notifiable): string
    {

        $workflowMaster = $this->workflowMasterService->findBy([
            'feature_id' => $feature->id,
            'rule_master_id' => $feature->workflowRuleMaster->id,
            'ref_table_id' => $notifiable->id,
        ])->first();


        $workflowRuleDetail = $this->workflowService->getActiveWorkflowByWFMasterId($workflowMaster->id);
//        dd($workflowRuleDetail);
        $workflowConversation = $this->workFlowConversationService->getActiveConversationByWorkFlow($workflowMaster->id);
        $url = route(
            $routeName,
            [
                'researchDetailId' => $workflowMaster->ref_table_id,
                'featureId' => $feature->id,
                'workflowMasterId' => $workflowMaster->id,
                'workflowConversationId' => $workflowConversation->id,
                'workflowRuleDetailsId' => $workflowRuleDetail->rule_detail_id
            ]);

        return $url;
    }

    public function getResearchReviewUrl($routeName, Feature $feature, Model $notifiable): string
    {
        $workflowMaster = $this->workflowMasterService->findBy([
            'feature_id' => $feature->id,
            'rule_master_id' => $feature->workflowRuleMaster->id,
            'ref_table_id' => $notifiable->id,
        ])->first();

//        $workflowRuleDetail = $feature->workflowRuleMaster->ruleDetails
//            ->where('rule_master_id', $feature->workflowRuleMaster->id)
//            ->where('notification_order', 1)
//            ->first();;

        $workflowDetail = $this->workflowService->getActiveWorkflowByWFMasterId($workflowMaster->id);

        $workflowConversation = $this->workFlowConversationService->getActiveConversationByWorkFlow($workflowMaster->id);

        $url = route(
            $routeName,
            [
                'researchId' => $workflowMaster->ref_table_id,
                'featureId' => $feature->id,
                'workflowMasterId' => $workflowMaster->id,
                'workflowConversationId' => $workflowConversation->id,
                'ruleDetailsId' => $workflowDetail->rule_detail_id
            ]);

        return $url;
    }


    /**
     * @param Model $model
     * @param Feature $feature
     * @return array
     */
    private function getKeyValue(Model $model, Feature $feature): array
    {
        if ($model instanceof ProjectProposal) {
            return ['featureId' => $feature->id];
        } else {
            return ['featureName' => $feature->name];
        }
    }
}