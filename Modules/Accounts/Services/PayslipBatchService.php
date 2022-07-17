<?php

namespace Modules\Accounts\Services;

use App\Jobs\PayslipBatchJob;
use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Repositories\PayslipBatchRepository;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Services\EmployeeService;

class PayslipBatchService
{
    use CrudTrait;

    private $payslipService;
    private $payslipBatchRepository;
    private $employeeService;

    public function __construct(
        PayslipService $payslipService,
        PayslipBatchRepository $payslipBatchRepository,
        EmployeeService $employeeService
    ) {
        $this->payslipService = $payslipService;
        $this->payslipBatchRepository = $payslipBatchRepository;
        $this->employeeService = $employeeService;

        $this->setActionRepository($payslipBatchRepository);
    }

    public function saveBatch($data)
    {
        DB::transaction(function () use ($data) {
            $payslipBatch = $this->save($data);
            $payslipData = [
                'payslip_batch_id' => $payslipBatch->id,
                'total_amount' => 0,
                'period_from' => $data['period_from'],
                'period_to' => $data['period_to'],
                'status' => 'draft',
            ];
            if (isset($data['bonus'])) {
                $payslipData['bonus'] = 'on';
                $payslipData['bonus_structure_id'] = $data['bonus_structure_id'] ?? null;
            }
            $data['payslipData'] = $payslipData;
            // Dispatching to Payslip Batch Job To prepare payslips in the queue
            PayslipBatchJob::dispatch($data)->onConnection('database');
        });
    }

    public function getEmployeesWithoutPayslip(
        $from = null,
        $to = null,
        $type,
        $bonusStructureId
    ) {
        return $this->payslipService->getEmployeesWithoutPayslip($from, $to, $type, $bonusStructureId);
    }

    public function getPayslipBatchForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $salaryBasics = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll();

        return DropDownDataFormatter::getFormattedDataForDropdown(
            $salaryBasics,
            $implementedKey,
            $implementedValue ?: function ($batch) {
                return $batch->name;
            },
            $isEmptyOption
        );
    }

    public function getPayslipBatchesByPeriod($from = null, $to = null)
    {
        $from = $from ?? Carbon::parse()->format('Y-m-01');
        $to = $to ?? Carbon::parse()->format('Y-m-0t');

        return $this->payslipBatchRepository->getBatchesByPeriod($from, $to);
    }
}

