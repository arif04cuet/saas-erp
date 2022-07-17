<?php

namespace Modules\Accounts\Exports\Payroll;

use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Modules\Accounts\Entities\PayslipBatch;
use Modules\Accounts\Entities\SalaryRule;
use Modules\Accounts\Entities\SalaryStructure;

class PayslipBatchExport implements WithMultipleSheets
{
    use Exportable;

    protected $compact;

    public function __construct($compact)
    {
        $this->compact = $compact;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $reportType = $this->compact['reportType'];
        $sheets = [];
        if ($reportType == 'cash') {
            $salaryStructureIds = $this->compact['salaryStructures'];
            return $this->createGroupReport($salaryStructureIds, $sheets);
        } elseif ($reportType == 'bank') {
            return $this->createBankReport($sheets);
        } elseif ($reportType == 'sector') {
            return $this->createSectorReport($sheets);
        } elseif ($reportType == 'gpf') {
            return $this->createGpfReport($sheets);
        } else {
            return $this->createIndividualReport($sheets);
        }
    }

    /**
     * @param array $sheets
     *
     * @return array
     */
    private function createIndividualReport(array $sheets): array
    {
        $payslips = $this->compact['payslips'];
        foreach ($payslips as $payslip) {
            $sheets[] = new PayslipIndividualExport(
                $payslip,
                app('Modules\Accounts\Services\PayslipService')
            );
        }
        return $sheets;
    }

    /**
     * @param         $salaryStructureIds
     * @param array $sheets
     *
     * @return array
     */
    private function createGroupReport($salaryStructureIds, array $sheets): array
    {
        if (isset($salaryStructureIds) && (!is_null($salaryStructureIds))) {
            $salaryStructures = SalaryStructure::whereIn('id', $salaryStructureIds)->get();
        } else {
            $salaryStructures = SalaryStructure::all();
        }
        $totalPayslips = $this->compact['payslips'];
        foreach ($salaryStructures as $salaryStructure) {
            $payslips = $totalPayslips->filter(function ($p) use ($salaryStructure) {
                return $p->employee->employeeContract->salaryStructure->id == $salaryStructure->id;
            });
            if ($payslips->count()) {
                $modelPayslip = $payslips->first();
                $sheets[] = new PayslipGroupExport($salaryStructure, $payslips, $modelPayslip);
            }
        }
        return $sheets;
    }

    /**
     * @param array $sheets
     *
     * @return array
     */
    private function createSectorReport(array $sheets): array
    {
        $totalPayslips = $this->compact['payslips'];
        $modelPayslip = $totalPayslips->first();
        $salaryRulesId = $this->compact['salaryRulesId'];
        if (isset($salaryRulesId) && (!is_null($salaryRulesId))) {
            $sectors = SalaryRule::whereIn('id', $salaryRulesId)->get();
        } else {
            $sectors = SalaryRule::all();
        }
        $sheets[] = new PayslipSectorExport($totalPayslips, $modelPayslip, $sectors);
        return $sheets;
    }

    /**
     * @param array $sheets
     *
     * @return array
     */
    private function createBankReport(array $sheets): array
    {
        $totalPayslips = $this->compact['payslips'];
        $modelPayslip = $totalPayslips->first();
        $sheets[] = new PayslipBankExport($totalPayslips, $modelPayslip);
        return $sheets;
    }

    /**
     * @param array $sheets
     *
     * @return array
     */
    private function createCoverReport(array $sheets): array
    {
        $payslips = $this->compact['payslips'];
        foreach ($payslips as $payslip) {
            $sheets[] = new PayslipIndividualExport(
                $payslip,
                app('Modules\Accounts\Services\PayslipService')
            );
        }
        return $sheets;
    }

    /**
     * @param array $sheets
     *
     * @return array
     */
    private function createGpfReport(array $sheets): array
    {
        $totalPayslips = $this->compact['payslips'];
        $modelPayslip = $totalPayslips->first();
        $gpfRulesCode = [SalaryRule::GPF_CODE, SalaryRule::GPF_ALLOWANCE];
        $sheets[] = new PayslipGpfExport($totalPayslips, $modelPayslip, $gpfRulesCode);
        return $sheets;
    }
}
