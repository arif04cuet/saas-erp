<?php

namespace Modules\Accounts\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\EconomyCode;
use Modules\Accounts\Entities\EconomyCodeSetting;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Entities\SalaryCategory;
use Modules\Accounts\Entities\SalaryRule;
use Modules\HM\Entities\HmCodeSetting;
use Modules\HM\Entities\HmJournalEntry;
use Modules\HM\Entities\HostelBudgetSection;
use Modules\HM\Services\HmCodeSettingService;
use Modules\HM\Services\HmJournalEntryService;
use Modules\HM\Services\HostelBudgetTitleService;
use Modules\HRM\Entities\Employee;

class AccountHostelIntegrationService
{
    /**
     * @var HmJournalEntryService
     */
    private $hmJournalEntryService;
    /**
     * @var HostelBudgetTitleService
     */
    private $hostelBudgetTitleService;
    /**
     * @var HmCodeSettingService
     */
    private $hmCodeSettingService;

    public function __construct(
        HostelBudgetTitleService $hostelBudgetTitleService,
        HmCodeSettingService $hmCodeSettingService,
        HmJournalEntryService $hmJournalEntryService
    ) {
        $this->hostelBudgetTitleService = $hostelBudgetTitleService;
        $this->hmJournalEntryService = $hmJournalEntryService;
        $this->hmCodeSettingService = $hmCodeSettingService;
    }

    /**
     * This method is the home for handling Integration From Payslip
     * @param Payslip $payslip
     * @param array $journalEntryData
     * @param bool $autoVouch
     * @return array - after making changes, return the new journal entry data array
     * @throws \Exception
     */

    public function ignoreIntegrationCodeFromPayslip(
        Payslip $payslip,
        array $journalEntryData,
        $autoVouch = true
    ): array {
        try {
            $ignoredCodes = collect();
            $employee = $payslip->employee;
            $employeeStatus = $payslip->employee->status;
            $allEmployeeStatuses = Employee::getEmployeeStatus();
            $contingencyStatus = strtolower($allEmployeeStatuses['contingency']);
            $masterRollStatus = strtolower($allEmployeeStatuses['master roll']);
            $hostelDepartmentCode = $this->getHostelDepartmentCode();

            if (($employeeStatus == $contingencyStatus) || ($employeeStatus == $masterRollStatus)) {
                $basicSalaryEconomyCode = $this->getBasicSalaryEconomyCode();
                $employeeDepartment = $employee->employeeDepartment;
                if (!is_null($employeeDepartment)) {
                    if ($employeeDepartment->department_code == $hostelDepartmentCode) {
                        $hmCodeSettings = $this->hmCodeSettingService->findAll();
                        $ignoredCodes = $this->hmCodeSettingService->findAll()->pluck('economy_code');
                        $this->postBasicSalaryJournalEntryToHostel($hmCodeSettings, $payslip);
                    }
                }
            }
            if (!is_null($ignoredCodes)) {
                $journalEntryData['journal_entries'] = $this->removeIgnoredCodes($ignoredCodes->toArray(),
                    $journalEntryData['journal_entries']);
            }
            return $journalEntryData;
        } catch (\Exception $exception) {
            Log::error('Hm-Accounts Integration Error: ' . $exception->getMessage() . " Trace: " . $exception->getTraceAsString());
            Session::flash('error', $exception->getMessage());
            return $journalEntryData;
        }
    }

    public function getPayableCodeForBankCashEntry()
    {
        // todo:: we have to make this dynamic
        return HostelBudgetSection::where('show_in_report', '=', 0)->first();
    }

    //-----------------------------------------------------------------------------------------------------------------
    //                                          Private Methods
    //-----------------------------------------------------------------------------------------------------------------
    /**
     * @param bool $debitAccount
     * @param bool $creditAccount
     * @return mixed
     * @throws \Exception
     */
    private function getBasicSalaryEconomyCode($debitAccount = true, $creditAccount = false)
    {
        $salaryRule = $this->getBasicSalaryRule();
        if (is_null($salaryRule)) {
            throw new \Exception('Accounts Integration Error: Basic Salary Rule Not Found!');
        }
        if ($debitAccount) {
            return $salaryRule->debit_account;
        }
        if ($creditAccount) {
            return $salaryRule->credit_account;
        }
    }

    private function getBasicSalaryRule()
    {
        $code = SalaryRule::BASIC_SALARY_CODE;
        return SalaryRule::where('code', $code)->first();
    }

    private function removeIgnoredCodes(array $ignoredCodes, array $journalEntries): array
    {
        $journalEntries = collect($journalEntries);
        foreach ($ignoredCodes as $ignoredCode) {
            foreach ($journalEntries as $key => $value) {
                if ($value['economy_code'] == $ignoredCode) {
                    unset($journalEntries[$key]);
                    break;
                }
            }
        }
        return $journalEntries->toArray();
    }

    private function getHostelDepartmentCode()
    {
        return config('hm.code');
    }

    private function postBasicSalaryJournalEntryToHostel(
        $hmCodeSettings,
        Payslip $payslip,
        $autoVoucher = true
    ) {
        if (is_null($hmCodeSettings)) {
            throw  new \Exception('Hostel Code Setting Not Found !');
        }
        if ($autoVoucher) {
            $data = $this->prepareHostelJournalEntryData($payslip, $hmCodeSettings);
            $this->hmJournalEntryService->store($data);
        }
    }

