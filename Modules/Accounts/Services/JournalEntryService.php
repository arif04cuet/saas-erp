<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\JournalEntry;
use Modules\Accounts\Entities\JournalEntryDetail;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Repositories\JournalEntryRepository;
use Modules\Accounts\Repositories\JournalRepository;

class JournalEntryService
{
    use CrudTrait;

    protected $journalEntryRepository;
    /**
     * @var AccountsBudgetService
     */
    private $accountsBudgetService;
    /**
     * @var EconomyCodeService
     */
    private $economyCodeService;
    /**
     * @var JournalEntryDetailService
     */
    private $journalEntryDetailService;
    /**
     * @var CashBookEntryService
     */
    private $cashBookEntryService;
    /**
     * @var FiscalYearService
     */
    private $fiscalYearService;
    /**
     * @var PayslipDetailService
     */
    private $payslipDetailService;
    /**
     * @var EconomySectorService
     */
    private $economySectorService;
    /**
     * @var EmployeeAdvancePaymentService
     */
    private $employeeAdvancePaymentService;
    /**
     * @var AccountHostelIntegrationService
     */
    private $accountsHostelIntegrationService;

    /**
     * JournalEntryService constructor.
     *
     * @param JournalEntryRepository $journalEntryRepository
     * @param AccountsBudgetService $accountsBudgetService
     * @param EconomyCodeService $economyCodeService
     * @param JournalEntryDetailService $journalEntryDetailService
     * @param CashBookEntryService $cashBookEntryService
     * @param EmployeeAdvancePaymentService $employeeAdvancePaymentService
     * @param FiscalYearService $fiscalYearService
     * @param PayslipDetailService $payslipDetailService
     * @param AccountHostelIntegrationService $accountsIntegrationService
     * @param EconomySectorService $economySectorService
     */
    public function __construct(
        JournalEntryRepository $journalEntryRepository,
        AccountsBudgetService $accountsBudgetService,
        EconomyCodeService $economyCodeService,
        JournalEntryDetailService $journalEntryDetailService,
        CashBookEntryService $cashBookEntryService,
        EmployeeAdvancePaymentService $employeeAdvancePaymentService,
        FiscalYearService $fiscalYearService,
        PayslipDetailService $payslipDetailService,
        AccountHostelIntegrationService $accountsHostelIntegrationService,
        EconomySectorService $economySectorService
    ) {
        $this->journalEntryRepository = $journalEntryRepository;
        $this->setActionRepository($this->journalEntryRepository);
        $this->accountsBudgetService = $accountsBudgetService;
        $this->economyCodeService = $economyCodeService;
        $this->journalEntryDetailService = $journalEntryDetailService;
        $this->cashBookEntryService = $cashBookEntryService;
        $this->employeeAdvancePaymentService = $employeeAdvancePaymentService;
        $this->fiscalYearService = $fiscalYearService;
        $this->payslipDetailService = $payslipDetailService;
        $this->economySectorService = $economySectorService;
        $this->accountsHostelIntegrationService = $accountsHostelIntegrationService;
    }

    public function filterDataFromJournalRequest(array $data)
    {
        return [
            JournalEntry::COLUMN_DATE => $data['date'],
            JournalEntry::COLUMN_JOURNAL_ID => $data['journal_id'],
            JournalEntry::COLUMN_REFERENCE => $data['reference'],
            JournalEntry::COLUMN_FISCAL_YEAR => $data['fiscal_year_id'],
        ];
    }

    public function calculateAvailableBudgetByCode($code, $fiscalYearId)
    {
        $budgetAmount = $this->accountsBudgetService->getRevisedBudgetAmountByCode($code, $fiscalYearId);
        $transactions = $this->journalEntryRepository->getJournalTransactions($fiscalYearId, $code, null, true);
        $expense = $transactions ? $transactions->sum('debit_amount') : 0;
        return ($budgetAmount - $expense);
    }

    /**
     * This Method Creates Journal Entry and Journal Entry Details
     * @param array $requestData
     * @throws Exception
     */
    public function createJournalEntry(array $requestData)
    {
        /**
         * 1. create Journal entry
         * 2. create journal entry details
         * 3. if advance payment is checked, create employeeAdvancePayment
         */

        if (!isset($requestData['payment_type'])) {
            throw new Exception('Payment type is needed for cash entry');
        }
        $journalEntryData = $this->filterDataFromJournalRequest($requestData);
        $journalEntry = $this->save($journalEntryData);
        $journalEntryDetail = $this->createJournalEntryDetail($journalEntry, $requestData['journal_entries'],
            $requestData['payment_type']);
        // advance entry
        if (isset($requestData['advance_entry'])) {
            // create advance payment data
            if (!isset($requestData['employee_id'])) {
                throw new Exception('An Employee Should Be Selected');
            }
            $advanceEntry = $requestData['advance_entry'];
            $this->employeeAdvancePaymentService->saveData($journalEntry, $advanceEntry, $requestData['employee_id']);
        }
    }

