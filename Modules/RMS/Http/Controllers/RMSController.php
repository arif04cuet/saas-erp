<?php

namespace Modules\RMS\Http\Controllers;

use App\Constants\DesignationShortName;
use App\Entities\Sharing\ShareConversation;
use App\Services\Sharing\ShareConversationService;
use App\Services\TaskService;
use App\Services\workflow\DashboardWorkflowService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Modules\HRM\Services\EmployeeService;
use Modules\RMS\Services\ResearchProposalSubmissionService;
use Modules\RMS\Services\ResearchRequestService;

class RMSController extends Controller
{
    private $dashboardService;
    /**
     * @var ResearchProposalSubmissionService
     */
    private $researchProposalSubmissionService;
    /**
     * @var ResearchRequestService
     */
    private $researchRequestService;
    private $employeeService;
    /**
     * @var TaskService
     */
    private $taskService;

    /*
     * @var $shareConversationService;
     */
    private $shareConversationService;


    /**
     * Create a new controller instance.
     *
     * @param DashboardWorkflowService $dashboardService
     */
    public function __construct(DashboardWorkflowService $dashboardService, ResearchProposalSubmissionService $researchProposalSubmissionService, ResearchRequestService $researchRequestService, EmployeeService $employeeService,
                                TaskService $taskService, ShareConversationService $shareConversationService)
    {
        $this->dashboardService = $dashboardService;
        $this->researchProposalSubmissionService = $researchProposalSubmissionService;
        $this->researchRequestService = $researchRequestService;
        $this->employeeService = $employeeService;
        $this->taskService = $taskService;
        $this->shareConversationService = $shareConversationService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $PendingItem = [];
        $user = Auth::user();
//        dd($user->employee);
        $employee = $this->employeeService->findOne($user->reference_table_id);
        $chartData = $this->taskService->getTasksBarChartData();
        $tasks = $this->taskService->getAllResearchTasks();
        $invitations = $this->researchRequestService->getResearchInvitationByDeadline();
        $proposals = $this->researchProposalSubmissionService->getResearchProposalBySubmissionDate();

        //------Research proposal dashboard items--------
        $featureName = Config::get('constants.research_proposal_feature_name');
        $pendingTasks = $this->dashboardService->getDashboardWorkflowItems($featureName);
        $rejectedItems = $this->dashboardService->getDashboardRejectedWorkflowItems($featureName);
//        array_push($PendingItem, $pendingTasks->dashboardItems);

        //-------Research paper workflow Items-----------
        $researchFeatureName = Config::get('rms.research_feature_name');
        $researchPendingTasks = $this->dashboardService->getDashboardWorkflowItems($researchFeatureName);
        $researchRejectedItems = $this->dashboardService->getDashboardRejectedWorkflowItems($researchFeatureName);
//        array_push($PendingItem, $researchPendingTasks->dashboardItems);

        //--------Research Detail workflow item----------
        $researchDetailFeatureName = config('rms.research_proposal_detail_feature');
        $researchDetailPendingItems = $this->dashboardService->getDashboardWorkflowItems($researchDetailFeatureName);
        $researchDetailRejectedItems = $this->dashboardService->getDashboardRejectedWorkflowItems($researchDetailFeatureName);
        //=======not needed the following commented code. Will remove it soon


        //-------Share conversation items-------
    //    dd($employee);
        $shareConversations = (is_null($employee)) ? null : $this->shareConversationService->getShareConversationByDesignation($employee);
        $bulkActionForApprove = in_array($employee->designation->short_name, [DesignationShortName::DG]);

        return view('rms::index', compact('pendingTasks', 'chartData', 'invitations', 'proposals',
            'rejectedItems', 'tasks', 'researchPendingTasks', 'researchRejectedItems', 'shareConversations',
            'bulkActionForApprove', 'researchDetailPendingItems', 'researchDetailRejectedItems'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('rms::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
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
        return view('rms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('rms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
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
}
