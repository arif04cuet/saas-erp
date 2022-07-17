<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Modules\Accounts\Repositories\GpfLoanDepositRepository;
use Modules\Accounts\Repositories\GpfLoanRepository;
use Modules\Accounts\Repositories\GpfRecordRepository;
use Modules\Accounts\Repositories\PayslipRepository;
use Modules\Accounts\Repositories\SalaryRuleRepository;

class GpfLoanService
{
    use CrudTrait;

    private $gpfLoanRepository;
    /**
     * @var GpfRecordRepository
     */
    private $gpfRecordRepository;
    /**
     * @var PayslipRepository
     */
    private $payslipRepository;
    /**
     * @var SalaryRuleRepository
     */
    private $salaryRuleRepository;
    /**
     * @var GpfLoanDepositRepository
     */
    private $gpfLoanDepositRepository;

    /**
     * GpfLoanService constructor.
     * @param GpfLoanRepository $gpfLoanRepository
     * @param GpfRecordRepository $gpfRecordRepository
     * @param PayslipRepository $payslipRepository
     * @param SalaryRuleRepository $salaryRuleRepository
     * @param GpfLoanDepositRepository $gpfLoanDepositRepository
     */
    public function __construct(
        GpfLoanRepository $gpfLoanRepository,
        GpfRecordRepository $gpfRecordRepository,
        PayslipRepository $payslipRepository,
        SalaryRuleRepository $salaryRuleRepository,
        GpfLoanDepositRepository $gpfLoanDepositRepository
    ) {
        $this->gpfLoanRepository = $gpfLoanRepository;
        $this->setActionRepository($gpfLoanRepository);
        $this->gpfRecordRepository = $gpfRecordRepository;
        $this->payslipRepository = $payslipRepository;
        $this->salaryRuleRepository = $salaryRuleRepository;
        $this->gpfLoanDepositRepository = $gpfLoanDepositRepository;
    }

    public function saveData($data)
    {
        $data['sanction_date'] = Carbon::parse($data['sanction_date'])->format('Y-m-d');
        return $this->save($data);
    }

    public function updateData($data, $id)
    {
        $loan = $this->findOrFail($id);
        if (!is_null($loan)) {
            $data['sanction_date'] = Carbon::parse($data['sanction_date'])->format('Y-m-d');
            $loan->update($data);
            return true;
        }
        return false;
    }

    public function getMaxLoanLimit($employeeId)
    {
        $gpfLoans = $this->findBy(['employee_id' => $employeeId]);
        $totalLoan = 0;
        foreach ($gpfLoans as $gpfLoan) {
            $totalLoan += $gpfLoan->current_balance;
        }

        $gpfBalance = $this->gpfRecordRepository
            ->findBy(['employee_id' => $employeeId])
            ->pluck('stock_balance')
            ->first();

        return ($gpfBalance * .80) - $totalLoan;
    }

    public function getEmployeesWithLoan()
    {
        return $this->gpfLoanRepository->findAll()->unique('employee_id');
    }

    public function getGpfAdvancedFromEmployeeId($employeeId)
    {
        $gpfaId = $this->salaryRuleRepository->getRuleByCodes([config('constants.gpf_advance_code')])
            ->pluck('id')
            ->first();
        $loanPayments = [];
        $advanceReturns = $this->payslipRepository->getPayslipAmountsFromSalaryRules($employeeId, [$gpfaId])
            ->reject(function ($item) {
                return $item->amount == 0;
            });
        $deposits = $this->getAllDeposits($employeeId);
        foreach ($advanceReturns as $advanceReturn) {
            $month = Carbon::parse($advanceReturn->period_from)->format('Y-n');
            $loanPayments[$month] = [
              'advance_return' => $advanceReturn->amount,
              'deposit' => '',
            ];
        }
        $initMonth = "";
        $monthlyDeposit = 0;
        foreach ($deposits as $key => $deposit) {
            $month = Carbon::parse($deposit->deposit_date)->format('Y-n');
            if ($initMonth == $month) {
                $monthlyDeposit += $deposit->amount;
            } else {
                $initMonth = $month;
                $monthlyDeposit = $deposit->amount;
            }
            $loanPayments[$month] =  isset($loanPayments[$month])? array_merge($loanPayments[$month], ['deposit' => $monthlyDeposit ]):
                ['advance_return' => '', 'deposit' => $monthlyDeposit];
        }
        return $loanPayments;
    }

    public function deductFromLoan($loanId, $amount)
    {
        $loan = $this->findOne($loanId);
        $adjustedAmount = $loan->current_balance - $amount;
        $loan->update(['current_balance' => $adjustedAmount]);
        return $adjustedAmount;
    }

    public function getLoans($employeeId)
    {
        $loans = $this->findBy(['employee_id' => $employeeId]);
        $loansByMonths = [];
        foreach ($loans as $loan) {
            $sanctionMonth = Carbon::parse($loan->sanction_date)->format('Y-n');
            if (!empty($loansByMonths[$sanctionMonth])) {
                $loansByMonths[$sanctionMonth] += $loan->amount;
            } else {
                $loansByMonths[$sanctionMonth] = $loan->amount;
            }
        }
        return $loansByMonths;
    }

    public function getAllDeposits($employeeId)
    {
        return $this->gpfLoanDepositRepository->getAllDepositsByEmployeeId($employeeId);
    }
}

