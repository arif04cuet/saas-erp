<?php

namespace Modules\PMS\Http\Controllers;

use function Matrix\trace;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Models\NotificationInfo;
use App\Constants\WorkflowStatus;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Constants\NotificationType;
use Illuminate\Support\Facades\Auth;
use Modules\PMS\Services\PMSService;
use Modules\HRM\Entities\Designation;
use App\Events\NotificationGeneration;
use App\Services\Remark\RemarkService;
use App\Constants\DesignationShortName;
use Illuminate\Support\Facades\Session;
use App\Services\workflow\FeatureService;
use Modules\HRM\Services\EmployeeService;
use App\Services\workflow\WorkflowService;
use App\Services\Sharing\ShareRulesService;
use Modules\PMS\Http\Requests\ReviewRequest;
use Modules\PMS\Services\ProjectRequestService;
use Modules\PMS\Services\ProjectProposalService;
use App\Services\Notification\ReviewUrlGenerator;
use App\Services\Sharing\ShareConversationService;
use App\Services\workflow\DashboardWorkflowService;
use Modules\PMS\Services\ProjectProposalReviewerAttachmentService;
use Modules\PMS\Http\Requests\CreateProposalSubmissionAttachmentRequest;


class PMSController extends Controller
{
    private $dashboardService;
    private $workflowService;
    private $remarksService;
    private $featureService;
    private $userService;
    private $shareRuleService;
    private $shareConversationService;
    private $employeeService;
    private $projectProposalReviewerAttachmentService;
    private $pmsService;

    /**
     * @var ProjectProposalService
     */
    private $projectProposalService;
    /**
     * @var ProjectRequestService
     */
    private $projectRequestService;
    /**
     * @var ReviewUrlGenerator
     */
    private $reviewUrlGenerator;

