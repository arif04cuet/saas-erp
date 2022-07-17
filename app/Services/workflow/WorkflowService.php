<?php

/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/22/19
 * Time: 1:10 PM
 */

namespace App\Services\workflow;

use App\Constants\WorkflowConversationStatus;
use App\Constants\WorkflowGetBackStatus;
use App\Constants\WorkflowStatus;
use App\Entities\workflow\WorkflowDetail;
use App\Entities\workflow\WorkflowMaster;
use App\Entities\workflow\WorkflowRuleDetail;
use App\Entities\workflow\WorkflowRuleMaster;
use App\Repositories\workflow\WorkflowConversationRepository;
use App\Repositories\workflow\WorkflowDetailRepository;
use App\Repositories\workflow\WorkflowMasterRepository;
use App\Repositories\workflow\WorkflowRuleDetailRepository;
use App\Repositories\workflow\WorkflowRuleMasterRepository;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Auth;

class WorkflowService
{
    use CrudTrait;

    private $workFlowMasterRepository;
    private $workflowRuleMasterRepository;
    private $flowConversationRepository;
    private $flowConversationService;
    private $workflowDetailRepository;
    private $workflowRuleDetailRepository;

    /**
     * WorkflowService constructor.
     * @param WorkFlowMasterRepository $workFlowMasterRepository
     * @param WorkflowRuleMasterRepository $workflowRuleMasterRepository
     * @param WorkflowConversationRepository $flowConversationRepository
     * @param WorkflowDetailRepository $workflowDetailRepository
     * @param WorkFlowConversationService $flowConversationService
     */
    public function __construct(
        WorkFlowMasterRepository $workFlowMasterRepository,
        WorkflowRuleMasterRepository $workflowRuleMasterRepository,
        WorkflowConversationRepository $flowConversationRepository,
        WorkflowDetailRepository $workflowDetailRepository,
        WorkFlowConversationService $flowConversationService,
        WorkflowRuleDetailRepository $workflowRuleDetailRepository
    ) {
        $this->workFlowMasterRepository = $workFlowMasterRepository;
        $this->workflowRuleMasterRepository = $workflowRuleMasterRepository;
        $this->flowConversationRepository = $flowConversationRepository;
        $this->workflowDetailRepository = $workflowDetailRepository;
        $this->flowConversationService = $flowConversationService;
        $this->workflowRuleDetailRepository = $workflowRuleDetailRepository;
        $this->setActionRepository($workflowRuleMasterRepository);
    }

    public function createWorkflow($data)
    {
        $ruleMaster = $this->workflowRuleMasterRepository->findOne($data['rule_master_id']);

        //Save Workflow master
        $workflowMaster = $this->workFlowMasterRepository->save([
            'feature_id' => $data['feature_id'],
            'rule_master_id' => $ruleMaster->id,
            'ref_table_id' => $data['ref_table_id'],
            'status' => WorkflowStatus::INITIATED,
            'initiator_id' => Auth::user()->id
        ]);

        //Save workflow details
        $workflowDetails = $this->getWorkflowDetails($workflowMaster, $ruleMaster, $data);

        $workflowMaster->workflowDetails()->saveMany($workflowDetails);

        //Save conversation
        $this->flowConversationRepository->save([
            'workflow_master_id' => $workflowMaster->id,
            'workflow_details_id' => $workflowMaster->workflowDetails[0]->id,
            'feature_id' => $data['feature_id'],
            'message' => $data['message'],
            'status' => WorkflowConversationStatus::ACTIVE
        ]);
    }

    private function getWorkflowDetails(WorkflowMaster $workflowMaster, WorkflowRuleMaster $workflowRuleMaster, $data)
    {
        $workflowDetailList = array();
        $notificationOrder = 1;
        $workflowRuleDetailList = $workflowRuleMaster->ruleDetails;
        foreach ($workflowRuleDetailList as $ruleDetail) {
            //Check if any step need to be skipped
            if ($this->isSkipped($ruleDetail, $data)) {
                continue;
            }
            $designationId = $this->getDesignationByRule($ruleDetail, $data);
            for ($i = 0; $i < $ruleDetail->number_of_responder; $i++) {
                $workflowDetail = new WorkflowDetail(
                    [
                        'workflow_master_id' => $workflowMaster->id,
                        'rule_detail_id' => $ruleDetail->id,
                        'designation_id' => $designationId,
                        'department_id' => $data['department_id'] ?? null,
                        'notification_order' => $notificationOrder,
                        'responder_id' => $ruleDetail->is_group_notification ? null : $data['responder_id'],
                        'creator_id' => Auth::user()->id,
                        'is_group_notification' => $ruleDetail->is_group_notification,
                        'status' => $notificationOrder == 1 ? WorkflowStatus::PENDING : WorkflowStatus::INITIATED
                    ]
                );
                array_push($workflowDetailList, $workflowDetail);
                $notificationOrder++;
            }
        }

        return $workflowDetailList;
    }

