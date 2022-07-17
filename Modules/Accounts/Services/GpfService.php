<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use App\Utilities\EnToBnNumberConverter;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Accounts\Entities\GpfHistory;
use Modules\Accounts\Entities\GpfLoan;
use Modules\Accounts\Entities\GpfMonthlyRecord;
use Modules\Accounts\Entities\GpfRecord;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Repositories\EmployeeContractAssignedRuleRepository;
use Modules\Accounts\Repositories\EmployeeContractRepository;
use Modules\Accounts\Repositories\GpfLoanRepository;
use Modules\Accounts\Repositories\GpfRecordRepository;
use Modules\Accounts\Repositories\PayslipDetailRepository;
use Modules\Accounts\Repositories\PayslipRepository;
use Modules\Accounts\Repositories\SalaryRuleRepository;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Entities\EmployeeTraining;
use PhpOffice\PhpWord\TemplateProcessor;

class GpfService
{
    use CrudTrait;

    private $gpfRecordRepository;
    private $salaryRuleRepository;
    private $payslipRepository;
    private $payslipDetailsRepository;
    private $gpfLoanRepository;
    /**
     * @var PayslipDetailRepository
     */
    private $payslipDetailRepository;
    /**
     * @var GpfConfigurationService
     */
    private $gpfConfigurationService;
    /**
     * @var EmployeeContractRepository
     */
    private $employeeContractRepository;
    /**
     * @var PayscaleService
     */
    private $payscaleService;
    /**
     * @var EmployeeContractAssignedRuleRepository
     */
    private $employeeContractAssignedRuleRepository;


    /**
     * GpfService constructor.
     * @param GpfRecordRepository $gpfRecordRepository
     * @param SalaryRuleRepository $salaryRuleRepository
     * @param PayslipRepository $payslipRepository
     * @param PayslipDetailRepository $payslipDetailRepository
     * @param GpfLoanRepository $gpfLoanRepository
     * @param GpfConfigurationService $gpfConfigurationService
     * @param EmployeeContractRepository $employeeContractRepository
     * @param EmployeeContractAssignedRuleRepository $employeeContractAssignedRuleRepository
     * @param PayscaleService $payscaleService
     */
    public function __construct(
        GpfRecordRepository $gpfRecordRepository,
        SalaryRuleRepository $salaryRuleRepository,
        PayslipRepository $payslipRepository,
        PayslipDetailRepository $payslipDetailRepository,
        GpfLoanRepository $gpfLoanRepository,
        GpfConfigurationService $gpfConfigurationService,
        EmployeeContractRepository $employeeContractRepository,
        EmployeeContractAssignedRuleRepository $employeeContractAssignedRuleRepository,
        PayscaleService $payscaleService
    ) {
        $this->gpfRecordRepository = $gpfRecordRepository;
        $this->salaryRuleRepository = $salaryRuleRepository;
        $this->payslipRepository = $payslipRepository;

        $this->setActionRepository($gpfRecordRepository);
        $this->payslipDetailRepository = $payslipDetailRepository;
        $this->gpfLoanRepository = $gpfLoanRepository;
        $this->gpfConfigurationService = $gpfConfigurationService;
        $this->employeeContractRepository = $employeeContractRepository;
        $this->payscaleService = $payscaleService;
        $this->employeeContractAssignedRuleRepository = $employeeContractAssignedRuleRepository;
    }

    public function saveData($data)
    {
        DB::transaction(function () use ($data) {
            $data['start_date'] = date('Y-m-d', strtotime($data['start_date']));
            $data['status'] = 'active';
            $save = $this->save($data);
            $this->saveGpfHistory($save->employee_id, $save->current_percentage, false);

            // Updating gpf deduction amount in employee
            $this->updateGpfAmountInContract($save->employee_id, $save->current_percentage);
        });
    }

    public function updateData($data, GpfRecord $gpfRecord)
    {
        DB::transaction(function () use ($data, $gpfRecord) {
            if(isset($data['start_date'])) $data['start_date'] = date('Y-m-d', strtotime($data['start_date']));
            $gpfRecord->update($data);
            $this->saveGpfHistory($gpfRecord->employee_id, $gpfRecord->current_percentage, false);
            // Updating gpf deduction amount in employee
            $this->updateGpfAmountInContract($gpfRecord->employee_id, $gpfRecord->current_percentage);
        });
    }

