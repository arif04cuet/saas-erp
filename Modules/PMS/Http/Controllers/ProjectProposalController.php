<?php

namespace Modules\PMS\Http\Controllers;

use App\Services\workflow\FeatureService;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Modules\PMS\Entities\ProjectProposal;
use Modules\PMS\Entities\ProjectProposalFile;
use Modules\PMS\Entities\ProjectRequest;
use Modules\PMS\Http\Requests\CreateProjectProposalRequest;
use Modules\PMS\Services\ProjectProposalService;
use App\Services\workflow\DashboardWorkflowService;

/**
 * @property  ProjectProposalService
 */
class ProjectProposalController extends Controller
{
    private $projectProposalService;
    private $dashboardService;
    /**
     * @var FeatureService
     */
    private $featureService;

    /**
     * ProjectProposalController constructor.
     * @param ProjectProposalService $projectProposalService
     * @param DashboardWorkflowService $dashboardService
     * @param FeatureService $featureService
     */
    public function __construct(
        ProjectProposalService $projectProposalService,
        DashboardWorkflowService $dashboardService,
        FeatureService $featureService
    ) {
        $this->projectProposalService = $projectProposalService;
        $this->dashboardService = $dashboardService;
        /** @var FeatureService $featureService */
        $this->featureService = $featureService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $proposals = $this->projectProposalService->getProposalsForUser(Auth::user());
        $featureName = config('constants.project_proposal_feature_name');
        $feature = $this->featureService->findBy(['name' => $featureName]);
        $featureId = $feature[0]->id;
        $pendingTasks = $this->dashboardService->getDashboardWorkflowItems($featureName);

        return view('pms::proposal-submission.brief.index', compact('proposals', 'pendingTasks', 'featureId'));
    }

    /**
     * Show the form for creating a new resource.
     * @param ProjectRequest $projectRequest
     * @return Response
     */
    public function create(ProjectRequest $projectRequest)
    {
        $auth_user_id = Auth::user()->id;
        return view('pms::proposal-submission.brief.create', compact('projectRequest', 'auth_user_id'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateProjectProposalRequest $request
     * @return Response
     */
    public function store(CreateProjectProposalRequest $request)
    {
        $this->projectProposalService->store($request->all());
        if (!Session::has('success')) {
            Session::flash('success', trans('labels.save_success'));
        }
        return redirect()->route('pms');
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

    public function proposalAttachmentDownload(ProjectProposal $projectProposal)
    {
        return response()->download($this->projectProposalService->getZipFilePath($projectProposal->id));
    }

    public function fileDownload(ProjectProposalFile $projectProposalFile)
    {
        $basePath = Storage::disk('internal')->path($projectProposalFile->attachments);
        return response()->download($basePath);
    }
}
