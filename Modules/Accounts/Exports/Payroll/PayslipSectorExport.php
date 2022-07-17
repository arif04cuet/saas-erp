<?php
namespace Modules\Accounts\Exports\Payroll;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use Modules\Accounts\Exports\Helper\BankReportDesignHelper;
use Modules\Accounts\Exports\Helper\SectorReportDesignHelper;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PayslipSectorExport implements FromView, WithEvents, WithTitle
{

    private $payslips;
    private $modelPayslip;
    private $sectors;
    /**
     * @var SectorReportDesignHelper
     */
    private $designHelper;

    public function __construct(
        $payslips,
        $modelPayslip,
        $sectors
    ) {
        $this->payslips = $payslips;
        $this->modelPayslip = $modelPayslip;
        $this->sectors = $sectors;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('accounts::payroll.payslip.export.sector-export', [
            'payslips'     => $this->payslips,
            'modelPayslip' => $this->modelPayslip,
            'sectors'      => $this->sectors
        ]);
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                //---------- Get-a-designer-first------------
                $this->setDesignHelper($event);
                $this->setFont();
                $this->designHelper->setAllColumnWidth();
                $this->designHelper->setAllRowHeight();
                // custom modification
                $this->designHelper->modifyHeader();
                $this->designHelper->modifyIndexColumn();
                $this->customMergeCell();
                $this->designHelper->fixAlignment();
                $this->designHelper->modifyAll();
                $this->applyBorder();
                $this->modifySignatureColumn();
                $this->designHelper->modifyNameColumn();
                $this->designHelper->modifyDesignationColumn();
                // ---------- Print-settings -----------------
                $this->designHelper->setPrintFitToWidth();
                $this->designHelper->setPageOrientation(PageSetup::ORIENTATION_PORTRAIT);
                $this->designHelper->setPageMargin('0.2', '0.706', '0.4', '1.35');
                $this->designHelper->setPaperSize(PageSetup::PAPERSIZE_A4);
            },
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->checkSheetTitle($this->modelPayslip->payslipBatch->name ?? "Bank Report");
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
        return str_replace(Worksheet::getInvalidCharacters(), '', $pValue);
    }


    /**
     * @param  AfterSheet  $event
     */
    private function setDesignHelper(AfterSheet $event)
    {
        $this->designHelper = new SectorReportDesignHelper($event);
    }

    private function setFont()
    {
        $styleArray = $this->designHelper->getStyleArrayForFont();
        $cellRange = $this->designHelper->getAllCellRange('1', 'A');
        $this->designHelper->setFont($cellRange, $styleArray);
    }

    private function customMergeCell()
    {
        // merge all the meta data row
        $highestRowAndColumn = $this->designHelper->getHighestRowAndColumn();
        for ($row = 1; $row <= 3; $row++) {
            $cellRange = 'A'.$row.':'.$highestRowAndColumn['column'].$row;
            $this->designHelper->mergeCells($cellRange);
        }
    }

    private function modifyHeader()
    {
        $cellRange = $this->designHelper->getHeader();
        $this->designHelper->setFont($cellRange, $this->designHelper->getStyleArrayForHeaderFont());
        $this->designHelper->setBold($cellRange);
    }

    private function fixAlignment()
    {
        // header
        $cellRange = 'A1:A3';
        $this->designHelper->alignCenter($cellRange);
    }


    /**
     * @return mixed
     */
    private function totalNumberOfPayslips()
    {
        return $this->payslips->count();
    }

    private function getRowNumberOfTotal()
    {
        return $this->designHelper->getHeaderStartRow() + $this->totalNumberOfPayslips() + 1;
    }

    private function modifySignatureColumn()
    {
        $cellRange = $this->designHelper->getFullRowRange($this->getRowNumberOfTotal() + 2, 'A');
        $this->designHelper->alignVerticalAndHorizontalCenter($cellRange);
    }

    private function applyBorder()
    {
        $highestRowAndColumn = $this->designHelper->getHighestRowAndColumn();
        $cellRange = 'A'.$this->designHelper->getHeaderStartRow()
            .':'.$highestRowAndColumn['column'].$this->getRowNumberOfTotal();
        $this->designHelper->applyBorder($cellRange);
    }
}
