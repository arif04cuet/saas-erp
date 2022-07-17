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
use Modules\Accounts\Exports\Helper\GroupReportDesignHelper;
use Modules\Accounts\Exports\Helper\OfficerReportDesignHelper;
use Modules\Accounts\Services\EmployeeSalaryOutstandingService;
use Modules\Accounts\Services\PayscaleService;
use Modules\Accounts\Services\PayslipService;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PayslipIndividualExport implements FromView, WithEvents, WithTitle
{

    private $payslip;

    private $payslipService;

    private $designHelper;


    public function __construct(
        Payslip $payslip,
        PayslipService $payslipService
    ) {
        $this->payslip = $payslip;
        $this->payslipService = $payslipService;
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
        $employeeContract = $this->payslip->employee->employeeContract;
        $outstandings = $this->payslipService->getAllSalaryOutstandingRulesName($this->payslip);
        return view('accounts::payroll.payslip.export.individual-export', [
            'payslip'          => $this->payslip,
            'deductionDetails' => $deductionDetails,
            'otherDetails'     => $otherDetails,
            'payslipDetails'   => $payslipDetails,
            'employeeContract' => $employeeContract,
            'outstandings'     => $outstandings
        ]);
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                //---------- Get-a-designer-first-------------
                $this->setDesignHelper($event);
                $this->designHelper->setAllColumnWidth();
                $this->designHelper->setAllRowHeight();
                // custom modification
                $this->modifyHeader();
                $this->modifyTitle();
                $this->modifyName();
                $this->customMergeCell();
                $this->fixAlignment();
                $this->applyBorderToOnlyFirstPage();
                $this->setFont();
                // ---------- Print-settings -----------------
                $this->setPrintBreak();
                $this->designHelper->setPrintFitToWidth();
                $this->designHelper->setPageOrientation(PageSetup::ORIENTATION_PORTRAIT);
                $this->designHelper->setPageMargin('0.2', '0.706', '0.4', '0.700');
                $this->designHelper->setPaperSize(PageSetup::PAPERSIZE_A4);
            },
        ];
    }

    /**
     * Check if string contains invalid characters
     * if so, replace it
     *
     * @param $pValue
     *
     * @return mixed
     */
    private function checkSheetTitle($pValue)
    {
        $name = str_replace(Worksheet::getInvalidCharacters(), '', $pValue);
        if (strlen(utf8_decode($name)) > 29) {
            $name = substr($name, 0, 28);
        }
        return $name;
    }

    /**
     * @param  AfterSheet  $event
     */
    private function setDesignHelper(AfterSheet $event)
    {
        $this->designHelper = new OfficerReportDesignHelper($event);
    }

    private function setFont()
    {
        $styleArray = $this->designHelper->getStyleArrayForFont();
        $cellRange = $this->designHelper->getAllCellRange('1', 'A');
        $this->designHelper->setFont($cellRange, $styleArray);
    }

    private function fixAlignment()
    {
        $this->designHelper->alignToRight();
        $this->designHelper->alignToLeft();
        // header
        $cellRange = 'A1:A2';
        $this->designHelper->alignCenter($cellRange);
        // other info
        $cellRange = 'A13:S14';
        $this->designHelper->alignCenter($cellRange);
    }

    private function modifyHeader()
    {
        $cellRange = $this->designHelper->getHeader(); // all headers
        $this->designHelper->setFont($cellRange, $this->designHelper->getStyleArrayForHeaderFont());
        $this->designHelper->setBold($cellRange);
    }

    private function modifyTitle()
    {
        $cellRange = $this->designHelper->getTitleRange();
        $this->designHelper->setFont($cellRange, $this->designHelper->getStyleArrayForTitleFont());
        $this->designHelper->setBold($cellRange);
    }

    private function modifyName()
    {
        $cellRange = $this->designHelper->getNameRange();
        $this->designHelper->setFont($cellRange, $this->designHelper->getStyleArrayForNameFont());
    }

    private function customMergeCell()
    {
        for ($row = 1; $row <= 2; $row++) {
            $cellRange = 'A'.$row.':'.'T'.$row;
            $this->designHelper->mergeCells($cellRange);
        }
        $highestRowForFirstPage = $this->getLastRowOfFirstPage();
        // for row number 13-43
        for ($row = 13; $row <= $highestRowForFirstPage; $row++) {
            $cellRange = 'A'.$row.':'.'D'.$row;
            $this->designHelper->mergeCells($cellRange);
        }
        for ($row = 13; $row <= $highestRowForFirstPage; $row++) {
            $cellRange = 'E'.$row.':'.'J'.$row;
            $this->designHelper->mergeCells($cellRange);
        }
        // for row number 14
        for ($row = 13; $row <= 13; $row++) {
            $cellRange = 'K'.$row.':'.'T'.$row;
            $this->designHelper->mergeCells($cellRange);
        }
        // for row number 15-43
        for ($row = 14; $row <= $highestRowForFirstPage; $row++) {
            $cellRange = 'K'.$row.':'.'M'.$row;
            $this->designHelper->mergeCells($cellRange);
        }
        for ($row = 14; $row <= $highestRowForFirstPage; $row++) {
            $cellRange = 'N'.$row.':'.'O'.$row;
            $this->designHelper->mergeCells($cellRange);
        }
        for ($row = 14; $row <= $highestRowForFirstPage; $row++) {
            $cellRange = 'P'.$row.':'.'R'.$row;
            $this->designHelper->mergeCells($cellRange);
        }
        for ($row = 14; $row <= $highestRowForFirstPage; $row++) {
            $cellRange = 'S'.$row.':'.'T'.$row;
            $this->designHelper->mergeCells($cellRange);
        }
    }

    private function applyBorderToOnlyFirstPage()
    {
        $cellRange = $this->getFirstPageRangeForBorder();
        $this->designHelper->applyBorder($cellRange);
    }

    private function getFirstPageRangeForBorder()
    {
        return 'A'.$this->designHelper->getHeaderStartRow().":".'T'.$this->getLastRowOfFirstPage();
    }

    private function totalNumberOfRules()
    {
        return $this->payslip->payslipDetails()->count();
    }

    private function getLastRowOfFirstPage()
    {
        return $this->designHelper->getHeaderStartRow() + $this->totalNumberOfRules() + 6;
    }

    private function setPrintBreak()
    {
        $cellRange = "A".$this->getLastRowOfFirstPage();
        $this->designHelper->setPrintBreak($cellRange);
    }
}
