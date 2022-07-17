<?php

namespace Modules\Accounts\Services;

use Illuminate\Support\Facades\DB;
use Modules\HRM\Services\EmployeeService;

class EmployeePromotionControllerService
{
    /**
     * @var EmployeeService
     */
    private $employeeService;
    /**
     * @var PayscaleService
     */
    private $payscaleService;
    /**
     * @var EmployeeContractService
     */
    private $employeeContractService;

    public function __construct(
        EmployeeService $employeeService,
        PayscaleService $payscaleService,
        EmployeeContractService $employeeContractService
    ) {
        $this->employeeService = $employeeService;
        $this->payscaleService = $payscaleService;
        $this->employeeContractService = $employeeContractService;
    }

    public function getEmployees()
    {
        $employees = $this->employeeService->findAll();
        $employees = $employees->filter(function ($e) {
            return $e->employeeContract;
        })->map(function ($e) {
            $e->designation = $e->designation->getName();
            $e->department = $e->employeeDepartment->name ?? trans('labels.not_found');
            $e->current_salary_grade = $e->employeeContract->salary_grade ?? trans('labels.not_found');
            $e->current_increment_no = $e->employeeContract->increment ?? trans('labels.not_found');
            $e->next_increment_no = $this->payscaleService->nextApplicableIncrement($e->current_salary_grade,
                $e->current_increment_no);
            $maxIncrementNumber = $this->payscaleService->salaryMaxIncrement($e->current_salary_grade);
            $incrementArray = [];
            for ($i = 0; $i <= $maxIncrementNumber; $i++) {
                $incrementArray[$i] = $i;
            }
            $e->totalIncrements = $incrementArray;
            return $e;
        });
        //todo:: php has a limit of total form fields, the index page must need a filter
        return $employees->take(200);
    }

    public function getSalaryGrades()
    {
        return $this->payscaleService->getSalaryBasicsForDropdown();
    }

    public function updateData(array $data)
    {
        try {
            DB::beginTransaction();
            $employees = $data['employees'];
            foreach ($employees as $employee) {
                if (!isset($employee['selected'])) {
                    continue;
                }
                $employeeContract = $this->getEmployeeContract($employee['employee_id']);
                if ($this->isUpdateRequired($employee, $employeeContract)) {
                    $this->employeeContractService->update($employeeContract, [
                        'salary_grade' => $employee['salary_grade'],
                        'increment' => $employee['increment']
                    ]);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
    }

    //-----------------------------------------------------------------------------------------------------------------
    //                                          Private Function
    //------------------------------------------------------------------------------------------------------------------
    private function isUpdateRequired($employee, $employeeContract)
    {
        try {
            if ($employeeContract->salary_grade == $employee['salary_grade']) {
                if ($employeeContract->increment == $employee['increment']) {
                    return false;
                }
                return true;
            }
        } catch (\Exception $exception) {
            dd($employee);
        }


        return true;
    }

    private function getEmployeeContract($employeeId)
    {
        return $this->employeeContractService->findBy(['employee_id' => $employeeId])->first();
    }
}