    private function getDesignationByRule(WorkflowRuleDetail $ruleDetail, $data)
    {
        $designationId = null;
        if (isset($data['designationTo'])) {
            //$designationId = $ruleDetail->designation_id;
            $designationId = $data['designationTo'][1];
        } else {
            if ($ruleDetail->is_group_notification && isset($data['designationTo'])) {
                $designationId = $data['designationTo'][$ruleDetail->notification_order];
            }
        }
        return $designationId;
    }

    private function isSkipped(WorkflowRuleDetail $ruleDetail, $data)
    {
        return isset($data['skipped']) && in_array($ruleDetail->notification_order, $data['skipped']);
    }

    public function getWorkFlowNotification($userId, array $designationIds)
    {
        $workFlowMasterList = $this->workFlowMasterRepository->getByDesignationAndUser($userId, $designationIds);
        return $workFlowMasterList;
    }

    public function getWorkflowDetailsByUser($userId, array $designationIds)
    {
        return $this->workflowDetailRepository->getWorkflowDetails($userId, $designationIds);
    }

    public function getWorkflowDetailsByUserAndFeature($userId, array $designationIds, $featureId, $departmentId)
    {
        //        return $this->workflowDetailRepository->getWorkflowDetails($userId, $designationIds, $featureId);
        return $this->workflowDetailRepository->getWorkflowDetailsByFeature($userId, $designationIds, $featureId, $departmentId);
    }

    private function isFlowCompleted($getBackStatus, $flowDetailsList)
    {
        return ($getBackStatus == WorkflowGetBackStatus::NONE) || !$this->isPendingWorkFlow($flowDetailsList);
    }

    private function isPendingWorkFlow($flowDetailsList)
    {
        foreach ($flowDetailsList as $flowDetail) {
            if ($flowDetail->status == WorkflowStatus::PENDING || $flowDetail->status == WorkflowStatus::REVIEW) {
                return true;
            }
        }
        return false;
    }

    private function isFlowAccepted($workFlowDetails)
    {
        foreach ($workFlowDetails as $flowDetail) {
            if ($flowDetail->status != WorkflowStatus::APPROVED) {
                return false;
            }
        }
        return true;
    }

    public function updateWorkFlow($workFlowId, $workFlowConversationId, $responderId, $status, $remarks, $message)
    {
        $workFlowConversation = $this->flowConversationService->findOne($workFlowConversationId);
        $workFlowMaster = $this->workFlowMasterRepository->findOne($workFlowId);
        $workflowDetails = $this->workflowDetailRepository->findOne($workFlowConversation->workflow_details_id);
        $this->updateWorkFlowDetails(
            $workFlowMaster->workflowDetails,
            $status,
            $workflowDetails->ruleDetails->get_back_status,
            $responderId,
            $message,
            $workFlowConversation->workflow_details_id,
            $remarks
        );
        if ($this->isFlowCompleted($workFlowMaster->ruleMaster->get_back_status, $workFlowMaster->workflowDetails)) {
            if ($this->isFlowAccepted($workFlowMaster->workflowDetails)) {
                $workFlowMaster->status = WorkflowStatus::APPROVED;
            } else {
                $workFlowMaster->status = WorkflowStatus::REJECTED;
            }
            //TODO: Notify respective users
        }
        $workFlowMaster->update();
    }

