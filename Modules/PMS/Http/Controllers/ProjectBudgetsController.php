<?php

namespace Modules\PMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PMS\Entities\Project;
use Modules\PMS\Http\Requests\ProjectBudgetsRequest;
use Illuminate\Support\Facades\Session;
use Modules\PMS\Services\ProjectBudgetsService;
use Modules\Accounts\Services\FiscalYearService;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\PMS\Services\ProjectActivityService;

class ProjectBudgetsController extends Controller
{
    private $projectBudgetsService;
    private $fiscalYearService;
    private $economyCodeService;
    private $projectActivityService;

    public function __construct(
        ProjectBudgetsService $projectBudgetsService,
        FiscalYearService $fiscalYearService,
        EconomyCodeService $economyCodeService,
        ProjectActivityService $projectActivityService
    ) {
        $this->projectBudgetsService = $projectBudgetsService;
        $this->fiscalYearService = $fiscalYearService;
        $this->economyCodeService = $economyCodeService;
        $this->projectActivityService = $projectActivityService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Project $project)
    {
        // $fiscalYears =  $this->projectBudgetsService->getFiscalYearOfProject($project);
        $fiscalYears = $this->fiscalYearService->getFiscalYearsForDropdown();
        $projectBudgets = $project->budgetCreate;
        return view('pms::project.budget.index', compact(['project', 'projectBudgets', 'fiscalYears']));
    }

    public function filterAsJson(Project $project, Request $request)
    {
        if ($request->fiscal_year_id)
            $projectBudgets = $this->projectBudgetsService->getProjectBudgets($project, $request->fiscal_year_id);
        else
            $projectBudgets = $project->budgetCreate;

        return $this->projectBudgetsService->formatToJsonForDataTable($projectBudgets)->values();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Project $project)
    {
        $page = "create";
        $fiscalYear = $this->fiscalYearService->getFiscalYearsForDropdown();
        $economyCode = $this->economyCodeService->getEconomyCodesForDropdown();
        $activity = $this->projectActivityService->getActivityForDropdown(null, null, ['project_id' => $project->id], false);
        return view('pms::project.budget.create', compact(['page', 'project', 'fiscalYear', 'economyCode', 'activity']));
    }

    /**
     * Store a newly created resource in storage.
     * @param ProjectBudgetsRequest $request
     * @return Response
     */
    public function store(ProjectBudgetsRequest $request, Project $project)
    {
        if ($this->projectBudgetsService->store($project, $request->all()))
            Session::flash('success', trans('labels.save_success'));
        return redirect()->route('project-budget.index', $project->id);
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
    public function edit(Project $project)
    {
        $page = "edit";
        $projectBudget = $this->projectBudgetsService->getCreatedBudget($project);
        $fiscalYear = $this->fiscalYearService->getFiscalYearsForDropdown();
        $economyCode = $this->economyCodeService->getEconomyCodesForDropdown();
        $activity = $this->projectActivityService->getActivityForDropdown(null, null, ['project_id' => $project->id], false);
        return view('pms::project.budget.create', compact(['projectBudget', 'page', 'project', 'fiscalYear', 'economyCode', 'activity']));
    }

    /**
     * Update the specified resource in storage.
     * @param ProjectBudgetsRequest $request
     * @param int $id
     * @return Response
     */
    public function update(ProjectBudgetsRequest $request, Project $project)
    {
        if ($this->projectBudgetsService->updateBudget($project, $request->all()))
            Session::flash('success', trans('labels.save_success'));

        return redirect()->route('project-budget.index', $project->id);
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
}
