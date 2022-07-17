<?php

namespace Modules\PMS\Http\Controllers;

use App\Constants\WorkflowStatus;
use App\Services\Notification\ReviewUrlGenerator;
use App\Services\Remark\RemarkService;
use App\Services\Sharing\ShareConversationService;
use App\Services\Sharing\ShareRulesService;
use App\Services\UserService;
use App\Services\workflow\DashboardWorkflowService;
use App\Services\workflow\FeatureService;
use App\Services\workflow\WorkflowService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\HRM\Entities\Designation;
use Modules\PMS\Http\Requests\CreateProjectProposalRequest;
use Modules\PMS\Http\Requests\CreateProposalSubmissionAttachmentRequest;
use Modules\PMS\Http\Requests\ReviewRequest;
use Modules\PMS\Services\ProjectDetailProposalService;
use Modules\PMS\Services\ProjectProposalDetailReviewerAttachmentService;
use Modules\PMS\Services\ProjectProposalReviewerAttachmentService;

class ProjectDetailsProposalController extends Controller
{
    private $projectDetailsProposalService;
    private $remarkService;
    private $workflowService;
    private $shareRuleService;
    private $userService;
    private $dashboardService;
    private $shareConversationService;
    private $featureService;
    private $projectProposalDetailReviewerAttachmentService;
    private $reviewUrlGenerator;