    public function updateGpfAmountInContract($employeeId, $gpfPercentage)
    {
        $contract = $this->employeeContractRepository->findBy(['employee_id' => $employeeId])->first();
        $salaryBasic = $this->payscaleService->getBasicSalary($contract->salary_grade, $contract->increment);
        $amount = round(($salaryBasic * $gpfPercentage) / 100);
        $gpfRule = $this->getGpfRule();
        $this->employeeContractAssignedRuleRepository->findBy([
            'employee_contract_id' => $contract->id,
            'salary_rule_id' => $gpfRule->id
        ])->first()->update(['amount' => $amount]);
    }

    public function saveGpfHistory($employeeId, $gpfPercentage, $updateGpfRecord = true)
    {
        $checkExisting = GpfHistory::where('employee_id', $employeeId)
            ->where('status', 1)
            ->first();
        if ($checkExisting && $checkExisting->percentage == $gpfPercentage) {
            return 0;
        } else {
            $updateHistory = GpfHistory::where('employee_id', $employeeId)->update(['status' => 0]);
            $gpfRecord = $this->findBy(['employee_id' => $employeeId])->first();
            if($updateGpfRecord && $gpfRecord)
                $this->update($gpfRecord, ['current_percentage' => $gpfPercentage]);

            $gpf = new GpfHistory;
            $gpf->employee_id = $employeeId;
            $gpf->percentage = $gpfPercentage;
            $gpf->status = 1;

            return $gpf->save();
        }
    }

    /**
     * Saves gpf monthly record that calls every time while payslip runs
     * @param $payslipId
     */
    public function saveGpfMonthlyRecord($payslipId)
    {
        DB::transaction(function () use ($payslipId) {
            $payslip = $this->payslipRepository->findOne($payslipId);
            // Gpf deduction will be the next month of a particular payslip month
            $gpfMonth = Carbon::parse($payslip->period_from)->addDays(35)->format('Y-m-01');
            $gpf = $this->findBy(['employee_id' => $payslip->employee_id])->first();
            if (empty($gpf) || $gpf->status != 'active') {
                return 0;
            }
            $gpfRules = $this->salaryRuleRepository->getGpfRules()->pluck('id', 'code')->toArray();
            $gpfRuleIds = [$gpfRules['GPFC'], $gpfRules['GPFA']];
            $payslipDetail = $this->payslipDetailRepository->getDetailsWithRuleAndPayslipId($gpfRuleIds, [$payslipId])
                ->pluck('amount', 'salary_rule_id');
            $gpfAmount = $payslipDetail[$gpfRules['GPFC']];
            $gpfAdvancedAmount = $payslipDetail[$gpfRules['GPFA']];
            $gpfCalculation = $this->calculateInterestAndBalance($gpfAmount, $gpfAdvancedAmount, $payslip, $gpf);
            // Updating current balance in Gpf record
            $gpf->update(['current_balance' => $gpfCalculation['gpf_balance']]);

            // Saving new monthly record for the payslip that has just created
            $monthlyRecord = new GpfMonthlyRecord;
            $monthlyRecord->employee_id = $payslip->employee_id;
            $monthlyRecord->payslip_id = $payslip->id;
            $monthlyRecord->gpf_stock_amount = $gpf->stock_balance;
            $monthlyRecord->gpf_amount = $gpfAmount;
            $monthlyRecord->gpf_advanced_amount = $gpfAdvancedAmount;
            $monthlyRecord->interest = $gpfCalculation['interest'];
            $monthlyRecord->gpf_balance = $gpfCalculation['gpf_balance'];
            $monthlyRecord->loan_balance = $gpfCalculation['loan_balance'];
            $monthlyRecord->month = date('Y-n', strtotime($gpfMonth));
            $save = $monthlyRecord->save();

            if (date('n', strtotime($gpfMonth)) == 6) {
                $gpfCurrentBalance = $gpfCalculation['gpf_balance'] - $gpfCalculation['loan_balance'];
                $gpfCalculation['loan_balance'] = 0;
                $gpf->update([
                    'stock_balance' => $gpfCurrentBalance,
                    'current_balance' => $gpfCurrentBalance,
                ]);
                GpfLoan::where('employee_id', $payslip->employee_id)
                    ->where('sanction_date', '<=', $payslip->period_to)
                    ->update(['current_balance' => $gpfCalculation['loan_balance']]);
            }
            return $save;

        });
    }

