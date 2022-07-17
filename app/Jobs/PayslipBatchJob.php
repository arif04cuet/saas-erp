<?php

namespace App\Jobs;

use App\Utilities\EnToBnNumberConverter;
use App\Utilities\MonthNameConverter;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Services\PayslipService;
use Modules\HRM\Entities\Employee;

class PayslipBatchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    private $payslipService;

    /**
     * PayslipBatchJob constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param PayslipService $payslipService
     * @return void
     */
    public function handle(PayslipService $payslipService)
    {
        $data = $this->data;
        // optimising 300+ query to one single query
        $employees = Employee::whereIn('id', $data['employees'])->get();
        foreach ($employees as $employee) {
            if (empty($employee->employeeContract)) {
                continue;
            };
            $payslipData = $data['payslipData'];
            $payslipData['employee_id'] = $employee->id;
            $payslipService->createPayslip($payslipData);
        }
    }
}
