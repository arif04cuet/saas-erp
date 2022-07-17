<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 3/4/19
 * Time: 12:06 PM
 */

namespace App\Services\Sharing;


use App\Traits\CrudTrait;
use http\Client\Response;
use App\Services\UserService;
use App\Models\NotificationInfo;
use App\Constants\WorkflowStatus;
use Modules\RMS\Entities\Research;
use App\Constants\NotificationType;
use Illuminate\Support\Facades\Auth;
use App\Events\NotificationGeneration;
use App\Services\Remark\RemarkService;
use Illuminate\Support\Facades\Config;
use App\Entities\Sharing\ShareConversation;
use App\Constants\WorkflowConversationStatus;
use App\Repositories\workflow\FeatureRepository;
use Modules\HRM\Repositories\DesignationRepository;
use App\Services\workflow\WorkFlowConversationService;
use App\Repositories\workflow\WorkflowMasterRepository;
use App\Repositories\Sharing\ShareConversationRepository;
use App\Repositories\Sharing\ShareRuleDesignationRepository;

class ShareConversationService
{
    use CrudTrait;
    private $shareConversationRepository;
    private $workflowConversationService;
    private $workflowMasterRepository;
    private $designationRepository;
    private $userService;
    private $featureRepository;
    private $remarkService;
    private $shareRuleDesignationRepository;

    public function __construct(ShareConversationRepository $conversationRepository, WorkFlowConversationService $workFlowConversationService,
                                WorkflowMasterRepository $workflowMasterRepository, DesignationRepository $designationRepository,
                                UserService $userService, FeatureRepository $featureRepository, RemarkService $remarkService,
                                ShareRuleDesignationRepository $shareRuleDesignationRepository
    )
    {
        $this->shareConversationRepository = $conversationRepository;
        $this->workflowConversationService = $workFlowConversationService;
        $this->workflowMasterRepository = $workflowMasterRepository;
        $this->designationRepository = $designationRepository;
        $this->userService = $userService;
        $this->featureRepository = $featureRepository;
        $this->remarkService = $remarkService;
        $this->shareRuleDesignationRepository = $shareRuleDesignationRepository;
        $this->setActionRepository($this->shareConversationRepository);
    }

    public function shareFromWorkflow($data)
    {
//        dd($data);
        $workflowConversation = $this->workflowConversationService->findOne($data['workflow_conversation_id']);
        $workflowConversation->status = WorkflowConversationStatus::CLOSED;
        $workflowConversation->update();
        $workflowDetail = $workflowConversation->workFlowDetail;
        $workflowDetail->status = WorkflowStatus::REVIEW;
        $workflowDetail->update();
        $data['request_ref_id'] = $workflowConversation->workflow_details_id;
        $data['ref_table_id'] = $data['item_id'];
        return $this->saveShareConversation($data);
    }

    public function saveShareConversation($data, ShareConversation $currentConv = null)
    {
        $shareRuleDesignation = $this->shareRuleDesignationRepository->getShareRuleDesignationByRuleAndDesignation($data['share_rule_id'], $data['designation_id']);
        // For all designation used designation id 0
        if(is_null($shareRuleDesignation))
        {
            $shareRuleDesignation = $this->shareRuleDesignationRepository->getShareRuleDesignationByRuleAndDesignation($data['share_rule_id'], 0);
        }
        if ($shareRuleDesignation->is_parent && $currentConv) {
            $workflowDetail = $currentConv->workflowDetails;
            $workflowDetail->status = WorkflowStatus::PENDING;
            $workflowDetail->update();
            $save = $this->workflowConversationService->save([
                'workflow_master_id' => $workflowDetail->workflow_master_id,
                'workflow_details_id' => $workflowDetail->id,
                'feature_id' => $data['feature_id'],
                'message' => $data['message'],
                'status' => WorkflowConversationStatus::ACTIVE
            ]);
        } else {
            $data['from_user_id'] = Auth::user()->id;
            $data['status'] = 'ACTIVE';
            $data['share_rule_designation_id'] = $shareRuleDesignation->id;
            $save = $this->shareConversationRepository->save($data);
        }
        if (!empty($data['remarks'])) {
            $this->remarkService->save(['feature_id' => $data['feature_id'], 'ref_table_id' => $data['ref_table_id'],
                'from_user_id' => Auth::user()->id, 'remarks' => $data['remarks']]);
        }
        return $save;
    }

    public function getShareConversationByDesignation($employeeData)
    {        
        if ($employeeData->designation->short_name == 'DG') {
            $shareConversations = $this->findBy(['designation_id' => $employeeData->designation_id, 'status' => 'ACTIVE']);
        } else {
            $shareConversations = $this->findBy(['designation_id' => $employeeData->designation_id, 'status' => 'ACTIVE', 'department_id' => $employeeData->department_id]);
        }
       
        $shareConversationData = [];
        foreach ($shareConversations as $conversation) {
            //      1 ==  Research proposal / brief
            if ($conversation->feature_id == 1) {
                $shareConversationData['research_brief_share'][] = $conversation;
                //      4 == Research detail
            } elseif ($conversation->feature_id == 4) {
                $shareConversationData['research_detail_share'][] = $conversation;
            }
            elseif ($conversation->feature_id == 3) {
                $shareConversationData['research_workflow'][] = $conversation;
            }
        }
        return $shareConversationData;
    }

    public function updateConversation($data, $shareConversationId)
    {
        $shareConversation = $this->findOne($shareConversationId);
        $shareConversation->update(['status' => 'CLOSE']);
        //$user = $this->userService->findOne($shareConversation->from_user_id);

//        $notificationData = [
//            'ref_table_id' => $data['ref_table_id'],
//            'message' => 'Research proposal feedback given',
//            'to_employee_id' => [$user->employee->id],
//        ];
//        event(new NotificationGeneration(new NotificationInfo(NotificationType::RESEARCH_PROPOSAL_SUBMISSION, $notificationData)));
    }

    // Generic method to get share conversation by designation ID
    public function getShareConversationByDesignationId($designationId)
    {
        return $this->findBy(['designation_id' => $designationId, 'status' => 'ACTIVE']);
    }

    public function getPMSShareConversationByEmployee($user)
    {
        if ($user->employee->designation->short_name == 'DG') {
            return $this->findBy(['designation_id' => $user->employee->designation_id, 'status' => 'ACTIVE']);
        } else {
            return $this->findBy(['designation_id' => $user->employee->designation_id, 'status' => 'ACTIVE', 'department_id' => $user->employee->department_id]);
        }
    }
}