    /**
     * @param JournalEntry $journalEntry
     * @param array $journalEntries
     * @param $paymentType
     * @return mixed|null
     */
    public function createJournalEntryDetail(JournalEntry $journalEntry, array $journalEntries, $paymentType)
    {
        $len = count($journalEntries);
        foreach ($journalEntries as $index => $data) {
            // for each data, create a separate entry
            $data['journal_entry_id'] = $journalEntry->id;
            $data['fiscal_year_id'] = $journalEntry->fiscal_year_id;
            $journalEntryDetail = $this->journalEntryDetailService->saveData($data);
            // if it was a sector, put an entry for its parent
            $economySector = $this->journalEntryDetailService->isEconomySector($journalEntryDetail->economy_code);
            if ($economySector) {
                $data['economy_code'] = $economySector->parent_economy_code;
                $journalEntryDetail = $this->journalEntryDetailService->saveData($data);
            }
            if ($data['is_cash_book_entry']) {
                $this->createCashBookEntry($journalEntryDetail, $paymentType);
            }
        }

        if (!empty($journalEntry->journalEntryDetails)) {
            return $journalEntry->journalEntryDetails;
        } else {
            return null;
        }
    }

    /**
     * @param Payslip $payslip
     *
     * @param           $journalId
     * @param           $payableEconomyCode
     *
     * @return array
     */
    public function prepareJournalEntryDataFromPayslip(Payslip $payslip, $journalId, $payableEconomyCode)
    {
        $journalEntryArray = [];
        $journalEntryDetailArray = [];
        $allowanceArray = [];
        $deductionArray = [];
        $cashBookEntryArray = [];
        $totalAmount = 0;
        $employeeName = $payslip->employee->getName();
        $journalEntryArray['date'] = $payslip->updated_at;
        $journalEntryArray['journal_id'] = $journalId;
        $journalEntryArray['reference'] = 'Salary Generated For ' . $employeeName;
        $fiscalYear = $this->fiscalYearService->getFiscalYearFromPayslip($payslip);
        $journalEntryArray['fiscal_year_id'] = $fiscalYear->id;
        $payslipDetail = $payslip->payslipDetails;
        $allowances = $this->payslipDetailService->getAllowanceFromPayslipDetail($payslipDetail);
        // for each allowance, create journal entries array
        foreach ($allowances as $allowance) {
            // allowance --> revenue --> payment --> debit amount
            $rule = $allowance->salaryRule;
            if (is_null(optional($rule->debit_economy_code)->code)) {
                continue;
            }
            $allowanceArray['economy_code'] = $rule->debit_economy_code->code;
            $allowanceArray['credit_amount'] = 0;
            $allowanceArray['debit_amount'] = $allowance->amount;
            $allowanceArray['source'] = JournalEntryDetail::getSources()[1]; // revenue
            $allowanceArray['account_transaction_type'] = JournalEntryDetail::getTransactionTypes()[1];// payment
            $allowanceArray['remark'] = $allowance->salaryRule->code;// payment
            $allowanceArray['is_cash_book_entry'] = 0;
            $totalAmount += $allowanceArray['debit_amount'];
            $journalEntryDetailArray[] = $allowanceArray;
        }
        $deducations = $this->payslipDetailService->getDeductionFromPayslipDetail($payslipDetail);
        foreach ($deducations as $deducation) {
            //deduction --> local --> receipt --> credit amount
            $rule = $deducation->salaryRule;
            if (is_null(optional($rule->credit_economy_code)->code)) {
                continue;
            }
            $deductionArray['economy_code'] = $rule->credit_economy_code->code;
            $deductionArray['credit_amount'] = $deducation->amount;
            $deductionArray['debit_amount'] = 0;
            $deductionArray['source'] = JournalEntryDetail::getSources()[0]; //local
            $deductionArray['account_transaction_type'] = JournalEntryDetail::getTransactionTypes()[0]; //receipt
            $deductionArray['remark'] = $deducation->salaryRule->code;
            $deductionArray['is_cash_book_entry'] = 0;
            $totalAmount -= $deductionArray['credit_amount'];
            $journalEntryDetailArray[] = $deductionArray;
        }
        // last entry should be always cashBookEntry
        $cashBookEntryArray['economy_code'] = $payableEconomyCode;
        $cashBookEntryArray['credit_amount'] = $totalAmount;
        $cashBookEntryArray['debit_amount'] = 0;
        $cashBookEntryArray['is_cash_book_entry'] = 1;
        $cashBookEntryArray['source'] = JournalEntryDetail::getSources()[1]; //revenue
        $cashBookEntryArray['account_transaction_type'] = JournalEntryDetail::getTransactionTypes()[1]; //payment
        $cashBookEntryArray['remark'] = 'Total Payable for ' . $employeeName;
        // ----------- CashBookEntry Array ----------------------
        $journalEntryDetailArray[] = $cashBookEntryArray;
        $journalEntryArray['payment_type'] = $cashBookEntryArray['payment_type'] = JournalEntryDetail::getPaymentTypes()[0]; //payment
        $journalEntryArray['journal_entries'] = $journalEntryDetailArray;
        return $journalEntryArray;
    }

