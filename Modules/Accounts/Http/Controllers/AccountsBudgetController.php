<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Services\AccountsBudgetService;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\Accounts\Services\FiscalYearService;

class AccountsBudgetController extends Controller
{
    /**
     * @var AccountsBudgetService
     */
    private $accountsBudgetService;
    /**
     * @var EconomyCodeService
     */
    private $economyCodeService;
    /**
     * @var FiscalYearService
     */
    private $fiscalYearService;

    /**
     * AccountsBudgetController constructor.
     * @param AccountsBudgetService $accountsBudgetService
     * @param EconomyCodeService $economyCodeService
     * @param FiscalYearService $fiscalYearService
     */
    public function __construct(
        AccountsBudgetService $accountsBudgetService,
        EconomyCodeService $economyCodeService,
        FiscalYearService $fiscalYearService
    ) {
        $this->accountsBudgetService = $accountsBudgetService;
        $this->economyCodeService = $economyCodeService;
        $this->fiscalYearService = $fiscalYearService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $budgets = $this->accountsBudgetService->findAll();
        return view('accounts::budget.index', compact('budgets'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $fiscalYears = $this->fiscalYearService->findAll()->pluck('name', 'id');
        $dropdownKey = function ($query) {
            return $query->code;
        };
        $economyCodes = $this->economyCodeService->getEconomyCodesForDropdown(
            null,
            $dropdownKey,
            null,
            true);
        $page = 'create';

        return view('accounts::budget.create', compact('fiscalYears', 'economyCodes', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->accountsBudgetService->saveBudget($request->all());
        return redirect(route('budgets.index'))->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $budget = $this->accountsBudgetService->findOne($id);
        return view('accounts::budget.show', compact('budget'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $budget = $this->accountsBudgetService->findOne($id);
        $fiscalYears = $this->fiscalYearService->findAll()->pluck('name', 'id');
        $dropdownKey = function ($query) {
            return $query->code;
        };
        $economyCodes = $this->economyCodeService->getEconomyCodesForDropdown(
            null,
            $dropdownKey,
            null,
            true);
        $page = 'edit';

        return view('accounts::budget.create', compact('budget', 'fiscalYears', 'economyCodes', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->accountsBudgetService->updateBudget($request->all(), $id);
        return redirect(route('budgets.show', $id));
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

    public function report()
    {
        $budgets = $this->accountsBudgetService->findAll()->pluck('title', 'id');
        return view('accounts::budget.report', compact('budgets'));
    }

    /**
     * Method to show report for a particular budget that has been chosen from options
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showReport(Request $request)
    {
        $budgets = $this->accountsBudgetService->findAll()->pluck('title', 'id');
        $budget = $this->accountsBudgetService->findOne($request->budget);
        $reportData = $this->accountsBudgetService->prepareBudgetReportData($budget->id);

        return view('accounts::budget.report', compact('budgets', 'budget', 'reportData'));
    }

    /**
     * Method to download Budget Report
     * @param $budgetId
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadReport($budgetId)
    {
        $this->accountsBudgetService->downloadBudgetReport($budgetId);
        $path = public_path().'/files/budget_report.xlsx';
        return \response()->download($path, 'budget_report.xlsx');
    }

    public function printReport($budgetId)
    {
        $budget = $this->accountsBudgetService->findOne($budgetId);
        $reportData = $this->accountsBudgetService->prepareBudgetReportData($budgetId);
        return view('accounts::budget.print-report', compact('budget', 'reportData'));
    }
}
