<?php

namespace Modules\PMS\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\PMS\Entities\DraftProposalBudget;
use Modules\PMS\Entities\ProjectDetailProposal;
use Modules\PMS\Http\Requests\CreateProjectBudgetRequest;
use Modules\PMS\Http\Requests\UpdateProjectBudgetRequest;
use Modules\PMS\Services\DraftProposalBudgetService;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProjectDetailProposalBudgetController extends Controller
{
    private $economyCodeService;
    private $draftProposalBudgetService;

    public function __construct(
        DraftProposalBudgetService $draftProposalBudgetService,
        EconomyCodeService $economyCodeService)
    {
        $this->draftProposalBudgetService = $draftProposalBudgetService;
        $this->economyCodeService = $economyCodeService;
    }

    /**
     * Display a listing of the resource.
     * @param ProjectDetailProposal $projectDetailProposal
     * @return Response
     */
    public function index(ProjectDetailProposal $projectDetailProposal)
    {
        $data = (object) $this->draftProposalBudgetService->prepareDataForBudgetView($projectDetailProposal);
        $projectBudgets = $this->draftProposalBudgetService->getEconomyCodeWiseSortedBudgets($projectDetailProposal);
        return view('pms::proposal-submission.details.budget.index', compact('projectDetailProposal', 'data', 'projectBudgets'));
    }

    public function getBudgetExpense(ProjectDetailProposal $projectDetailProposal)
    {
        return $this->draftProposalBudgetService->getTotalExpenseOfRevenueAndCapital($projectDetailProposal);
    }

    /**
     * @param ProjectDetailProposal $projectDetailProposal
     * @param $tableType
     * @return BinaryFileResponse
     */
    public function exportExcel(ProjectDetailProposal $projectDetailProposal, $tableType)
    {
        $data = (object) $this->draftProposalBudgetService->prepareDataForBudgetView($projectDetailProposal);
        $viewName = 'pms::proposal-submission.details.budget.partials.' . $tableType;
        return $this->draftProposalBudgetService->exportExcel(compact('projectDetailProposal', 'data'), $viewName, $projectDetailProposal->title .'-' .$tableType);
    }

    /**
     * Show the form for creating a new resource.
     * @param ProjectDetailProposal $projectDetailProposal
     * @return Response
     */
    public function create(ProjectDetailProposal $projectDetailProposal)
    {
        $economyCodeOptions = $this->economyCodeService->getEconomyCodesForDropdown();
        $sectionTypes = $this->draftProposalBudgetService->getSectionTypesOfDraftProposalBudget();
        return view('pms::proposal-submission.details.budget.create', compact('projectDetailProposal', 'economyCodeOptions', 'sectionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateProjectBudgetRequest $request
     * @param ProjectDetailProposal $projectDetailProposal
     * @return Response
     */
    public function store(CreateProjectBudgetRequest $request, ProjectDetailProposal $projectDetailProposal)
    {
        $this->draftProposalBudgetService->store($projectDetailProposal, $request->all());

        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('project-detail-proposal-budget.index', $projectDetailProposal->id);
    }

    /**
     * Show the form for editing the specified resource.
     * @param ProjectDetailProposal $projectDetailProposal
     * @param DraftProposalBudget $draftProposalBudget
     * @return Response
     */
    public function edit(ProjectDetailProposal $projectDetailProposal, DraftProposalBudget $draftProposalBudget)
    {
        $economyCodeOptions = $this->economyCodeService->getEconomyCodesForDropdown();
        $sectionTypes = $this->draftProposalBudgetService->getSectionTypesOfDraftProposalBudget();

        return view('pms::proposal-submission.details.budget.edit', compact('projectDetailProposal', 'draftProposalBudget', 'economyCodeOptions', 'sectionTypes'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateProjectBudgetRequest $request
     * @param ProjectDetailProposal $projectDetailProposal
     * @param DraftProposalBudget $draftProposalBudget
     * @return array
     */
    public function update(UpdateProjectBudgetRequest $request, ProjectDetailProposal $projectDetailProposal, DraftProposalBudget $draftProposalBudget)
    {
        $this->draftProposalBudgetService->updateBudget($request->all(), $draftProposalBudget);

        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('project-detail-proposal-budget.index', $projectDetailProposal->id);
    }
}
