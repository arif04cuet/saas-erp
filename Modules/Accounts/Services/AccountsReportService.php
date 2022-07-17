<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Modules\Accounts\Entities\AccountsBudget;
use Modules\Accounts\Entities\TemporaryTransactionCode;
use Modules\Accounts\Repositories\FiscalYearRepository;
use Modules\Accounts\Repositories\JournalEntryRepository;

class AccountsReportService
{
    use CrudTrait;
    /**
     * @var AccountsBudgetService
     */
    private $accountsBudgetService;
    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;
    /**
     * @var JournalEntryRepository
     */
    private $journalEntryRepository;
    /**
     * @var EconomyCodeSettingService
     */
    private $economyCodeSettingService;
    /**
     * @var EconomyCodeService
     */
    private $economyCodeService;

    /**
     * AccountsReportService constructor.
     * @param AccountsBudgetService $accountsBudgetService
     * @param FiscalYearRepository $fiscalYearRepository
     * @param JournalEntryRepository $journalEntryRepository
     * @param EconomyCodeSettingService $economyCodeSettingService
     * @param EconomyCodeService $economyCodeService
     */
    public function __construct(
        AccountsBudgetService $accountsBudgetService,
        FiscalYearRepository $fiscalYearRepository,
        JournalEntryRepository $journalEntryRepository,
        EconomyCodeSettingService $economyCodeSettingService,
        EconomyCodeService $economyCodeService
    ) {
        $this->accountsBudgetService = $accountsBudgetService;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->setActionRepository($fiscalYearRepository);
        $this->journalEntryRepository = $journalEntryRepository;
        $this->economyCodeSettingService = $economyCodeSettingService;
        $this->economyCodeService = $economyCodeService;
    }

    /**
     * Method that prepares expenditure report data according to fiscal year and month (if given)
     * @param $fiscalYearId
     * @param null $month
     * @return array
     */
    public function prepareExpenditureReport($fiscalYearId, $month = null)
    {
        //$month = $month? Carbon::parse()->format('Y-n') : Carbon::parse($month)->format('Y-n');
        $budget = $this->findOne($fiscalYearId)->budget;
        if (!$budget) {
            return;
        }
        $budgetReportData = $this->accountsBudgetService->prepareBudgetReportData($budget->id);
        $expenditureReportData =  [];

        foreach ($budgetReportData as $key => $budgetReportDatum) {
            foreach ($budgetReportDatum as $datum) {
                $economyCode = $datum['economy_code'];
                $sector = $datum['sector'];
                $monthlyExpense = $month? $this->journalEntryRepository->getJournalTransactions(
                    $fiscalYearId,
                    $economyCode->code,
                    $month
                )->sum('debit_amount') : 0;
                $totalExpense = $this->journalEntryRepository->getJournalTransactions(
                    $fiscalYearId,
                    $economyCode->code,
                    $month,
                    true
                )->sum('debit_amount');
                $budgetAmount = ($sector->revised_local_amount + $sector->revised_revenue_amount);
                $expenditureReportData[$key][$economyCode->code] = [
                    'name' => App::getLocale() == 'bn'? $economyCode->bangla_name : $economyCode->english_name,
                    'budget_amount' => $budgetAmount,
                    'monthly_expense' => $monthlyExpense,
                    'total_expense' => $totalExpense,
                    'percentage_of_expense' => round($budgetAmount? (($totalExpense * 100) / $budgetAmount) : 0, 2)
                ];
            }
        }
        //dd($expenditureReportData);
        return [
            $budget,
            [
               'expenditures' => $expenditureReportData,
                'cost_center_data' => $this->getBudgetCostCenters($budget, $fiscalYearId, $month)
            ]
        ];
    }