    private function prepareHostelJournalEntryData(Payslip $payslip, $hmCodeSettings)
    {
        $totalBankCashPayment = 0;
        $payableCodeForBankCashEntry = $this->getPayableCodeForBankCashEntry();
        if (is_null($payableCodeForBankCashEntry)) {
            throw new \Exception("No Payable Code Found For Hostel Accounts Integration");
        }
        $helperArray = $this->getHostelCodeSettingsRelatedInfoFromPayslip($payslip);
        $data['hostel_budget_title_id'] = $this->hostelBudgetTitleService->getHostelBudgetTitleFromDate($payslip->period_from)->id;
        $data['date'] = Carbon::now()->format('Y-m-d');
        $data['journal_id'] = $hmCodeSetting->journal->id ?? null;
        $data['title'] = $payslip->payslip_name ?? '';
        // prepare journal entry details array
        $hmJournalEntryDetail = collect();
        foreach ($hmCodeSettings as $hmCodeSetting) {
            if (!array_key_exists($hmCodeSetting->economy_code, $helperArray)) {
                continue;
            }
            foreach ($hmCodeSetting->details as $detail) {
                $temp = collect();
                $temp['hostel_budget_section_id'] = $detail->hostel_budget_section_id;
                $temp['transaction_type'] = $helperArray[$hmCodeSetting->economy_code]['transaction_type'];
                $temp['credit_amount'] = $helperArray[$hmCodeSetting->economy_code]['credit_amount'] ?? 0.0;
                $temp['debit_amount'] = $helperArray[$hmCodeSetting->economy_code]['debit_amount'] ?? 0;
                $totalBankCashPayment += $helperArray[$hmCodeSetting->economy_code]['amount'] ?? 0;
                $temp['is_cash_book_entry'] = 0;
                $hmJournalEntryDetail[] = $temp;
            }
        }
        //prepare cash book entry array
        $data['hm_journal_entries'] = $hmJournalEntryDetail->toArray();

        //prepare cash book entry array
        $hmCashBookJournalEntryDetail = collect();
        $hmCashBookJournalEntryDetail['hostel_budget_section_id'] = $payableCodeForBankCashEntry->id;
        $hmCashBookJournalEntryDetail['transaction_type'] = HmJournalEntry::transactionTypes(true)[1]; // payment
        $hmCashBookJournalEntryDetail['credit_amount'] = $totalBankCashPayment;
        $hmCashBookJournalEntryDetail['debit_amount'] = 0.0;
        $hmCashBookJournalEntryDetail['is_cash_book_entry'] = 1;
        $hmCashBookJournalEntryDetail['payment_type'] = $this->getPaymentTypeForAutoVoucher();
        $data['cash_book_entries'] = $hmCashBookJournalEntryDetail->toArray();
        return $data;
    }

    private function getHostelBudgetTitleYear(Carbon $date)
    {
        return $this->hmJournalEntryService->getHostelBudgetTitleFromDate($date);
    }

    private function getBasicSalaryAmount(Payslip $payslip)
    {
        $salaryRule = $this->getBasicSalaryRule();
        return $payslip->payslipDetails->first(function ($item) use ($salaryRule) {
                return $item->salary_rule_id == $salaryRule->id;
            })->amount ?? 0;
    }

    private function getPaymentTypeForAutoVoucher($cash = false, $bank = true)
    {
        if ($bank) {
            return HmJournalEntry::paymentTypes(true)[0];
        }
        if ($cash) {
            return HmJournalEntry::paymentTypes(true)[1];
        }
    }

    private function getHostelCodeSettingsRelatedInfoFromPayslip(Payslip $payslip): array
    {
        $helperArray = array();
        $economyCodes = $this->hmCodeSettingService->findAll()->pluck('economy_code');
        foreach ($payslip->payslipDetails as $payslipDetail) {
            $salaryRule = $payslipDetail->salaryRule;
            // as the debit and credit has same economy code, taking just one
            $salaryEconomyCode = optional($salaryRule->debit_economy_code)->code
                ? optional($salaryRule->debit_economy_code)->code
                : optional($salaryRule->credit_economy_code)->code;

            if (is_null($salaryEconomyCode)) {
                continue;
            }
            if (in_array($salaryEconomyCode, $economyCodes->toArray())) {
                if ($salaryRule->salaryCategory->name != SalaryCategory::SALARY_CATEGORY_DEDUCTION) {
                    // its allowance --> payment --> debit
                    $helperArray[$salaryEconomyCode] = array();
                    $helperArray[$salaryEconomyCode]['transaction_type'] = HmJournalEntry::transactionTypes(true)[1];

                    $helperArray[$salaryEconomyCode]['debit_amount'] = $payslipDetail->amount ?? 0.0;
                    $helperArray[$salaryEconomyCode]['credit_amount'] = 0.0;
                    $helperArray[$salaryEconomyCode]['amount'] = $payslipDetail->amount;
                } else {
                    // receive --> credit_amount
                    $helperArray[$salaryEconomyCode] = array();
                    $helperArray[$salaryEconomyCode]['transaction_type'] = HmJournalEntry::transactionTypes(true)[0];
                    $helperArray[$salaryEconomyCode]['credit_amount'] = $payslipDetail->amount ?? 0.0;
                    $helperArray[$salaryEconomyCode]['debit_amount'] = 0.0;
                    $helperArray[$salaryEconomyCode]['amount'] = 0 - $payslipDetail->amount; // changing the sign
                }
            }
        }
        return $helperArray;
    }

}