    /**
     * @param Payslip $payslip
     *
     * @param           $journalId
     * @param           $payableEconomyCode
     *
     * @throws Exception
     */
    public function createJournalEntryFromPayslip(Payslip $payslip, $journalId, $payableEconomyCode)
    {
        $data = $this->prepareJournalEntryDataFromPayslip($payslip, $journalId, $payableEconomyCode);
        $filteredData = $this->accountsHostelIntegrationService->ignoreIntegrationCodeFromPayslip($payslip, $data,
            true);
        $this->createJournalEntry($filteredData);
    }

    /**
     * @param JournalEntryDetail $journalEntryDetail
     * @param                      $paymentType
     *
     * @return Model
     */
    public function createCashBookEntry(
        JournalEntryDetail $journalEntryDetail,
        $paymentType
    ): Model {
        $cashBookArray = $this->cashBookEntryService->createCashBookArray($journalEntryDetail, $paymentType);
        return $this->cashBookEntryService->save($cashBookArray);
    }

    /**
     * Return all economy sectors from journal entry
     *
     * @param JournalEntry $journalEntry
     *
     * @return array
     */
    public function getEconomySectorsFromJournalEntry(JournalEntry $journalEntry): array
    {
        $economySectors = array();
        foreach ($journalEntry->journalEntryDetails as $journalEntryDetail) {
            if (is_null($journalEntryDetail->economyCode->code)) {
                $economySector = $this->economySectorService->findBy(['code' => $journalEntryDetail->economy_code])->first();
                $economySectors[$economySector->code] = [
                    'title' => $economySector->title,
                    'title_bangla' => $economySector->title_bangla
                ];
            }
        }
        return $economySectors;
    }

    /**
     * Change Status of Journal Entry
     *
     * @param JournalEntry $journalEntry
     * @param                $status
     *
     * @return bool
     */
    public function changeStatus(JournalEntry $journalEntry, $status)
    {
        foreach ($journalEntry->journalEntryDetails as $journalEntryDetail) {
            $journalEntryDetail->update(['status' => $status]);
        }
        return $journalEntry->update(['status' => $status]);
    }

    /**
     * Create Journal Entry From Any Module
     * @param array $data [must have these keys -
     *  [journal_entry_meta_data] - information for journal_entries table
     *  [journal_entry_details] - information for journal_entry_details table
     *  [payment_type] - bank/cash
     * @return bool
     */
    public function postJournalEntry(array $data)
    {
        try {
            DB::beginTransaction();
            // create journal entry meta data
            $journalEntry = null;
            if (isset($data['journal_entry_meta_data']) && !is_null($data['journal_entry_meta_data'])) {
                $journalEntry = $this->save($data['journal_entry_meta_data']);
            }

            // create journal entry details
            if (isset($data['journal_entry_details']) && !is_null($data['journal_entry_details'])) {
                collect($data['journal_entry_details'])->map(function ($e) use ($data, $journalEntry) {
                    $e['journal_entry_id'] = $journalEntry->id;
                    $e['fiscal_year_id'] = $journalEntry->fiscal_year_id;
                    $journalEntryDetail = $this->journalEntryDetailService->saveData($e);
                    if ($e['is_cash_book_entry'] && isset($data['payment_type'])) {
                        $this->createCashBookEntry($journalEntryDetail, $data['payment_type']);
                    }
                });
            }
            DB::commit();
            return $journalEntry;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Accounts:: Journal Entry Error " . $e->getMessage() . " trace:" . $e->getTraceAsString());
            Session::flash(trans('labels.generic_error_message'));
            return false;
        }
    }
}