    public function __construct(
        ProjectDetailProposalService $projectDetailProposalService,
        RemarkService $remarkService,
        WorkflowService $workflowService,
        ShareRulesService $shareRuleService,
        UserService $userService,
        DashboardWorkflowService $dashboardService,
        ShareConversationService $shareConversationService,
        FeatureService $featureService,
        ProjectProposalDetailReviewerAttachmentService $projectProposalDetailReviewerAttachmentService,
        ReviewUrlGenerator $reviewUrlGenerator
    ) {
        $this->projectDetailsProposalService = $projectDetailProposalService;
        $this->remarkService = $remarkService;
        $this->workflowService = $workflowService;
        $this->shareRuleService = $shareRuleService;
        $this->userService = $userService;
        $this->dashboardService = $dashboardService;
        $this->shareConversationService = $shareConversationService;
        $this->featureService = $featureService;
        $this->projectProposalDetailReviewerAttachmentService = $projectProposalDetailReviewerAttachmentService;
        $this->reviewUrlGenerator = $reviewUrlGenerator;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $proposals = $this->projectDetailsProposalService->getProposalsForUser(Auth::user());
        $vmsTripExpenses = $this->projectDetailsProposalService->getTripExpenseForProjects($proposals->pluck('project_id')->toArray());
        return view('pms::proposal-submission.details.index', compact('proposals', 'vmsTripExpenses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($projectRequestId)
    {
        return view('pms::proposal-submission.details.create', compact('projectRequestId'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CreateProjectProposalRequest $request)
    {
        $projectDetailProposal = $this->projectDetailsProposalService->store($request->all());

        return $request->all()['to_budget'] ? redirect()->route('project-detail-proposal-budget.index',
            ['projectDetailProposal' => $projectDetailProposal->id]) : redirect()->route('pms');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('pms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('pms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /*
     * Functions related to Project Detail Proposal workflow
     */
    public function review($proposalId, $wfMasterId, $wfConvId, $feature_id, $ruleDetailsId, $viewOnly = 0)
    {
        $proposal = $this->projectDetailsProposalService->findOrFail($proposalId);
        $wfData = ['wfMasterId' => $wfMasterId, 'wfConvId' => $wfConvId];
        $remarks = $this->remarkService->findBy(['feature_id' => $feature_id, 'ref_table_id' => $proposal->id]);
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
        }
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

        // dd($ruleDesignations);
        return view('pms::proposal-submitted.detail.review.review', compact(
            'proposal',
            'wfData',
            'remarks',
            'ruleDetails',
            'ruleDesignations',
            'shareRule',
            'feature_id',
            'wfDetailsId',
            'authDesignation',
            'isValidUser'
        ));
    }

    public function reviewUpdate($proposalId, ReviewRequest $request)
    {
        $proposal = $this->projectDetailsProposalService->findOrFail($proposalId);
        if ($request->input('status') == 'SHARE') {
            return $this->share($request, $proposal);
        }   // Sending to share method if user shares an item instead of approval
        $activity = "Forwarded";
        $feature_name = config('constants.project_details_proposal_feature_name');
        $feature = $this->featureService->findBy(['name' => $feature_name])->first();
        if ($request->input('status') == 'CLOSED') {
            $activity = "Rejected";
            $this->workflowService->closeWorkflow($request->input('wf_master'));
            $this->remarkService->save($request->all());
            $proposal->update(['status' => 'REJECTED']);
        } else {
            //$this->projectProposalService->update($proposal, ['status' => $request->input('status')]);
            if ($request->input('status') == "APPROVED") {
                $activity = "Approved";
            }
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
        $notificationData = ['ref_table_id' => $proposalId, 'status' => $activity, 'item_title' => $proposal->title];
        if ($request->input('status') == 'CLOSED') {
            $notificationData['user_id'] = $proposal->auth_user_id;
        } else {
            $notificationData['workflow_master_id'] = $request->input('wf_master');
        }
        $this->projectDetailsProposalService->generatePMSNotification(
            $notificationData,
            $event,
            ($request->input('status') == 'CLOSED') ? "#" : $this->reviewUrlGenerator->getReviewUrl('project-details-proposal-submitted-review',
                $feature, $proposal)
        );
        // Notification generation done

        return redirect(route('pms'));
    }

    public function share(Request $request, $proposal)
    {
        $data = $request->all();
        unset($data['status']);
        $thisShareConv = $this->shareConversationService->shareFromWorkflow($data);
        //Generating notification
        $event = ($request->input('status') == 'REJECTED') ? 'project_proposal_send_back' : 'project_proposal_review';
        $this->projectDetailsProposalService->generatePMSNotification(
            [
                'ref_table_id' => $proposal->id,
                'status' => 'Forwarded',
                'designation_id' => $data['designation_id'],
                'item_title' => $proposal->title
            ],
            $event,
            route('sending-project-detail-for-review', [$proposal->id, $thisShareConv->id])
        );
        // Notification generation done
        Session::flash('message', trans('labels.save_success'));

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
        $proposal = $this->projectDetailsProposalService->findOne($projectProposalSubmissionId);
        $featureName = config('constants.project_details_proposal_feature_name');
        $feature = $this->featureService->findBy(['name' => $featureName])->first();
        $remarks = $this->remarkService->findBy([
            'feature_id' => $feature->id,
            'ref_table_id' => $projectProposalSubmissionId
        ]);
        //$shareRuleDesignation = $this->shareConversationService;
        $authDesignation = $this->userService->getDesignationId(Auth::user()->username);
        $isValidUser = ($authDesignation == $shareConversation->designation_id && $shareConversation->status == 'ACTIVE') ? true : false;

        return view('pms::proposal-submitted.detail.review.shareable-review', compact('proposal', 'feature',
            'remarks', 'projectProposalSubmissionId', 'shareConversationId', 'ruleDesignations', 'shareConversation',
            'authDesignation', 'isValidUser'));
    }

    public function shareFeedback(ReviewRequest $request, $shareConversationId)
    {
        $data = $request->all();
        $data['from_user_id'] = Auth::user()->id;
        $proposal = $this->projectDetailsProposalService->findOrFail($data['ref_table_id']);
        $currentConv = $this->shareConversationService->findOne($shareConversationId);
        $feature = $this->featureService->findOne($request->input('feature_id'));
        $activity = "Forwarded";
        $activeShareConId = $shareConversationId;
        if ($request->status == WorkflowStatus::REVIEW) {
            $data['request_ref_id'] = $currentConv->request_ref_id;
            $savedShareConversation = $this->shareConversationService->saveShareConversation($data, $currentConv);
            $activeShareConId = $savedShareConversation->id;
            $designation = Designation::where('id', $request->input('designation_id'))->first();
            if ($designation->short_name == 'DIRP') {
                $reviewURl = $this->reviewUrlGenerator->getReviewUrl('project-details-proposal-submitted-review',
                    $feature, $proposal);
            }
        } elseif ($request->status == WorkflowStatus::APPROVED) {
            $activity = "Approved";
            $reviewURl = "#";
            $workflowDetail = $currentConv->workflowDetails;
            $this->workflowService->approveWorkflow($workflowDetail->workflow_master_id);
            $proposal->update(['status' => 'APPROVED']);
            $this->remarkService->save($data);
        } elseif ($request->status == WorkflowStatus::REJECTED) {
            $activity = "Rejected";
            $reviewURl = "#";
            $workflowDetail = $currentConv->workflowDetails;
            $this->workflowService->closeWorkflow($workflowDetail->workflow_master_id);
            $proposal->update(['status' => 'REJECTED']);
            $this->remarkService->save($data);
        }
        $this->shareConversationService->updateConversation($data, $shareConversationId);
        //Generating notification
        $event = ($request->input('status') == 'REJECTED') ? 'project_proposal_send_back' : 'project_proposal_review';
        $notificationData = ['ref_table_id' => $proposal->id, 'status' => $activity, 'item_title' => $proposal->title];
        if (in_array($request->input('status'), ['REJECTED', 'APPROVED'])) {
            $notificationData['user_id'] = $proposal->auth_user_id;
        } else {
            $notificationData['designation_id'] = $data['designation_id'];
        }
        $url = (empty($reviewURl)) ? route('sending-project-detail-for-review',
            [$proposal->id, $activeShareConId]) : $reviewURl;
        $this->projectDetailsProposalService->generatePMSNotification(
            $notificationData,
            $event,
            $url
        );
        // Notification generation done

        return redirect('/pms');
    }

    public function addAttachment(CreateProposalSubmissionAttachmentRequest $createProposalSubmissionAttachmentRequest)
    {
        $this->projectProposalDetailReviewerAttachmentService->store($createProposalSubmissionAttachmentRequest->all());

        return redirect()->back();
    }

    public function close($wfMasterId)
    {
        $this->projectDetailsProposalService->closeProjectDetailProposalWorkflow($wfMasterId);
        Session::flash('message', __('labels.update_success'));

        return redirect(route('pms'));
    }

    public function resubmit($proposalId, $featureId)
    {
        $proposal = $this->projectDetailsProposalService->findOne($proposalId);

        return view('pms::proposal-submission.details.resubmit', compact('proposal', 'featureId'));
    }

    public function storeResubmit($proposalId, Request $request)
    {
        $proposal = $this->projectDetailsProposalService->findOrFail($proposalId);
        $updateData = [
            'status' => 'PENDING',
            'title' => $request->input('title')
        ];
        $this->projectDetailsProposalService->update($proposal, $updateData);

        // Reinitialising Workflow
        $data = [
            'feature_id' => $request->input('feature_id'),
            'message' => $request->input('message'),
            'ref_table_id' => $proposalId
        ];
        $this->workflowService->reinitializeWorkflow($data);
        $wfMaster = $this->projectDetailsProposalService->getWfMasterBy([
            'feature_id' => $request->input('feature_id'),
            'ref_table_id' => $request->input('ref_table_id')
        ]);
        $feature = $this->featureService->findBy(['id' => $request->input('feature_id')])->first();
        //Generating notification
        $this->projectDetailsProposalService->generatePMSNotification(
            [
                'ref_table_id' => $proposalId,
                'status' => WorkflowStatus::REINITIATED,
                'item_title' => $proposal->title,
                'workflow_master_id' => $wfMaster->id
            ],
            'project_proposal_submission',
            $this->reviewUrlGenerator->getReviewUrl(
                'project-details-proposal-submitted-review',
                $feature,
                $proposal
            )
        );
        // Notification generation done

        Session::flash('message', __('labels.save_success'));

        return redirect(route('pms'));
    }

}
