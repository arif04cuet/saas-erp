<?php

namespace Modules\RMS\Http\Controllers;

use App\Constants\DesignationShortName;
use App\Constants\WorkflowStatus;
use App\Services\Remark\RemarkService;
use App\Services\Sharing\ShareConversationService;
use App\Services\Sharing\ShareRulesService;
use App\Services\UserService;
use App\Services\workflow\DashboardWorkflowService;
use App\Services\workflow\FeatureService;
use App\Services\workflow\WorkflowService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Modules\HRM\Services\DesignationService;
use Modules\HRM\Services\EmployeeService;
use Modules\RMS\Entities\ResearchDetailSubmission;
use Modules\RMS\Entities\ResearchDetailSubmissionAttachment;
use Modules\RMS\Http\Requests\CreateProposalSubmissionAttachmentRequest;
use Modules\RMS\Http\Requests\PostResearchBriefFeedbackRequest;
use Modules\RMS\Http\Requests\UpdateReviewDetail;
use Modules\RMS\Services\ResearchDetailSubmissionService;
use Modules\RMS\Services\ResearchProposalDetailReviewerAttachmentService;
use mysql_xdevapi\CrudOperationBindable;

class ResearchProposalDetailController extends Controller
{

    /**
     * @var ResearchDetailSubmissionService
     */
    private $researchDetailSubmissionService;

    /**
     * ResearchProposalDetailController constructor.
     * @param ResearchDetailSubmissionService $researchDetailSubmissionService
     */
    private $employeeService;
    private $featureService;
    private $remarksService;
    private $workflowService;
    private $shareRuleService;
    private $shareConversationService;
    private $dashboardWorkflowService;
    private $researchProposalDetailReviewerAttachmentService;
    private $designationService;
    private $userService;

