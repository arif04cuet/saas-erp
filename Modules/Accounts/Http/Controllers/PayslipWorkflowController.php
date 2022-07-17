<?php

namespace Modules\Accounts\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Services\EconomyCodeService;
use Modules\Accounts\Services\JournalService;
use Modules\Accounts\Services\PayslipBatchService;
use Modules\Accounts\Services\PayslipService;
use Modules\Accounts\Services\PayslipWorkflowService;

class PayslipWorkflowController extends Controller
{
    /**
     * @var PayslipBatchService
     */
    private $payslipBatchService;
    /**
     * @var JournalService
     */
    private $journalService;
    /**
     * @var EconomyCodeService
     */
    private $economyCodeService;
    /**
     * @var PayslipWorkflowService
     */
    private $payslipWorkflowService;
    /**
     * @var PayslipService
     */
    private $payslipService;

    /**
     * PayslipWorkflowController constructor.
     * @param PayslipBatchService $payslipBatchService
     * @param JournalService $journalService
     * @param EconomyCodeService $economyCodeService
     * @param PayslipWorkflowService $payslipWorkflowService
     * @param PayslipService $payslipService
     */
    public function __construct(
        PayslipBatchService $payslipBatchService,
        JournalService $journalService,
        EconomyCodeService $economyCodeService,
        PayslipWorkflowService $payslipWorkflowService,
        PayslipService $payslipService
    ) {
        $this->payslipBatchService = $payslipBatchService;
        $this->journalService = $journalService;
        $this->economyCodeService = $economyCodeService;
        $this->payslipWorkflowService = $payslipWorkflowService;
        $this->payslipService = $payslipService;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $from = Carbon::parse('-3 months')->format('Y-m-01');
        $to = Carbon::parse('+3 months')->format('Y-m-01');
        $payslipBatches = $this->payslipBatchService->getPayslipBatchesByPeriod($from, $to)
            ->pluck('name', 'id')
            ->toArray();
        $journals = ['' => __('labels.select')] + $this->journalService->getjournalsForDropdown();
        $economyCodes = $this->economyCodeService->getEconomyCodesForDropdown(
            null,
            function ($item) {
                return $item->code;
            },
            null,
            true
        );
        $payslips = Session::has('payslips') ? Session::get('payslips') : [];
        $selectedPayslipBatch = Session::has('payslip_batch_id') ? Session::get('payslip_batch_id') : null;
        $selectedJournal = Session::has('journal_id') ? Session::get('journal_id') : null;
        $selectedEconomyCode = Session::has('payable_code') ? Session::get('payable_code') : null;
        $page = Session::has('page') ? Session::get('page') : 'create';

        return view('accounts::payroll.payslip.workflow.create',
                    compact('payslipBatches', 'journals', 'payslips', 'economyCodes',
                            'selectedPayslipBatch', 'selectedJournal', 'selectedEconomyCode', 'page'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $selectedPayslipBatch = $request->payslip_batch_id;
        if ($selectedPayslipBatch == 'draft') {
            $payslips = $this->payslipService
                ->findBy(['status' => strtolower(config('constants.payslip_statuses.draft'))]);
        } else {
            $payslipBatch = $this->payslipBatchService->findOne($selectedPayslipBatch);
            $payslips = $payslipBatch ? $payslipBatch->payslips->filter(function ($item) {
                return $item->status == strtolower(config('constants.payslip_statuses.draft'));
            }) : [];
        }
        $page = count($payslips) ? 'store' : 'create';

        return redirect()->route('payslips-workflow.create')
            ->with('payslips', $payslips)
            ->with('journal_id', $request->journal_id)
            ->with('payable_code', $request->payable_code)
            ->with('payslip_batch_id', $selectedPayslipBatch)
            ->with('page', $page);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $approval = $this->payslipWorkflowService->approvePayslips($request->all());
        if ($approval && $request->payslip_batch_id != strtolower(config('constants.payslip_statuses.draft'))) {
            return redirect()->route('payslip-batches.show', $request->payslip_batch_id);
        } elseif ($approval && $request->payslip_batch_id == strtolower(config('constants.payslip_statuses.draft'))) {
            return redirect()->route('payslips.index');
        }
        return redirect()->back();

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
        return view('accounts::edit');
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
}