    public function getGpfRule()
    {
        return $this->salaryRuleRepository->findBy(['code' => 'GPFC'])->first();
    }

    public function getGpfPercentage($employeeId)
    {
        $gpfPercentage = $this->findBy(['employee_id' => $employeeId])->pluck('current_percentage')->first();
        if(!$gpfPercentage) {
            $gpfPercentage = GpfHistory::where('employee_id', $employeeId)
                ->where('status', 1)
                ->pluck('percentage')
                ->first();
        }

        return $gpfPercentage;
    }

    /**
     * Fetch employee's overall GPF ledger with calculation for each tenure
     * @param $employeeId
     * @param null $yearFrom
     * @param null $yearTo
     * @return array
     */
    public function getPersonalLedger($employeeId, $yearFrom = null, $yearTo = null)
    {
        $dateRange = $this->generateFiscalFromAndToDate($yearFrom, $yearTo);
        $from = $dateRange['from'];
        $to = $dateRange['to'];
        $from = Carbon::parse($from)->addMonth(-1)->format('Y-m-01');
        $to = Carbon::parse($to)->addMonth(-1)->format('Y-m-t');
        $payslips = $this->payslipRepository->getPayslipsFromEmployeeId($employeeId, $from, $to);
        $personalLedger = $this->preparePersonalLedger($payslips);
        $fiscalYears = $this->generateMonths($yearFrom, $yearTo);
        $personalFiscalYearsLedger = [];
        foreach ($fiscalYears as $step => $months) {
            foreach ($months as $month) {
                if(isset($personalLedger[$month])) {
                    $ledger = $personalLedger[$month];

                } else {
                    $ledger = [];
                }
                $personalFiscalYearsLedger[$step][$month] = $ledger;
            }
        }
        return $personalFiscalYearsLedger;
    }

    /**
     * @param $payslips
     * @return array
     */
    public function preparePersonalLedger($payslips)
    {
        $ledgerData = [];
        foreach ($payslips as $payslip) {
            $ledger = $payslip->gpfMonthlyRecord;
            if($ledger) {
                $ledgerData[$ledger->month] = [
                    'gpf_stock_amount' => $ledger->gpf_stock_amount,
                    'gpf_amount' => $ledger->gpf_amount,
                    'gpf_advanced_amount' => $ledger->gpf_advanced_amount,
                    'interest' => $ledger->interest,
                    'gpf_balance' => $ledger->gpf_balance,
                    'loan_balance' => $ledger->loan_balance,
                ];
            }
        }
        return $ledgerData;
    }