    private function updateWorkFlowDetails(
        $flowDetailsList,
        $responseStatus,
        $getBackStatus,
        $responderId,
        $message,
        $workFlowDetailsId,
        $remarks
    ) {
        for ($count = 0; $count < count($flowDetailsList); $count++) {
            $flowDetails = $flowDetailsList[$count];

            if ($flowDetails->id == $workFlowDetailsId && $flowDetails->status == WorkflowStatus::PENDING) {
                //set response
                $flowDetails->status = $responseStatus;
                //                $flowDetails->responder_id = 'responder_id';
                $flowDetails->responder_remarks = $remarks;
                $this->flowConversationService->closeConversation($flowDetails->workflowMaster->id, $flowDetails->id);

                //Set next responder
                $flowDetailsNext = null;
                if ($responseStatus == WorkflowStatus::APPROVED && ($count + 1 < count($flowDetailsList))) {
                    $flowDetailsNext = $flowDetailsList[$count + 1];
                    $flowDetailsNext->status = WorkflowStatus::PENDING;
                    $flowDetailsNext->creator_id = $responderId; //Responder of previous step is the creator of next step
                } else {
                    if ($responseStatus == WorkflowStatus::REJECTED && $getBackStatus != WorkflowGetBackStatus::NONE) {
                        if ($getBackStatus == WorkflowGetBackStatus::INITIAL || ($count - 1 < 0)) {
                            $flowDetailsNext = $flowDetailsList[0];
                        } else {
                            $flowDetailsNext = $flowDetailsList[$count - 1];
                            $flowDetailsNext->status = WorkflowStatus::PENDING;
                        }
                    }
                }
                if ($flowDetailsNext != null) {
                    $this->flowConversationService->save([
                        'workflow_master_id' => $flowDetailsNext->workflowMaster->id,
                        'workflow_details_id' => $flowDetailsNext->id,
                        'feature_id' => $flowDetailsNext->workflowMaster->feature->id,
                        'message' => $message,
                        'status' => WorkflowConversationStatus::ACTIVE
                    ]);
                    $flowDetailsNext->update();
                }

                $flowDetails->update();
                break;
            }
        }
    }

    public function getWorkflowMaster($id)
    {
        return $this->workFlowMasterRepository->findOne($id);
    }

    public function reinitializeWorkflow($data)
    {
        $workflowMaster = $this->workFlowMasterRepository->findOneBy([
            'feature_id' => $data['feature_id'],
            'ref_table_id' => $data['ref_table_id']
        ]);

        $workflowDetails = $workflowMaster->workflowDetails;

        foreach ($workflowDetails as $workflowDetail) {
            $workflowDetail->status = $workflowDetail->notification_order == 1 ? WorkflowStatus::PENDING : WorkflowStatus::INITIATED;
            $workflowDetail->update();
        }
        $workflowMaster->status = WorkflowStatus::INITIATED;
        $workflowMaster->update();

        //Save conversation
        $this->flowConversationService->closeByFlowMaster($workflowMaster->id);
        $this->flowConversationRepository->save([
            'workflow_master_id' => $workflowMaster->id,
            'workflow_details_id' => $workflowMaster->workflowDetails[0]->id,
            'feature_id' => $data['feature_id'],
            'message' => $data['message'],
            'status' => WorkflowConversationStatus::ACTIVE
        ]);
    }

    public function getRejectedItems($userId, $featureId)
    {
        return $this->workFlowMasterRepository->findBy([
            'initiator_id' => $userId,
            'status' => WorkflowStatus::REJECTED,
            'feature_id' => $featureId
        ]);
    }

    public function approveWorkflow($workflowMasterId)
    {
        $workflowMaster = $this->workFlowMasterRepository->findOne($workflowMasterId);
        $this->workFlowMasterRepository->update($workflowMaster, ['status' => WorkflowStatus::APPROVED]);

        $workflowDetails = $workflowMaster->workflowDetails;
        foreach ($workflowDetails as $workflowDetail) {
            if ($workflowDetail->status != WorkflowStatus::APPROVED) {
                $workflowDetail->status = WorkflowStatus::APPROVED;
                $workflowDetail->update();
            }
        }
    }

    public function closeWorkflow($workflowMasterId)
    {
        $workflowMaster = $this->workFlowMasterRepository->findOne($workflowMasterId);
        $this->workFlowMasterRepository->update($workflowMaster, ['status' => WorkflowStatus::CLOSED]);
        $workflowDetails = $workflowMaster->workflowDetails;
        foreach ($workflowDetails as $workflowDetail) {
            if ($workflowDetail->status == WorkflowStatus::PENDING || $workflowDetail->status == WorkflowStatus::INITIATED) {
                $workflowDetail->status = WorkflowStatus::CLOSED;
                $workflowDetail->update();
            }
        }
    }

    // Fetching Rule Details and others
    public function getRuleDetailsByRuleId($id)
    {
        return $this->workflowRuleDetailRepository->findOne($id);
    }

    public function getWorkflowConversationById($id)
    {
        return $this->flowConversationRepository->findOne($id);
    }

    public function getActiveWorkflowByWFMasterId($WFMasterId)
    {
        return $this->workflowDetailRepository->findBy([
            'workflow_master_id' => $WFMasterId
            // 'status' => 'PENDING'
        ])->first();
    }
}
