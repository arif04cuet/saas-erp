<?php

namespace Modules\Accounts\Exports\Payroll;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Entities\SalaryCategory;
use Modules\Accounts\Services\PayscaleService;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class PayslipExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
{

    private $payslip;
    private $compact;


    public function __construct(Payslip $payslip)
    {
        $this->payslip = $payslip;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->checkSheetTitle($this->payslip->employee->getName());

    }


    public function view(): View
    {

        $payslipDetails = $this->payslip->payslipDetails;

        $deductionDetails = $payslipDetails->filter(function ($detail) {
            return $detail->salaryRule->salaryCategory->name == SalaryCategory::SALARY_CATEGORY_DEDUCTION;
        })->sortBy(function ($u) {
            return (int)$u->salaryRule->sequence;
        })->values();

        $otherDetails = $payslipDetails->filter(function ($detail) {
            return $detail->salaryRule->salaryCategory->name != SalaryCategory::SALARY_CATEGORY_DEDUCTION;
        })->sortBy(function ($u) {
            return (int)$u->salaryRule->sequence;
        })->values();
        $minSalary = $this->payslip->employee->employeeContract->getMinSalary();
        $maxSalary = $this->payslip->employee->employeeContract->getMaxSalary();

        return view('accounts::payroll.payslip.export.export', [
            'payslip' => $this->payslip,
            'deductionDetails' => $deductionDetails,
            'otherDetails' => $otherDetails,
            'payslipDetails' => $payslipDetails,
            'minSalary' => $minSalary,
            'maxSalary' => $maxSalary,

        ]);
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A11:C11'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13)->setBold(true);
                // Apply array of styles to B2:G8 cell range
                $styleArray = [
//                    'borders' => [
//                        'outline' => [
//                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
//                            'color' => ['argb' => '0000'],
//                        ]
//                    ],
                    'alignment' => array(
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    )
                ];
                $event->sheet->getDelegate()->getStyle('A1:C54')->applyFromArray($styleArray);


            },
        ];
    }

    /**
     * Check if string contains invalid characters
     * if so, replace it
     * @param $pValue
     * @return mixed
     */
    private function checkSheetTitle($pValue)
    {
        return str_replace(Worksheet::getInvalidCharacters(), '', $pValue);
    }

}
