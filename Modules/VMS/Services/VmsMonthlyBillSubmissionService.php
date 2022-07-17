<?php

namespace Modules\VMS\Services;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Accounts\Services\EmployeeSalaryOutstandingService;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Services\EmployeeService;
use Modules\VMS\Entities\Trip;

class VmsMonthlyBillSubmissionService
{
    /**
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * @var VmsBillSectorSubmissionService
     */
    private $vmsBillSectorSubmissionService;
    /**
     * @var TripService
     */
    private $tripService;
    /**
     * @var TripBillPaymentService
     */
    private $tripBillPaymentService;
    /**
     * @var VmsIntegrationSettingService
     */
    private $vmsIntegrationSettingService;
    /**
     * @var EmployeeSalaryOutstandingService
     */
    private $employeeSalaryOutstandingService;


    /**
     * VmsMonthlyBillSubmissionService constructor.
     * @param EmployeeService $employeeService
     * @param TripService $tripService
     * @param TripBillPaymentService $tripBillPaymentService
     * @param VmsBillSectorSubmissionService $vmsBillSectorSubmissionService
     * @param EmployeeSalaryOutstandingService $employeeSalaryOutstandingService
     * @param VmsIntegrationSettingService $vmsIntegrationSettingService
     */
    public function __construct(
        EmployeeService $employeeService,
        TripService $tripService,
        TripBillPaymentService $tripBillPaymentService,
        VmsBillSectorSubmissionService $vmsBillSectorSubmissionService,
        EmployeeSalaryOutstandingService $employeeSalaryOutstandingService,
        VmsIntegrationSettingService $vmsIntegrationSettingService
    ) {
        $this->employeeService = $employeeService;
        $this->tripService = $tripService;
        $this->employeeSalaryOutstandingService = $employeeSalaryOutstandingService;
        $this->tripBillPaymentService = $tripBillPaymentService;
        $this->vmsIntegrationSettingService = $vmsIntegrationSettingService;
        $this->vmsBillSectorSubmissionService = $vmsBillSectorSubmissionService;
    }


    public function getEmployees()
    {
        $employees = $this->employeeService->findAll();
        return $this->employeeService->getEmployeesSortedByDesignationAndServicePeriod($employees);
    }

    public function calculateEmployeeBills(Collection $employees, Carbon $date)
    {
        return $employees->each(function ($employee) use ($date) {
            $employee->trip_bill = $this->tripService->calculatePendingTripAmountOfEmployee($employee, $date);
            $employee->fixed_bill = $this->vmsBillSectorSubmissionService->calculatePendingFixedAmountOfEmployee($employee,
                $date);
            return $employee;
        });
    }

    public function submitBill(array $data)
    {
        try {
            DB::beginTransaction();
            $date = Carbon::parse($data['date']);
            $tripPaymentOptions = Trip::getPaymentStatus();
            $employees = $this->getEmployees();
            $employees = $this->calculateEmployeeBills($employees, $date);
            foreach ($employees as $employee) {
                $tripBill = $employee->trip_bill;
                $fixedBill = $employee->fixed_bill;
                $totalBill = $tripBill['pending_trip_bill'] + $fixedBill['pending_fixed_bill'];
                // foreach trip bill save the details and change status
                foreach ($tripBill['details'] as $detail) {
                    // table: vms_bill_sector_submission
                    $this->tripBillPaymentService->save([
                        'trip_id' => $detail['trip_id'],
                        'payment_option' => $employee->id,
                        'amount' => $detail['trip_bill'],
                        'status' => $tripPaymentOptions['paid']
                    ]);
                }
                if (!$fixedBill['pending_fixed_bill']) {
                    continue;
                }
                // foreach fixed bill save the details
                foreach ($fixedBill['details'] as $detail) {
                    // ignore where amount is zero
                    // table: vms_bill_sector_submission
                    if (!$detail['fixed_bill']) {
                        continue;
                    }
                    $this->vmsBillSectorSubmissionService->save([
                        'vms_bill_sector_id' => $detail['vms_bill_sector_id'],
                        'employee_id' => $employee->id,
                        'date' => $date->format('Y-m-d'),
                        'amount' => $detail['fixed_bill']
                    ]);
                }
                // create outstanding bill to their payroll
                $this->addMonthlyBillAsSalaryOutstanding($employee, $totalBill, $date);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Vehicle Monthly Bill Submission Error: ' . $exception->getMessage());
            return false;
        }
    }

    public function addMonthlyBillAsSalaryOutstanding(Employee $employee, $amount, Carbon $date)
    {
        $integrationSetting = $this->getIntegrationSetting();
        if (empty($integrationSetting->salary_rule_id)) {
            throw new Exception('Salary Rule Not Set In The Setting');
        }

        $outStandingData['salary_rule_id'] = $integrationSetting->salary_rule_id;
        $outStandingData['month'] = $date->format('F,Y');
        $outStandingData['employee_id'] = $employee->id;
        $outStandingData['amount'] = $amount;
        $data[] = $outStandingData;
        $this->employeeSalaryOutstandingService->saveData($data, $outStandingData['employee_id']);
        return true;
    }

    //------------------------------------------------------------------------------------------------
    //                                    Private Methods
    //------------------------------------------------------------------------------------------------

    private function getIntegrationSetting()
    {
        $integrationSetting = $this->vmsIntegrationSettingService->getActiveSetting();
        if (is_null($integrationSetting)) {
            throw new Exception('No Integration Setting Found');
        } else {
            return $integrationSetting;
        }
    }

}

