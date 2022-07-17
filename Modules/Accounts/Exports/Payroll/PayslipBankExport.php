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
use Modules\Accounts\Exports\Helper\OfficerReportDesignHelper;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PayslipBankExport implements FromView, WithEvents, WithTitle
{

    protected $payslips;
    private $modelPayslip;
    /**
     * @var BankReportDesignHelper
     */
    private $designHelper;

    public function __construct($payslips, $modelPayslip)
    {
        $this->payslips = $payslips;
        $this->modelPayslip = $modelPayslip;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('accounts::payroll.payslip.export.bank-export', [
            'payslips'     => $this->payslips,
            'modelPayslip' => $this->modelPayslip
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
                $this->designHelper->fixAlignment();
                $this->designHelper->modifyIndexColumn();
                $this->designHelper->modifyDesignationColumn();
                $this->designHelper->modifyNameColumn();
                $this->designHelper->modifyHeader();
                $this->designHelper->customMergeCell();
                $this->applyBorder();
                $this->modifySignatureColumn();
                $this->designHelper->modifyAll();
                // ---------- Print-settings -----------------
                $this->designHelper->setPrintFitToWidth();
                $this->designHelper->setPageOrientation(PageSetup::ORIENTATION_PORTRAIT);
                $this->designHelper->setPageMargin('0.2', '0.680', '0.4', '1.2');
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
        $this->designHelper = new BankReportDesignHelper($event);
    }

    private function setFont()
    {
        $styleArray = $this->designHelper->getStyleArrayForFont();
        $cellRange = $this->designHelper->getAllCellRange('1', 'A');
        $this->designHelper->setFont($cellRange, $styleArray);
    }

    private function applyBorder()
    {
        $highestRowAndColumn = $this->designHelper->getHighestRowAndColumn();
        $cellRange = 'A'.$this->designHelper->getHeaderStartRow()
            .':'.$highestRowAndColumn['column'].$this->getRowNumberOfTotal();
        $this->designHelper->applyBorder($cellRange);
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
}