    /**
     * Calculate interest for each month according to GPF Contribution and GPF Loan Installment
     * @param $gpfAmount
     * @param $gpfAdvancedAmount
     * @param Payslip $payslip
     * @param GpfRecord $gpf
     * @return array
     */
    public function calculateInterestAndBalance($gpfAmount, $gpfAdvancedAmount, Payslip $payslip, GpfRecord $gpf)
    {
        //$payslipMonth = date('n', strtotime($payslip->period_to));
        $payslipMonth = Carbon::parse($payslip->period_from)->addMonth(1)->format('n');
        $yearSumDigit = config('constants.year_sum_digit.'.$payslipMonth);
        $gpfConfiguration = $this->gpfConfigurationService->getActiveConfiguration();
        $gpfPercentage = $gpfConfiguration->gpf_interest_percentage;
        $interestOnStock = ($gpf->stock_balance * $gpfPercentage) / 1200;
        $interestOnContribution = ((($gpfAmount + $gpfAdvancedAmount) * $gpfPercentage) / 1200) * $yearSumDigit;
        $totalInterest = $interestOnStock + $interestOnContribution;

        // Calculating gpf loan if any
        $gpfLoans = $this->gpfLoanRepository->findBy(['employee_id' => $payslip->employee_id]);
        $gpfLoanAmountTotal = 0;
        foreach ($gpfLoans as $gpfLoan) {
            if (strtotime($payslip->period_from) >= strtotime($gpfLoan->sanction_date)) {
                $gpfLoanAmountTotal += $gpfLoan->current_balance;
            }
        }
        if ($gpfLoanAmountTotal) {
            $gpfLoanPercentage = $gpfConfiguration->gpf_loan_interest_percentage;;
            $loanInterest = ($gpfLoanAmountTotal * $gpfLoanPercentage) / 1200;
            $totalInterest -= $loanInterest;
        }
        $gpfBalance = $gpf->current_balance + $totalInterest + $gpfAmount + $gpfAdvancedAmount;
//        if ($payslipMonth == 6) {
//            $gpfBalance -= $gpfLoanAmountTotal;
//            $gpfLoanAmountTotal = 0;
//        }
        // TODO:: Revise gpf balance calculation
        return [
            'interest' => round($totalInterest),
            'gpf_balance' => round($gpfBalance),
            'loan_balance' => $gpfLoanAmountTotal
        ];
    }

    /**
     * Retrieves fiscal from and to date within the given year range
     * @param null $yearFrom
     * @param null $yearTo
     * @return array
     */
    public function generateFiscalFromAndToDate($yearFrom = null, $yearTo = null)
    {
        $thisYear = date('Y');
        $thisMonth = date('n');
        if (is_null($yearFrom)) {
            $yearFrom = ($thisMonth > 6)? $thisYear : $thisYear - 1;
        }
        if (is_null($yearTo)) {
            $yearTo = $yearFrom + 1;
        }
        if ($yearFrom == $yearTo) {
            return ['from' => ($yearFrom).'-07-01', 'to' => ($yearTo + 1).'-06-30'];
        } elseif ($yearFrom < $yearTo) {
            return ['from' => ($yearFrom).'-07-01', 'to' => ($yearTo + 1).'-06-30'];
        } else {
            return ['from' => '', 'to' => ''];
        }
    }

    /**
     * generates and retrieves an array of months within the given fiscal year range
     * @param null $yearFrom
     * @param null $yearTo
     * @return array
     */
    public function generateMonths($yearFrom = null, $yearTo =null)
    {
        if ($yearFrom > $yearTo) {
            return [];
        }
        $thisYear = date('Y');
        if (is_null($yearFrom)) {
            $yearFrom = $thisYear;
        }
        if (is_null($yearTo)) {
            $yearTo = $thisYear;
        }
        $months = [];
        $step = 1;
        for ($count = $yearFrom; $count <= $yearTo; $count++) {
            $preMonths = range(7, 12);
            array_walk($preMonths, function (& $item, $key) use ($count) {
                $item = $count.'-'.$item;
            });
            $postMonths = range(1, 6);
            array_walk($postMonths, function (& $item, $key) use ($count) {
                $item = ($count+1).'-'.$item;
            });
            $fiscalMonths = array_merge($preMonths, $postMonths);
            $months[$step++] = $fiscalMonths;
        }

        return $months;
    }

    public function fetchMonthlyRecords($employeeId, $from, $to)
    {
        $payslips = $this->payslipRepository->getPayslipsFromEmployeeId($employeeId, $from, $to);
        $monthlyRecords = [];
        foreach ($payslips as $payslip) {
            $monthlyRecord = $payslip->gpfMonthlyRecord ?? null;
            if ($monthlyRecord) {
                $monthlyRecords[$monthlyRecord->month] = $monthlyRecord;
            }
        }
        return $monthlyRecords;
    }

    public function confirmSettlement($data, $id)
    {
        $gpf = $this->findOrFail($id);
        $data['status'] = config('constants.gpf_status')[2];
        $data['settlement_date'] = date('Y-m-d', strtotime($data['settlement_date']));
        $data['current_balance'] = $data['stock_balance'];
        $gpf->update($data);
    }

