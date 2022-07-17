<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Http\Requests\BudgetCostCenterRequest;
use Modules\Accounts\Services\AccountsBudgetService;
use Modules\Accounts\Services\BudgetCostCenterService;
use Modules\Accounts\Services\CostCenterService;

class BudgetCostCenterController extends Controller
{

    /**
     * @var BudgetCostCenterService
     */
    private $budgetCostCenterService;
    /**
     * @var CostCenterService
     */
    private $costCenterService;
    /**
     * @var AccountsBudgetService
     */
    private $accountsBudgetService;

    /**
     * BudgetCostCenterController constructor.
     * @param BudgetCostCenterService $budgetCostCenterService
     * @param CostCenterService $costCenterService
     * @param AccountsBudgetService $accountsBudgetService

     */
    public function __construct(
        BudgetCostCenterService $budgetCostCenterService,
        CostCenterService $costCenterService,
        AccountsBudgetService $accountsBudgetService
    ) {
        $this->budgetCostCenterService = $budgetCostCenterService;
        $this->costCenterService = $costCenterService;
        $this->accountsBudgetService = $accountsBudgetService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $budgetCostCenters = $this->budgetCostCenterService->findAll();
        return view('accounts::budget.cost-center.index', compact('budgetCostCenters'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $budgets = $this->accountsBudgetService->findAll()->pluck('title', 'id');
        $economyCodes = $this->budgetCostCenterService->getEconomyCodeWithSectors();
        $page = 'create';

        return view('accounts::budget.cost-center.create',
            compact('budgets', 'page', 'economyCodes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param BudgetCostCenterRequest $request
     * @return Response
     */
    public function store(BudgetCostCenterRequest $request)
    {
        $save = $this->budgetCostCenterService->saveBudgetCostCenter($request->all());
        return $save ? redirect(route('budget-cost-centers.index')) : redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('accounts::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $budgetCostCenter = $this->budgetCostCenterService->findOne($id);
        $sectors = $this->budgetCostCenterService->getSavedUnsavedSectors($budgetCostCenter);
        $budgets = $this->accountsBudgetService->findAll()->pluck('title', 'id');
        $economyCodes = $this->budgetCostCenterService->getEconomyCodeWithSectors();
        $page = 'edit';
        return view('accounts::budget.cost-center.create',
            compact('budgetCostCenter', 'sectors', 'budgets', 'economyCodes', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return response
     */
    public function update(Request $request, $id)
    {
        $update = $this->budgetCostCenterService->updateBudgetCostCenter($request->all(), $id);
        return $update ? redirect(route('budget-cost-centers.index')) : redirect()->back();
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