    /**
     * Method that returns an array of receipt and payment report data
     * @param $fiscalYearId
     * @param null $month
     * @return array
     */
    public function prepareReceiptPaymentReport($fiscalYearId, $month = null)
    {
        $budget = $this->fiscalYearRepository->findOne($fiscalYearId)->budget;
        if (!$budget) {
            return null;
        }
        $sectors = $budget->sectors->pluck('code');
        $receiptCodes = $this->economyCodeSettingService->getCodesFromSettings(
            config('constants.economy_code_types.receipt')
        )->pluck('economy_code')->toArray();
        $temporaryCodes = $this->economyCodeSettingService->getCodesFromSettings(
            config('constants.economy_code_types.temporary')
        )->pluck('economy_code')->toArray();
        $receipts = [];
        $expenditures = [];
        $temporaries = [];
        /**
         * Preparing data according to economy code type fetched from economy code settings
         */
        foreach ($sectors as $sector) {
            $economyCode = $this->economyCodeService->findBy(['code' => $sector])->first();
            $codeName = App::getLocale() == 'bn'? $economyCode->bangla_name : $economyCode->english_name;
            $transactions = $this->getTotalTransactionByCode($fiscalYearId, $sector, $month);
            $expenditures[] = [
                'code' => $economyCode->code,
                'name' => $codeName,
                'expenditure' => $transactions['monthly_expense'],
                'total_expenditure' => $transactions['total_expense'],
            ];
        }
        foreach ($receiptCodes as $code) {
            $economyCode = $this->economyCodeService->findBy(['code' => $code])->first();
            $codeName = App::getLocale() == 'bn' ? $economyCode->bangla_name : $economyCode->english_name;
            $transactions = $this->getTotalTransactionByCode($fiscalYearId, $code, $month);
            $receipts[] = [
                'code' => $economyCode->code,
                'name' => $codeName,
                'receipt' => $transactions['monthly_receipt'],
                'total_receipt' => $transactions['total_receipt'],
            ];
        }
        foreach ($temporaryCodes as $code) {
            $economyCode = $this->economyCodeService->findBy(['code' => $code])->first();
            $codeName = App::getLocale() == 'bn' ? $economyCode->bangla_name : $economyCode->english_name;
            $transactions = $this->getTotalTransactionByCode($fiscalYearId, $code, $month);
            $temporaries[] = [
                'code' => $economyCode->code,
                'name' => $codeName,
                'expenditure' => $transactions['monthly_expense'],
                'receipt' => $transactions['monthly_receipt'],
                'total_expenditure' => $transactions['total_expense'],
                'total_receipt' => $transactions['total_receipt'],
            ];
        }
        return [
            $budget,
            [
                'receipts' => $receipts,
                'temporaries' => $temporaries,
                'expenditures' => $expenditures,
                'cost_center_data' => $this->getBudgetCostCenters($budget, $fiscalYearId, $month)
            ]
        ];
    }

    private function getTotalTransactionByCode($fiscalYearId, $code, $month = null)
    {
        $monthlyTransactions = $month? $this->journalEntryRepository->getJournalTransactions(
            $fiscalYearId,
            $code,
            $month
        ) : null;
        $allTransactions = $month? $this->journalEntryRepository->getJournalTransactions(
            $fiscalYearId,
            $code,
            null
        ) : null;

        $data = [
            'monthly_receipt' => $monthlyTransactions? $monthlyTransactions->sum('credit_amount') : 0,
            'total_receipt' => $allTransactions? $allTransactions->sum('credit_amount') : 0,
            'monthly_expense' => $monthlyTransactions? $monthlyTransactions->sum('debit_amount') : 0,
            'total_expense' => $allTransactions? $allTransactions->sum('debit_amount') : 0,
        ];
        return $data;
    }

    /**
     * @param AccountsBudget $budget
     * @param $fiscalYearId
     * @param $month
     * @return array|null
     */
    public function getBudgetCostCenters(AccountsBudget $budget, $fiscalYearId, $month)
    {
        $costCenters = $budget->budgetCostCenters;
        if (!$costCenters) {
            return null;
        }
        $costCenterData = [];
        foreach ($costCenters as $costCenter) {
            $sectors = $costCenter->sectors;
            foreach ($sectors as $key => $sector) {
                $economySector =  $sector->economySector;
                $expense = $this->getTotalTransactionByCode($fiscalYearId, $economySector->code, $month);
                $costCenterData[$costCenter->economy_code][] = [
                    'code' => $economySector->code,
                    'title' => App::getLocale() == 'bn'? $economySector->title_bangla : $economySector->title,
                    'budget' => $sector->budget_amount,
                    'monthly_expense' => $expense['monthly_expense'],
                    'total_expense' => $expense['total_expense'],
                ];
            }
        }

        return $costCenterData;
    }
}
