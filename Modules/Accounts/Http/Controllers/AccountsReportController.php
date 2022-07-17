<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Accounts\Services\AccountsReportService;

class AccountsReportController extends Controller
{
    /**
     * @var AccountsReportService
     */
    private $accountsReportService;
    /**
     * AccountsReportController constructor.
     * @param AccountsReportService $accountsReportService
     */
    public function __construct(AccountsReportService $accountsReportService)
    {
        $this->accountsReportService = $accountsReportService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $fiscalYears = $this->accountsReportService->findAll()->pluck('name', 'id');
        return view('accounts::reports.index', compact('fiscalYears'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('accounts::create');
    }

    /**
     * Show report according to the request
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function report(Request $request)
    {
        $fiscalYears = $this->accountsReportService->findAll()->pluck('name', 'id');
        $fiscalYearId = $request->fiscal_year_id;
        $month = $request->month;
        $type = $request->report_type;
        //dd($request->all());
        if ($type == config('constants.report_types.expenditure')) {
            $data = $this->accountsReportService->prepareExpenditureReport($fiscalYearId, $month);
        } elseif ($type == config('constants.report_types.receipt_payment')) {
            $data = $this->accountsReportService->prepareReceiptPaymentReport($fiscalYearId, $month);
        } else {
            return;
        }
        if ($data) {
            $budget = $data[0];
            $expenditures = $data[1];
        } else {
            return redirect()->back()->with('error', __('accounts::accounts.report.not_found'));
        }
        return view('accounts::reports.index',
            compact('budget', 'expenditures', 'fiscalYears', 'fiscalYearId', 'month', 'type'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        return redirect()->route('reports.index');
    }
}