    public function __construct(ResearchDetailSubmissionService $researchDetailSubmissionService,
                                EmployeeService $employeeService, FeatureService $featureService, RemarkService $remarkService,
                                WorkflowService $workflowService, ShareRulesService $shareRulesService,
                                ShareConversationService $shareConversationService, DashboardWorkflowService $dashboardWorkflowService,
                                ResearchProposalDetailReviewerAttachmentService $researchProposalDetailReviewerAttachmentService,
                                DesignationService $designationService, UserService $userService
    )
    {
        $this->employeeService = $employeeService;
        $this->featureService = $featureService;
        $this->researchDetailSubmissionService = $researchDetailSubmissionService;
        $this->remarksService = $remarkService;
        $this->workflowService = $workflowService;
        $this->shareRuleService = $shareRulesService;
        $this->shareConversationService = $shareConversationService;
        $this->dashboardWorkflowService = $dashboardWorkflowService;
        $this->researchProposalDetailReviewerAttachmentService = $researchProposalDetailReviewerAttachmentService;
        $this->designationService = $designationService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $researchDetails = $this->researchDetailSubmissionService->getResearchDetailProposalForUser(Auth::user());
        return view('rms::research-details.index', compact('researchDetails'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($researchDetailInvitationId)
    {

        return view('rms::research-details.create', compact('researchDetailInvitationId'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $divisionalDirector = $this->employeeService->getDivisionalDirectorByDepartmentId(Auth::user()->employee->department_id);
//        dd($divisionalDirector);
        if (is_null($divisionalDirector)) {
            Session::flash('error', 'Your divisional director is not defined');
            return redirect()->back();
        }
        $this->researchDetailSubmissionService->storeResearchDetails($request->all(), $divisionalDirector);
        return redirect()->route('research.list');
    }

    public function review($researchProposalDetailId, $featureName, $workflowMasterId, $workflowConversationId, $workflowRuleDetailsId, $viewOny = 0)
    {
//dd($workflowRuleDetailsId);
        $researchDetail = $this->researchDetailSubmissionService->findOne($researchProposalDetailId);

        $researchDetailInvitation = $researchDetail->researchDetailInvitation;

//        $organizations = $researchDetail->organizations;
        $featureName = config('rms.research_proposal_detail_feature');;

        $feature = $this->featureService->findBy(['name' => $featureName])->first();
        $remarks = $this->remarksService->findBy(['feature_id' => $feature->id, 'ref_table_id' => $researchProposalDetailId]);

        $workflowRuleDetails = $this->workflowService->getRuleDetailsByRuleId($workflowRuleDetailsId);

        $workflowRuleMaster = $workflowRuleDetails->ruleMaster;

        if ($workflowRuleDetails->flow_type == 'review') {
            $approveButton = false;
        } else {
            $approveButton = true;
        }

        $ruleDesignations = [];
        if ($workflowRuleDetails->is_shareable) {
            $shareRule = $this->shareRuleService->findOne($workflowRuleDetails->share_rule_id);
            if ($this->researchDetailSubmissionService->isProposalSubmitFromResearchDept()) {
                $ruleDesignations = $shareRule->rulesDesignation->where('designation_id', '!=',
                Auth::user()->employee->designation_id);
             } else {
                $ruleDesignations = $shareRule->rulesDesignation->where('designation_id', 160);
             }
        } else {
            $ruleDesignations = null;
        }

        $authDesignation = $this->userService->getDesignationId(Auth::user()->username);
        $reviewer = $this->workflowService->getActiveWorkflowByWFMasterId($workflowMasterId);
        $isValidUser = is_null($reviewer)? false : ($authDesignation == $reviewer->designation_id) ? true : false;

        return view('rms::research-details.review.show', compact('researchProposalDetailId', 'researchDetail',
            'featureName', 'workflowMasterId', 'workflowConversationId', 'remarks', 'workflowRuleMaster',
            'workflowRuleDetails', 'ruleDesignations', 'feature', 'approveButton', 'researchDetailInvitation', 'isValidUser'));

    }

    public function reviewUpdate(UpdateReviewDetail $request)
    {

        if ($request->status == WorkflowStatus::REVIEW) {
            $shareConversation = $this->shareConversationService->shareFromWorkflow($request->all());
            $this->researchDetailSubmissionService->sendNotification($request, $shareConversation->id);
        } else {
//            $research = $this->researchDetailSubmissionService->findOrFail($request->input('item_id'));
            $data = $request->except('_token');
            $this->dashboardWorkflowService->updateDashboardItem($data);
            // Send Notifications

            $this->researchDetailSubmissionService->sendNotification($request);

        }

        return redirect('/rms');
    }

    public function getResearchDetailFeedbackForm($researchProposalDetailId, $workflowMasterId, $shareConversationId)
    {
        $shareConversation = $this->shareConversationService->findOne($shareConversationId);

        if (isset($shareConversation->shareRuleDesignation->sharable_id)) {
            $shareRule = $this->shareRuleService->findOne($shareConversation->shareRuleDesignation->sharable_id);
            if ($this->researchDetailSubmissionService->isProposalSubmitFromResearchDept()) {
                $ruleDesignations = $shareRule->rulesDesignation->where('designation_id', '!=',
                Auth::user()->employee->designation_id);
             } else {
                $ruleDesignations = $shareRule->rulesDesignation->where('designation_id', 160);
             }
        } else {
            $ruleDesignations = [];
        }

        $researchDetail = $this->researchDetailSubmissionService->findOne($researchProposalDetailId);
        $featureName = config('rms.research_proposal_detail_feature');
        $feature = $this->featureService->findBy(['name' => $featureName])->first();
        $remarks = $this->remarksService->findBy(['feature_id' => $feature->id, 'ref_table_id' => $researchProposalDetailId]);
        $authDesignation = $this->userService->getDesignationId(Auth::user()->username);
        $isValidUser = ($authDesignation == $shareConversation->designation_id && $shareConversation->status == 'ACTIVE') ? true : false;
        return view('rms::research-details.review.share-review', compact('researchDetail', 'feature',
            'remarks', 'researchProposalDetailId', 'workflowMasterId', 'shareConversationId', 'ruleDesignations', 'shareConversation', 'isValidUser'));
    }

    public function postResearchDetailFeedback(PostResearchBriefFeedbackRequest $request, $shareConversationId)
    {

        $data = $request->all();
        $data['from_user_id'] = Auth::user()->id;

        $currentConv = $this->shareConversationService->findOne($shareConversationId);


        $toUsers = null;
        $shareConversationIdForNotification = $shareConversationId;
        if ($request->status == WorkflowStatus::REVIEW) {
            $data['request_ref_id'] = $currentConv->request_ref_id;
            $shareConversation = $this->shareConversationService->saveShareConversation($data, $currentConv);
            $shareConversationIdForNotification = $shareConversation->id;
        }

        if ($request->status == WorkflowStatus::APPROVED) {
            $workflowDetail = $currentConv->workflowDetails;
            $this->workflowService->approveWorkflow($workflowDetail->workflow_master_id);
            $researchDetail = $this->researchDetailSubmissionService->findOrFail($request->input('ref_table_id'));
            $this->researchDetailSubmissionService->update($researchDetail, ['status' => 'APPROVED']);

            //will use in sendNotification->notification generator
            $designation = $this->designationService->getDesignationByShortCode([DesignationShortName::DIRR])->first();
            $toUsers = [$researchDetail->user];
            if (isset($designation->user) && count($designation->user) > 0) {
                array_push($toUsers, $designation->user->first());
            }
        }

        $this->shareConversationService->updateConversation($data, $shareConversationId);
        $this->researchDetailSubmissionService->sendNotification($request, $shareConversationIdForNotification, $toUsers);
        return redirect('/rms');
    }

    public function reInitiate($researchDetailSubmissionId)
    {
        $username = Auth::user()->username;
        $name = Auth::user()->name;
        $auth_user_id = Auth::user()->id;
        $researchDetail = $this->researchDetailSubmissionService->findOne($researchDetailSubmissionId);
        return view('rms::research-details.reinitiate.research-detail-re-initiate', compact('researchDetail', 'name', 'auth_user_id'));
    }

    public function storeInitiate(Request $request, $researchDetailId)
    {
        $response = $this->researchDetailSubmissionService->updateReInitiate($request->all(), $researchDetailId);
        Session::flash('success', $response->getContent());
        return redirect()->route('rms.index');
    }

    public function closeWorkflowByReviewer($workflowMasterId, $researchDetailId, $shareConversationId = null)
    {

        $researchDetail = $this->researchDetailSubmissionService->findOne($researchDetailId);
        $researchDetail->update(['status' => 'REJECTED']);
        if (!is_null($shareConversationId)) {
            $this->shareConversationService->updateConversation([], $shareConversationId);
        }
//        $this->workflowService->closeWorkflow($workflowMasterId);
        $this->researchDetailSubmissionService->closeWorkflow($workflowMasterId, $researchDetail, 'CLOSED_BY_REVIEWER');

        Session::flash('success', trans('labels.save_success'));
        return redirect('/rms');
    }

    public function closeWorkflowByInitiator($workflowMasterId, $researchDetailId)
    {
        $proposal = $this->researchDetailSubmissionService->findOne($researchDetailId);
        $proposal->update(['status' => 'CLOSED']);
//        $this->workflowService->closeWorkflow($workflowMasterId);
        $this->researchDetailSubmissionService->closeWorkflow($workflowMasterId, $proposal, 'CLOSED_BY_OWNER');
        Session::flash('success', trans('labels.save_success'));
        return redirect('/rms');

    }


    public function attachmentDownload(ResearchDetailSubmission $researchDetailSubmission)
    {
        return response()->download($this->researchDetailSubmissionService->getZipFilePath($researchDetailSubmission));
    }

    public function fileDownload($attachmentId)
    {

        $researchDetailSubmission = ResearchDetailSubmissionAttachment::findOrFail($attachmentId);

        $basePath = Storage::disk('internal')->path($researchDetailSubmission->attachments);
        return response()->download($basePath);
    }

    public function addAttachment(CreateProposalSubmissionAttachmentRequest $createProposalSubmissionAttachmentRequest)
    {
        $this->researchProposalDetailReviewerAttachmentService->store($createProposalSubmissionAttachmentRequest->all());

        return redirect()->back();
    }
}
