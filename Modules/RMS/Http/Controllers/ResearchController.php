<?php

namespace Modules\RMS\Http\Controllers;

use App\Constants\DesignationShortName;
use App\Constants\WorkflowStatus;
use App\Services\Notification\ReviewUrlGenerator;
use App\Services\Remark\RemarkService;
use App\Services\Sharing\ShareConversationService;
use App\Services\Sharing\ShareRulesService;
use App\Services\TaskService;
use App\Services\UserService;
use App\Services\workflow\DashboardWorkflowService;
use App\Services\workflow\FeatureService;
use App\Services\workflow\WorkflowService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Services\EmployeeService;
use Modules\Publication\Services\PublicationRequestService;
use Modules\RMS\Entities\Research;
use Modules\RMS\Http\Requests\CreateResearchRequest;
use Modules\RMS\Http\Requests\CreateReviewRequest;
use Modules\RMS\Http\Requests\PostResearchBriefFeedbackRequest;
use Modules\RMS\Http\Requests\PublicationReviewRequest;
use Modules\RMS\Services\ResearchDetailSubmissionService;
use Modules\RMS\Services\ResearchService;
use Prophecy\Doubler\Generator\TypeHintReference;

/**
 * @property  userService
 * @property  researchService
 */
class ResearchController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;
    private $researchService;
    /**
     * @var TaskService
     */
    private $taskService;
    private $remarksService;
    private $dashboardWorkflowService;
    private $featureService;
    private $researchDetailSubmissionService;
    private $workflowService;
    private $shareRuleService;
    private $employeeService;
    private $shareConversationService;
    private $reviewUrlGenerator;

    /**
     * @var PublicationReviewRequest
     */
    private $publicationRequestService;

    /**
     * ResearchController constructor.
     * @param UserService $userService
     * @param ResearchService $researchService
     * @param TaskService $taskService
     * @param RemarkService $remarkService
     * @param DashboardWorkflowService $dashboardWorkflowService ;
     * @param FeatureService $featureService ;
     */
    public function __construct(
        UserService $userService,
        ResearchService $researchService,
        TaskService $taskService,
        RemarkService $remarkService,
        DashboardWorkflowService $dashboardWorkflowService,
        FeatureService $featureService,
        ResearchDetailSubmissionService $researchDetailSubmissionService,
        WorkflowService $workflowService,
        ShareRulesService $shareRuleService,
        EmployeeService $employeeService,
        ShareConversationService $shareConversationService,
        ReviewUrlGenerator $reviewUrlGenerator,
        PublicationRequestService $publicationRequestService
    ) {

        $this->userService = $userService;
        $this->researchService = $researchService;
        $this->taskService = $taskService;
        $this->remarksService = $remarkService;
        $this->dashboardWorkflowService = $dashboardWorkflowService;
        $this->featureService = $featureService;
        $this->researchDetailSubmissionService = $researchDetailSubmissionService;
        $this->workflowService = $workflowService;
        $this->shareRuleService = $shareRuleService;
        $this->employeeService = $employeeService;
        $this->shareConversationService = $shareConversationService;
        $this->reviewUrlGenerator = $reviewUrlGenerator;
        $this->publicationRequestService = $publicationRequestService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $researches = $this->researchService->getResearchesForUser(Auth::user());
        return view('rms::research.index', compact('researches'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $username = Auth::user()->username;
        $name = Auth::user()->name;
        $auth_user_id = Auth::user()->id;
        $departmentName = $this->userService->getDepartmentName($username);
        $designation = $this->userService->getDesignation($username);
        $proposals = $this->researchDetailSubmissionService->getRemainingApprovedDetailProposal();

        return view('rms::research.create', compact('auth_user_id', 'name', 'designation', 'departmentName', 'proposals'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateResearchRequest $request)
    {
        $research = $this->researchService->store($request->all());

        foreach (Config::get('default-values.tasks') as $task) {
            $this->taskService->store($research, $task);
        }

        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('research.index');
    }

    /**
     * Show the specified resource.
     * @param Research $research
     * @return Response
     */
    public function show(Research $research)
    {
        $ganttChart = $this->taskService->getTasksGanttChartData($research->tasks);
        $isCreator = (Auth::user()->id == $research->submitted_by) ? true : false;
        return view('rms::research.show', compact('research', 'ganttChart', 'isCreator'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('rms::edit');
    }

    public function review($researchId, $featureId, $workflowMasterId, $workflowConversationId, $ruleDetailsId)
    {
        $research = $this->researchService->findOne($researchId);
        $remarks = $this->remarksService->findBy(['feature_id' => $featureId, 'ref_table_id' => $researchId]);
        $feature = $this->featureService->findOne($featureId);
        $ruleDetails = $this->workflowService->getRuleDetailsByRuleId($ruleDetailsId);

        if ($ruleDetails->is_shareable) {
            //$shareRule = $this->shareRuleService->findOne($ruleDetails->share_rule_id);
            $ruleDesignations =  $this->employeeService->getEmployeesForDropdown(function ($employee) {
                $designation = !is_null($employee->designation) ? $employee->designation->name : 'No Designation';
                return $employee->first_name . ' ' . $employee->last_name . ' - ' . $designation . ' - ' . $employee->employeeDepartment->name;
            });
            $wfConversation = $this->workflowService->getWorkflowConversationById($workflowConversationId);
            $wfDetailsId = $wfConversation->workflow_details_id;
        } else {
            $ruleDesignations = [];
            $wfDetailsId = 0;
        };
        $authDesignation = $this->userService->getDesignationId(Auth::user()->username);
        $reviewer = $this->workflowService->getActiveWorkflowByWFMasterId($workflowMasterId);
        $isValidUser = is_null($reviewer) ? false : ($authDesignation == $reviewer->designation_id) ? true : false;

        return view('rms::research.review.show', compact('researchId', 'research', 'feature', 'featureId', 'workflowMasterId', 'workflowConversationId', 'remarks', 'ruleDetails', 'ruleDesignations', 'isValidUser'));
    }

    public function reviewUpdate(PublicationReviewRequest $request)
    {
        if (!empty($request->input('employee_id'))) {
            $employeeDesignation = $this->employeeService->findOne($request->input('employee_id'));
            $designationId = $employeeDesignation->designation_id;
            $request->merge(['designation_id' => $designationId]);
        }
        if ($request->input('status') == "SHARE") return $this->share($request);

        $research = $this->researchService->findOrFail($request->input('item_id'));
        //$this->researchService->update($research, ['status' => $request->input('status')]);
        $data = $request->except('_token');
        $this->dashboardWorkflowService->updateDashboardItem($data);

//        Send Notifications
        // $this->researchService->generatePublicationNotification(
        //     [
        //         'ref_table_id' => $research->id,
        //         'status' => $request->input('status'),
        //         'item_title' => $research->title,
        //         'designation_id' => $research->submitted_by
        //     ],
        //     null,
        //     '#'
        // );
//        $this->researchService->sendNotification($request);
        //Send user to research dashboard
        Session::flash('message', trans('labels.save_success'));
        return redirect('/rms');
    }

    public function share(Request $request)
    {
        $data = $request->all();
        unset($data['status']);
        $savedConv = $this->shareConversationService->shareFromWorkflow($data);
        // Generate Notification for share review
        $research = $this->researchService->findOne($request->input('item_id'));
        $url = route('research.review', [$research->id, $request->workflow_master_id, $savedConv->id]);
        $this->researchService->generatePublicationNotification(
            [
                'ref_table_id' => $research->id,
                'status' => 'REVIEW',
                'item_title' => $research->title,
                'designation_id' => $request->designation_id
            ],
            null,
            $url
        );
        Session::flash('message', trans('labels.save_success'));

        return redirect(route('rms.index'));
    }

    public function shareReview($researchId, $workflowMasterId, $shareConversationId)
    {
        $shareConversation = $this->shareConversationService->findOne($shareConversationId);
        if (isset($shareConversation->shareRuleDesignation->sharable_id)) {
            $shareRule = $this->shareRuleService->findOne($shareConversation->shareRuleDesignation->sharable_id);
            $ruleDesignations = $shareRule->rulesDesignation;
            //dd($ruleDesignations);
        } else {
            $ruleDesignations = null;
        }
        $research = $this->researchService->findOne($researchId);
        $featureName = Config::get('rms.research_feature_name');
        $feature = $this->featureService->findBy(['name' => $featureName])->first();
        $remarks = $this->remarksService->findBy(['feature_id' => $feature->id, 'ref_table_id' => $researchId]);

        $authDesignation = $this->userService->getDesignationId(Auth::user()->username);
        $isValidUser = ($authDesignation == $shareConversation->designation_id && $shareConversation->status == 'ACTIVE') ? true : false;

        return view('rms::research.review.shareable-review', compact(
            'research',
            'feature',
            'remarks',
            'researchId',
            'workflowMasterId',
            'shareConversationId',
            'ruleDesignations',
            'shareConversation',
            'isValidUser'
        ));
    }

    public function shareFeedback(CreateReviewRequest $request, $shareConversationId)
    {
        $data = $request->all();
        $data['from_user_id'] = Auth::user()->id;
        $currentConv = $this->shareConversationService->findOne($shareConversationId);
        $designation_id = null;
        $to_user = null;
        $url = "#";
        $research = $this->researchService->findOrFail($request->input('ref_table_id'));
        $feature = $this->featureService->findOne($request->feature_id);

        if ($request->status == WorkflowStatus::REVIEW) {
            $data['request_ref_id'] = $currentConv->request_ref_id;
            $savedConversation = $this->shareConversationService->saveShareConversation($data, $currentConv);
            $designation_id = $request->designation_id;
            $recipient = $this->userService->getUserByDesignationId($designation_id);
            if ($recipient[0]->employee->designation->short_name == DesignationShortName::DIRR)
                $url = $this->reviewUrlGenerator->getResearchReviewUrl('research-publication.review', $feature, $research);
            else
                $url = route('research.review', [$research->id, $request->workflow_master_id, $savedConversation->id]);
        }
        if ($request->status == WorkflowStatus::APPROVED) {
            $workflowDetail = $currentConv->workflowDetails;
            $this->workflowService->approveWorkflow($workflowDetail->workflow_master_id);
            $this->researchService->update($research, ['status' => 'APPROVED']);
            $to_user = $this->userService->findOne($research->submitted_by);
        }
        $notificationData = ['ref_table_id' => $research->id, 'status' => $request->status, 'item_title' => $research->title];
        if (!is_null($designation_id)) $notificationData['designation_id'] = $designation_id;
        if (!is_null($to_user)) $notificationData['to_users'] = [$to_user];
        $this->researchService->generatePublicationNotification($notificationData, null, $url);

        $this->shareConversationService->updateConversation($data, $shareConversationId);
        Session::flash('success', trans('labels.save_success'));
        return redirect('/rms');
    }

    public function createPublication($researchId)
    {
        $research = $this->researchService->findOne($researchId);
        $isCreator = (Auth::user()->id == $research->submitted_by) ? true : false;
        if ($isCreator)
            return view('rms::research.create-publication', compact('research'));
        else {
            Session::flash('error', 'You are not permitted to create publication');
            return redirect()->back();
        }
    }

    public function storePublication(Request $request, $researchId)
    {

        $save = $this->researchService->savePublication($request->all(), $researchId);
        Session::flash('success', trans('labels.save_success'));

        return redirect(route('research.show', $researchId));
    }

    public function reInitiate($researchId)
    {
        $username = Auth::user()->username;
        $name = Auth::user()->name;
        $auth_user_id = Auth::user()->id;
        $research = $this->researchService->findOne($researchId);
        $publication = $research->publication;

        return view('rms::research.re-initiate.re_initiate_research', compact('research', 'name', 'auth_user_id', 'publication'));
    }

    public function storeReInitiate(Request $request, $publicationId)
    {

        //      publication update
        $this->researchService->updatePublicationForReInitialize($request->all(), $publicationId);

        //      Reinitialize research
        $proposal = $this->researchService->findOne($request->research_id);
        $proposal->update(['status' => WorkflowStatus::REINITIATED]);

        //      Reinitialize Workflow
        $response = $this->researchService->updateReInitiate($request->all(), $request->research_id);

        Session::flash('success', $response->getContent());
        return redirect()->route('rms.index');
    }

    public function closeWorkflowByReviewer($workflowMasterId, $researchId)
    {

        $proposal = $this->researchService->findOne($researchId);
        $proposal->update(['status' => WorkflowStatus::CLOSED]);
        $response = $this->researchService->closeWorkflow($workflowMasterId);
        $this->researchService->generatePublicationNotification(
            [
                'ref_table_id' => $proposal->id,
                'status' => 'REJECTED',
                'item_title' => $proposal->title,
                'designation_id' => $proposal->submitted_by
            ],
            null,
            '#'
        );

        Session::flash('success', $response->getContent());
        return redirect()->route('rms.index');
    }

    public function sendResearchForPublish($id): \Illuminate\Http\RedirectResponse
    {
        $data = [
            'research_id' => $id,
            'status' => 'pending'
        ];
        $publicationRequest = $this->publicationRequestService->save($data);
        $this->publicationRequestService->createPublicationRequestNotification($publicationRequest);
        return redirect()->back()->with('success', trans('rms::research_proposal.request_success'));
    }
}
