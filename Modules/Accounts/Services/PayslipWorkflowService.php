<?php

namespace Modules\Accounts\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Repositories\PayslipRepository;
use Nexmo\Account\Config;

class PayslipWorkflowService
{
    /**
     * @var PayslipRepository
     */
    private $payslipRepository;
    /**
     * @var JournalEntryService
     */
    private $journalEntryService;
    /**
     * @var PayslipService
     */
    private $payslipService;

    /**
     * @var GpfService
     */
    private $gpfService;

    /**
     * PayslipWorkflowService constructor.
     * @param PayslipRepository $payslipRepository
     * @param JournalEntryService $journalEntryService
     * @param GpfService $gpfService
     * @param PayslipService $payslipService
     */
    public function __construct(
        PayslipRepository $payslipRepository,
        JournalEntryService $journalEntryService,
        GpfService $gpfService,
        PayslipService $payslipService
    ) {
        $this->payslipRepository = $payslipRepository;
        $this->journalEntryService = $journalEntryService;
        $this->gpfService = $gpfService;
        $this->payslipService = $payslipService;
    }

    /**
     * Changes the status of payslips according to action taken and creates journal if the action is 'approve'
     * @param array $data
     * @return bool|mixed
     */
    public function approvePayslips(array $data)
    {
        try {
            DB::beginTransaction();;
            foreach ($data['payslips'] as $payslipId) {
                $payslip = $this->payslipService->findOrFail($payslipId);
                if (strtolower($payslip->status) != strtolower(\config('constants.payslip_statuses.draft'))) {
                    continue;
                }
                $update = $payslip->update(['status' => $data['action']]);
                if ($payslip->status == strtolower(\config('constants.payslip_statuses.approve'))) {
                    $this->journalEntryService->createJournalEntryFromPayslip(
                        $payslip,
                        $data['journal_id'],
                        $data['payable_code']
                    );
                }
                // dont hit gpf record for bonus payslips
                if ($payslip->type != Payslip::getTypes()[1]) {
                    $this->gpfService->saveGpfMonthlyRecord($payslipId);
                }
            }
            DB::commit();
            // if any of the inside method caused an exception
            if (!Session::has('error')) {
                Session::flash('success', __('labels.save_success'));
            }
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Payslip Workflow Error: ' . $exception->getMessage() . " Trace: " . $exception->getTraceAsString());
            Session::flash('error', __('labels.save_fail') . ' ' . __('labels.error_code',
                    ['code' => $exception->getCode()]));
            return false;
        }
    }

}

