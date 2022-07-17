<?php
namespace Modules\PMS\Services;

use App\Services\Sharing\ShareConversationService;
use App\Services\UserService;
use App\Services\workflow\DashboardWorkflowService;
use App\Services\workflow\FeatureService;
use App\Services\workflow\WorkflowMasterService;
use App\Services\workflow\WorkflowService;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Auth;


class PMSService
{
    use CrudTrait;

    private $dashboardService;
    private $shareConversationService;
    private $userService;
    private $workflowMasterService;
    private $workflowService;
    private $projectBriefProposalService;
    private $projectDetailsProposalService;
    private $featureService;

    public function __construct(DashboardWorkflowService $dashboardService,
                                ShareConversationService $shareConversationService,
                                UserService $userService,
                                WorkflowMasterService $workflowMasterService,
                                WorkflowService $workflowService,
                                ProjectProposalService $projectBriefProposalService,
                                ProjectDetailProposalService $projectDetailsProposalService,
                                FeatureService $featureService
    )
    {
        $this->dashboardService = $dashboardService;
        $this->shareConversationService = $shareConversationService;
        $this->userService = $userService;
        $this->workflowMasterService = $workflowMasterService;
        $this->workflowService = $workflowService;
        $this->projectBriefProposalService = $projectBriefProposalService;
        $this->projectDetailsProposalService = $projectDetailsProposalService;
        $this->featureService = $featureService;
    }

    /*
     * Function to get all the tasks related to PMS of the auth user
     */
    public function getPendingTasks()
    {
        $featureName = config('constants.project_proposal_feature_name');
        $pendingTasks[] = $this->dashboardService->getDashboardWorkflowItems($featureName);
        $featureName = config('constants.project_details_proposal_feature_name');
        $pendingTasks[] = $this->dashboardService->getDashboardWorkflowItems($featureName);

        return $pendingTasks;
    }

    public function getRejectedTasks()
    {
        $featureName = config('constants.project_proposal_feature_name');
        $rejectedTasks[] = $this->dashboardService->getDashboardRejectedWorkflowItems($featureName);
        $featureName = config('constants.project_details_proposal_feature_name');
        $rejectedTasks[] = $this->dashboardService->getDashboardRejectedWorkflowItems($featureName);

        return $rejectedTasks;
    }

    /*
     * Method to fetch pending share conversations for the auth users from all features
     */
    public function getShareConversations()
    {
        $loggedInUser = $this->userService->getLoggedInUser();
        $shareConversations = $this->shareConversationService->getPMSShareConversationByEmployee($loggedInUser);
        $allShareConvs = null;
        if(!is_null($shareConversations)){
            foreach ($shareConversations as $shareConversation)
            {
                $data['id'] = $shareConversation->id;
                $data['ref_table_id'] = $shareConversation->ref_table_id;
                $data['feature_id'] = $shareConversation->feature->id;
                $data['feature_name'] = $shareConversation->feature->name;
                $data['message'] = $shareConversation->message;

                if($shareConversation->feature->name == config('constants.project_proposal_feature_name'))
                {
                    $data['proposal_title'] = $shareConversation->projectProposal->title;
                    $data['project_title'] = $shareConversation->projectProposal->request->title;
                    $data['project_submitted_by'] = $shareConversation->projectProposal->proposalSubmittedBy->name;
                    $data['review_url'] =route('sending-project-for-review', [$shareConversation->ref_table_id, $shareConversation->id]);
                }
                elseif($shareConversation->feature->name == config('constants.project_details_proposal_feature_name'))
                {
                    $data['proposal_title'] = $shareConversation->projectDetailProposal->title;
                    $data['project_title'] = $shareConversation->projectDetailProposal->request->title;
                    $data['project_submitted_by'] = $shareConversation->projectDetailProposal->proposalSubmittedBy->name;
                    $data['review_url'] =route('sending-project-detail-for-review', [$shareConversation->ref_table_id, $shareConversation->id]);
                }
                else
                    continue;

                $allShareConvs[] = $data;
            }
        }

        return $allShareConvs;
    }

    public function bulkReviewFeedbackUpdate($data)
    {
        foreach ($data['id'] as $approval)
        {
            $idArray = explode('-',$approval);
            $shareConvId = $idArray[0];
            $proposalId = $idArray[1];
            $featureId = $idArray[2];
            $wfMaster = $this->workflowMasterService->findBy(['ref_table_id' => $proposalId])[0];
            if($data['status'] == 'APPROVED') $this->workflowService->approveWorkflow($wfMaster->id); elseif($data['status'] == 'REJECTED') $this->workflowService->closeWorkflow($wfMaster->id);
            $this->shareConversationService->updateConversation(['ref_table_id' => $proposalId], $shareConvId);
            //$this->remarkService->save(['feature_id' => $wfMaster->feature_id, 'ref_table_id' => $proposalId, 'from_user_designation' => $this->userService->getDesignationId(Auth::user()->username)]);
            $feature = $this->featureService->findOne($featureId);
            if($feature->name == config('constants.project_proposal_feature_name'))
                $item = $this->projectBriefProposalService->findOne($proposalId);
            elseif($feature->name == config('constants.project_details_proposal_feature_name'))
                $item = $this->projectDetailsProposalService->findOne($proposalId);

            $item->update(['status' => $data['status']]);

            // Generate Notification
            $notificationData =  ['ref_table_id' => $proposalId, 'status' => $data['status'], 'item_title' => $item->title];
            // $this->projectBriefProposalService->generatePMSNotification($notificationData, 'project_proposal_review', '#');
        }
    }

    public function closeProjectBriefProposalWorkflow($wfMasterId)
    {
        $this->workflowService->closeWorkflow($wfMasterId);
        $wfMaster = $this->workflowMasterService->findOne($wfMasterId);

        $projectProposal = $this->projectBriefProposalService->findOrFail($wfMaster->ref_table_id);
        $projectProposal->update(['status' => 'CLOSED']);
    }

    public function getWfMasterBy($data)
    {
        return $this->workflowMasterService->findBy($data)->first();
    }
}