    /**
     * Generates and returns an array of gpf related calculated data for a particular fiscal year
     * @param $employeeId
     * @param null $year
     * @return array
     */
    public function generateStatement($employeeId, $year = null)
    {
        if (is_null($year)) {
            $year = date('Y');
        }
        $dateRange = $this->generateFiscalFromAndToDate($year, $year);
        $gpfMonthlyRecords = $this->fetchMonthlyRecords($employeeId, $dateRange['from'], $dateRange['to']);
        $totalLoan = $this->gpfLoanRepository->fetchLoansBetweenRange(
            $employeeId,
            $dateRange['from'],
            $dateRange['to']
        )->sum('amount');
        $totalContribution = 0;
        $totalAdvanced = 0;
        $totalInterest = 0;
        $stockBalance = 0;
        foreach ($gpfMonthlyRecords as $gpfMonthlyRecord) {
            $stockBalance = $gpfMonthlyRecord->gpf_stock_amount;
            $totalContribution += $gpfMonthlyRecord->gpf_amount;
            $totalAdvanced += $gpfMonthlyRecord->gpf_advanced_amount;
            $totalInterest += $gpfMonthlyRecord->interest;
        }
        $nextFrom = Carbon::parse($dateRange['to'])->addMonth(0)->format('Y-m-01');
        $nextTo = Carbon::parse($dateRange['to'])->addMonth(0)->format('Y-m-t');
        $nextMonthPayslip = $this->payslipRepository->getPayslipsFromEmployeeId($employeeId, $nextFrom, $nextTo)
                ->first()?? null;
        $nextMonthGpf = (!is_null($nextMonthPayslip))? $nextMonthPayslip->gpfMonthlyRecord : null;
        $yearEndStock = (is_null($nextMonthGpf))? $stockBalance : $nextMonthGpf->gpf_stock_amount;

        return [
            'stock_balance' => $stockBalance,
            'gpf_contribution' => $totalContribution,
            'gpf_advanced'=> $totalAdvanced,
            'interest' => $totalInterest,
            'advance_given' => (double)$totalLoan,
            'year_end_stock' => $yearEndStock
        ];
    }

    public function generateDoc($data)
    {
        $gpf = $data[0];
        $employee = $data[1];
        $year = $data[2];
        $statement = $this->generateStatement($employee->id, $year);

        $template = storage_path().'/files/templates/gpf-statement-template.docx';
        $templateProcessor = new TemplateProcessor($template);

        $templateValues = [
            'year' => EnToBnNumberConverter::en2bn($year, false),
            'nextYear' => EnToBnNumberConverter::en2bn($year + 1, false),
            'fundNo' => $gpf->fund_number,
            'name' => $employee->getName(),
            'designation' => $employee->getDesignation(),
            'interestPercentage' => EnToBnNumberConverter::en2bn($gpf->current_percentage),
            'prevYear' => EnToBnNumberConverter::en2bn($year - 1, false),
            'stockBalance' => EnToBnNumberConverter::en2bn($statement['stock_balance']),
            'gpfContribution' => EnToBnNumberConverter::en2bn($statement['gpf_contribution']),
            'advanceReturn' => EnToBnNumberConverter::en2bn($statement['gpf_advanced']),
            'interest' => EnToBnNumberConverter::en2bn($statement['interest']),
            'advanceGiven' => EnToBnNumberConverter::en2bn($statement['advance_given']),
            'yearEndStock' => EnToBnNumberConverter::en2bn($statement['year_end_stock']),
            'amountInWord' => EnToBnNumberConverter::numberToBanglaWords($statement['year_end_stock'])
        ];

        foreach ($templateValues as $key => $templateValue){
            $templateProcessor->setValue($key, $templateValue);
        }

        $fileName = storage_path().'/files/temps/'.$employee->employee_id.'_gpf_statement.docx';
        $templateProcessor->saveAs($fileName);
    }

    public function getActiveGpfPercentage(Employee $employee)
    {
        $gpfPercentage = $this->findBy(['employee_id' => $employee->id, 'status' => 'active'])->first();
        return is_null($gpfPercentage) ? 0 : $gpfPercentage->current_percentage;
    }
}

