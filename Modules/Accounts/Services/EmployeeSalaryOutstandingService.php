<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\Accounts\Entities\EmployeeSalaryOutstanding;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Entities\SalaryRule;
use Modules\Accounts\Repositories\EmployeeSalaryOutstandingRepository;
use Modules\HRM\Entities\Employee;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\This;

class EmployeeSalaryOutstandingService
{
    use CrudTrait;

    public function __construct(
        EmployeeSalaryOutstandingRepository $employeeSalaryOutstandingRepository
    ) {
        $this->setActionRepository($employeeSalaryOutstandingRepository);
    }

    public function saveData(array $outstandingData, $employeeId)
    {
        if (is_null($employeeId)) {
            return;
        }
        foreach ($outstandingData as $data) {
            if ($this->isValidData($data)) {
                $data['employee_id'] = $employeeId;
                $this->actionRepository->save($data);
            }
        }
    }

    public function updateData(array $data, Employee $employee)
    {
        DB::transaction(function () use ($data, $employee) {
            // delete all the active records
            $employee->salaryOutstandings()->where('status', EmployeeSalaryOutstanding::STATUS[1])->delete();
            // re-create from the data
            if (isset($data['outstanding']) && !is_null($data['outstanding'])) {
                $this->saveData($data['outstanding'], $employee->id);
            }
        });
    }

    private function isValidData($data): bool
    {
        if (!isset($data['salary_rule_id']) || is_null($data['salary_rule_id'])) {
            return false;
        }
        if (!isset($data['month']) || is_null($data['month'])) {
            return false;
        }
        return true;
    }

    /**
     * @param Payslip $payslip
     * @return mixed
     */
    public function getAllPendingSalaryOutstandingOfPayslip(Payslip $payslip)
    {
        return $this->actionRepository->getModel()::where('employee_id', $payslip->employee_id)
            ->where('status', EmployeeSalaryOutstanding::STATUS[1])
            ->whereYear('month', $payslip->period_to->year)
            ->whereMonth('month', $payslip->period_to->month)
            ->get();
    }

    /**
     * @param Payslip $payslip
     * @return mixed
     */
    public function getAllProcessedSalaryOutstandingOfPayslip(Payslip $payslip)
    {
        return $this->actionRepository->getModel()::where('employee_id', $payslip->employee_id)
            ->where('status', EmployeeSalaryOutstanding::STATUS[0])
            ->whereYear('month', $payslip->period_to->year)
            ->whereMonth('month', $payslip->period_to->month)
            ->get();
    }


    /**
     * @param Payslip $payslip
     * @param SalaryRule $salaryRule
     * @return mixed
     */

    public function getOutstandingOfSalaryRule(Payslip $payslip, SalaryRule $salaryRule)
    {
        return $this->actionRepository->getModel()::where('employee_id', $payslip->employee_id)
            ->where('salary_rule_id', $salaryRule->id)
            ->where('status', EmployeeSalaryOutstanding::STATUS[1])
            ->whereYear('month', $payslip->period_to->year)
            ->whereMonth('month', $payslip->period_to->month)
            ->get();
    }

    public function makeOutstandingRuleInactive(EmployeeSalaryOutstanding $employeeSalaryOutstanding)
    {
        return $this->update($employeeSalaryOutstanding, ['status' => EmployeeSalaryOutstanding::STATUS[0]]);
    }
}