    /**
     * PMSController constructor.
     * @param DashboardWorkflowService $dashboardService
     * @param ProjectProposalService $projectProposalService
     * @param WorkflowService $workflowService
     * @param RemarkService $remarksService
     * @param FeatureService $featureService
     * @param ProjectRequestService $projectRequestService
     * @param UserService $userService
     * @param ShareRulesService $shareRuleService
     * @param ShareConversationService $shareConversationService
     * @param EmployeeService $employeeService
     * @param ReviewUrlGenerator $reviewUrlGenerator
     * @param ProjectProposalReviewerAttachmentService $projectProposalReviewerAttachmentService
     */
    public function __construct(
        DashboardWorkflowService $dashboardService,
        ProjectProposalService $projectProposalService,
        WorkflowService $workflowService,
        RemarkService $remarksService,
        FeatureService $featureService,
        ProjectRequestService $projectRequestService,
        UserService $userService,
        ShareRulesService $shareRuleService,
        ShareConversationService $shareConversationService,
        EmployeeService $employeeService,
        ReviewUrlGenerator $reviewUrlGenerator,
        ProjectProposalReviewerAttachmentService $projectProposalReviewerAttachmentService,
        PMSService $pmsService
    ) {
        $this->dashboardService = $dashboardService;
        $this->projectRequestService = $projectRequestService;
        $this->projectProposalService = $projectProposalService;
        $this->workflowService = $workflowService;
        $this->remarksService = $remarksService;
        $this->featureService = $featureService;
        $this->userService = $userService;
        $this->shareRuleService = $shareRuleService;
        $this->shareConversationService = $shareConversationService;
        $this->employeeService = $employeeService;
        $this->projectProposalReviewerAttachmentService = $projectProposalReviewerAttachmentService;
        $this->reviewUrlGenerator = $reviewUrlGenerator;
        $this->pmsService = $pmsService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $chartData = $this->projectProposalService->getProjectProposalByStatus();
        $invitations = $this->projectRequestService->getProjectInvitationByDeadline();
        $proposals = $this->projectProposalService->getProjectProposalBySubmissionDate();
        $pendingTasks = $this->pmsService->getPendingTasks();
        $rejectedTasks = $this->pmsService->getRejectedTasks();
        $shareConversations = $this->pmsService->getShareConversations();
        if (Auth::user()->user_type == 'Employee') {
            $employee = $this->employeeService->findOne(Auth::user()->reference_table_id);
            $bulkAction = in_array($employee->designation->short_name, [DesignationShortName::DG]);
        } else {
            $bulkAction = false;
        }

        return view('pms::index', compact('pendingTasks', 'rejectedTasks', 'chartData', 'invitations',
            'proposals', 'shareConversations', 'bulkAction'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('pms::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('pms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('pms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    // Methods implemented for integrating workflow
    public function review($proposalId, $wfMasterId, $wfConvId, $feature_id, $ruleDetailsId, $viewOnly = 0)
    {
        $proposal = $this->projectProposalService->findOrFail($proposalId);
        $wfData = ['wfMasterId' => $wfMasterId, 'wfConvId' => $wfConvId];
        $remarks = $this->remarksService->findBy(['feature_id' => $feature_id, 'ref_table_id' => $proposal->id]);
        $ruleDetails = $this->workflowService->getRuleDetailsByRuleId($ruleDetailsId);

        $ruleDesignations = [];
        if ($ruleDetails->is_shareable) {
            $shareRule = $this->shareRuleService->findOne($ruleDetails->share_rule_id);
            if ($this->userService->isProjectDivisionUser(Auth::user())) {
                $ruleDesignations = $shareRule->rulesDesignation->where('designation_id', '!=',
                Auth::user()->employee->designation_id);
            } else {
                $ruleDesignations = $shareRule->rulesDesignation->where('designation_id', 160);
            }

            $wfConversation = $this->workflowService->getWorkflowConversationById($wfConvId);
            $wfDetailsId = $wfConversation->workflow_details_id;
        } else {
            $shareRule = [];
            $wfDetailsId = 0;
        };
        $authDesignation = $this->userService->getDesignationId(Auth::user()->username);
        $reviewer = $this->workflowService->getActiveWorkflowByWFMasterId($wfMasterId);
        // $isValidUser = is_null($reviewer) ? false : ($authDesignation == $reviewer->designation_id) ? true : false;
        if(is_null($reviewer)){
            $isValidUser = false;
        }elseif($authDesignation == $reviewer->designation_id){
            $isValidUser = true;
        }else{
            $isValidUser = false;
        }

        return view('pms::proposal-submitted.brief.review.review', compact('proposal', 'wfData', 'remarks', 'ruleDetails', 'ruleDesignations', 'shareRule', 'feature_id', 'wfDetailsId', 'authDesignation', 'isValidUser'));
    }

    public function reviewUpdate($proposalId, ReviewRequest $request)
    {
        DB::transaction(function () use ($proposalId, $request) {
            $proposal = $this->projectProposalService->findOrFail($proposalId);
            if($request->input('status') == 'SHARE') return $this->share($request, $proposal);
            $activity = "Forwarded";
            $feature_name = config('constants.project_proposal_feature_name');
            $feature = $this->featureService->findBy(['name' => $feature_name])->first();

            if ($request->input('status') == 'CLOSED') {

                $activity = "Rejected";
                $this->remarksService->save($request->all());
                $this->workflowService->closeWorkflow($request->input('wf_master'));
                $proposal->update(['status' => 'REJECTED']);

                //return redirect(route('project-proposal-submitted-close', $request->input('wf_master')));
            } else {
                //$this->projectProposalService->update($proposal, ['status' => $request->input('status')]);
                if($request->input('status') == 'APPROVED') $activity = "Approved";
                $data = array(
                    'feature' => $feature_name,
                    'workflow_master_id' => $request->input('wf_master'),
                    'workflow_conversation_id' => $request->input('wf_conv'),
                    'status' => $request->input('status'),
                    'message' => $request->input('message'),
                    'remarks' => $request->input('remarks'),
                    'item_id' => $proposalId,
                );
                $this->dashboardService->updateDashboardItem($data);
            }
            //Generating notification
            $event = ($request->input('status') == 'REJECTED') ? 'project_proposal_send_back' : 'project_proposal_review';
            $notificationData =  ['ref_table_id' => $proposalId, 'status' => $activity, 'item_title' => $proposal->title];

            if($request->status == 'CLOSED') {
                $notificationData['user_id'] = $proposal->auth_user_id;
            }  else  {
                $notificationData['workflow_master_id'] = $request->input('wf_master');
            }
            $this->projectProposalService->generatePMSNotification(
                $notificationData,
                $event,
                ($request->status == 'CLOSED')? "#" : $this->reviewUrlGenerator->getReviewUrl('project-proposal-submitted-review', $feature, $proposal)
            );
            // Notification generation done
            // Session::flash('message', __('labels.update_success'));
        });

        return redirect()->route('pms');
    }

    public function resubmit($proposalId, $featureId)
    {
        $proposal = $this->projectProposalService->findOne($proposalId);

        return view('pms::proposal-submission.brief.resubmit', compact('proposal', 'featureId'));
    }

    public function storeResubmit($proposalId, Request $request)
    {
        $proposal = $this->projectProposalService->findOrFail($proposalId);

        $updateData = [
            'status' => 'PENDING',
            'title' => $request->input('title'),
            'attachments' => $request->file('attachments')
        ];

        $this->projectProposalService->updateProposal($proposal, $updateData);

        // Reinitialising Workflow
        $data = [
            'feature_id' => $request->input('feature_id'),
            'message' => $request->input('message'),
            'ref_table_id' => $proposalId
        ];
        $this->workflowService->reinitializeWorkflow($data);
        $wfMaster = $this->pmsService->getWfMasterBy([
            'feature_id' => $request->input('feature_id'),
            'ref_table_id' => $proposalId
        ]);
        $feature = $this->featureService->findBy(['id' => $request->input('feature_id')])->first();
        //Generating notification
        $this->projectProposalService->generatePMSNotification(
            [
                'ref_table_id' => $proposalId,
                'status' => WorkflowStatus::REINITIATED,
                'item_title' => $proposal->title,
                'workflow_master_id' => $wfMaster->id
            ],
            'project_proposal_submission',
            $this->reviewUrlGenerator->getReviewUrl(
                'project-proposal-submitted-review',
                $feature,
                $proposal
            )
        );
        // Notification generation done

        // Session::flash('message', __('labels.save_success'));

        return redirect(route('pms'));
    }

    public function close($wfMasterId)
    {
        $this->pmsService->closeProjectBriefProposalWorkflow($wfMasterId);
        Session::flash('message', __('labels.update_success'));

        return redirect(route('pms'));
    }

    public function approve($proposalId)
    {
        $proposal = $this->projectProposalService->findOne($proposalId);

        return view('pms::proposal-submitted.approve', compact('proposal'));
    }

    public function storeApprove($proposalId, Request $request)
    {
        //Generating notification
        //$this->projectProposalService->generatePMSNotification(['ref_table_id' => $proposalId, 'status' => $request->input('status'), 'activity_by' => 'APC'], 'project_proposal_apc_approved');
        // Notification generation done

        $proposal = $this->projectProposalService->findOrFail($proposalId);
        $data = [
            'status' => $request->input('status'),
        ];

        $this->projectProposalService->update($proposal, $data);
        Session::flash('message', __('labels.update_success'));

        return redirect(route('pms'));
    }

    // New methods for sharing project from workflow
    public function share(Request $request, $proposal)
    {
        $data = $request->all();
        unset($data['status']);
        $thisShareConv = $this->shareConversationService->shareFromWorkflow($data);
        //Generating notification
        $event = ($request->input('status') == 'REJECTED') ? 'project_proposal_send_back' : 'project_proposal_review';
        $this->projectProposalService->generatePMSNotification(
            [
                'ref_table_id' => $proposal->id,
                'status' => 'Forwarded',
                'designation_id' =>$data['designation_id'],
                'department_id' => $data['department_id'] ?? null,
                'item_title' => $proposal->title
            ],
            $event,
            route('sending-project-for-review', [$proposal->id, $thisShareConv->id])
        );
        // Notification generation done
        // Session::flash('message', trans('labels.save_success'));

        return redirect(route('pms'));
    }

    public function shareReview($projectProposalSubmissionId, $shareConversationId)
    {
        $shareConversation = $this->shareConversationService->findOne($shareConversationId);
        if (isset($shareConversation->shareRuleDesignation->sharable_id)) {
            $shareRule = $this->shareRuleService->findOne($shareConversation->shareRuleDesignation->sharable_id);
            $ruleDesignations = $shareRule->rulesDesignation;
        } else {
            $ruleDesignations = null;
        }
        $proposal = $this->projectProposalService->findOne($projectProposalSubmissionId);
        $featureName = config('constants.project_proposal_feature_name');
        $feature = $this->featureService->findBy(['name' => $featureName])->first();
        $remarks = $this->remarksService->findBy([
            'feature_id' => $feature->id,
            'ref_table_id' => $projectProposalSubmissionId
        ]);
        //$shareRuleDesignation = $this->shareConversationService;
        $authDesignation = $this->userService->getDesignationId(Auth::user()->username);
        $isValidUser = ($authDesignation == optional($shareConversation)->designation_id && $shareConversation->status == 'ACTIVE') ? true : false;

        return view('pms::proposal-submitted.brief.review.shareable-review', compact('proposal', 'feature',
            'remarks', 'projectProposalSubmissionId', 'shareConversationId', 'ruleDesignations', 'shareConversation',
            'authDesignation', 'isValidUser'));
    }

    public function shareFeedback(ReviewRequest $request, $shareConversationId)
    {
        DB::transaction(function () use($request, $shareConversationId) {
            $data = $request->all();
            $data['from_user_id'] = Auth::user()->id;
            $currentConv = $this->shareConversationService->findOne($shareConversationId);
            $proposal = $this->projectProposalService->findOrFail($data['ref_table_id']);
            $feature = $this->featureService->findOne($request->input('feature_id'));
            $activity = "Forwarded";
            $activeShareConvId = $shareConversationId;
            if ($request->status == WorkflowStatus::REVIEW) {
                $data['request_ref_id'] = $currentConv->request_ref_id;
                $savedShareConvcersatoin = $this->shareConversationService->saveShareConversation($data, $currentConv);
                $activeShareConvId = $savedShareConvcersatoin->id;
                $designation = Designation::where('id', $request->input('designation_id'))->first();
                if($designation->short_name == 'DIRP') $reviewURl = $this->reviewUrlGenerator->getReviewUrl('project-proposal-submitted-review', $feature, $proposal);
            }
            elseif ($request->status == WorkflowStatus::APPROVED){
                $activity = "Approved";
                $reviewURl = "#";
                $workflowDetail = $currentConv->workflowDetails;
                $this->remarksService->save($data);
                $this->workflowService->approveWorkflow($workflowDetail->workflow_master_id);
                $proposal->update(['status'=> 'APPROVED']);

            }
            elseif ($request->status == WorkflowStatus::REJECTED){
                $activity = "Rejected";
                $reviewURl = "#";
                $workflowDetail = $currentConv->workflowDetails;
                $this->remarksService->save($data);
                $this->workflowService->closeWorkflow($workflowDetail->workflow_master_id);
                $proposal->update(['status'=> 'REJECTED']);
            }
            $this->shareConversationService->updateConversation($data, $shareConversationId);

            //Generating notification
            $event = ($request->input('status') == 'REJECTED') ? 'project_proposal_send_back' : 'project_proposal_review';
            $notificationData = [
                'ref_table_id' => $proposal->id,
                'status' => $activity,
                'item_title' => $proposal->title
            ];
            if (in_array($request->input('status'), ['REJECTED', 'APPROVED'])) {
                $notificationData['user_id'] = $proposal->auth_user_id;
            }  else {
                $notificationData['designation_id'] = $data['designation_id'];
            }
            $notificationData['department_id'] = $data['department_id'];
            $url = (empty($reviewURl))? route('sending-project-for-review',[$proposal->id,$activeShareConvId]) : $reviewURl;

            $this->projectProposalService->generatePMSNotification(
                $notificationData,
                $event,
                $url
            );
            // Notification generation done
        });
      
        return redirect('/pms');
    }

    public function reviewBulk(Request $request)
    {
        $this->pmsService->bulkReviewFeedbackUpdate($request->all());
        Session::flash('message', trans('labels.save_success'));

        return redirect('/pms');
    }

    public function addAttachment(CreateProposalSubmissionAttachmentRequest $createProposalSubmissionAttachmentRequest)
    {
        $this->projectProposalReviewerAttachmentService->store($createProposalSubmissionAttachmentRequest->all());

        return redirect()->back();
    }
}
