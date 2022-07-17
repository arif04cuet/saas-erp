<?php

namespace Modules\Accounts\Exports\Payroll;

use http\Exception\UnexpectedValueException;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Cell;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Entities\SalaryCategory;
use Modules\Accounts\Exports\Helper\GroupReportDesignHelper;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class PayslipGroupExport implements FromView, WithEvents, WithTitle
{
    private $salaryStructure;
    private $payslips;
    private $modelPayslip;
    private $designHelper;

    public function __construct($salaryStructure, $payslips, $modelPayslip)
    {
        $this->salaryStructure = $salaryStructure;
        $this->payslips = $payslips;
        $this->modelPayslip = $modelPayslip;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('accounts::payroll.payslip.export.group-export', [
            'salaryStructure' => $this->salaryStructure,
            'payslips' => $this->payslips,
            'modelPayslip' => $this->modelPayslip,
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
                $this->setFont();
                $this->fixAlignment();
                $this->setAllColumnWidth();
                $this->setAllRowHeight();
                //----------- Custom-modification-------------
                $this->mergeCells();
                $this->modifyHeader();
                $this->modifyNameColumn();
                $this->modifyTitles();
                $this->modifySignatureColumn();
                $this->modifyTotalColumn();
                $this->applyBorderToAll();
                // dd($this->designHelper->calculateColumnWidths());
                // ---------- Print-settings -----------------
                $this->designHelper->setPrintFitToWidth();
                $this->designHelper->setPageOrientation(PageSetup::ORIENTATION_LANDSCAPE);
                $this->designHelper->setPageMargin('0.0', '0.2', '0', '0.2');
                $this->designHelper->setPaperSize(PageSetup::PAPERSIZE_LEGAL);
            },
        ];
    }

    private function setFont()
    {
        $styleArray = $this->getStyleArrayForFont();
        $cellRange = $this->designHelper->getAllCellRange();
        $this->designHelper->setFont($cellRange, $styleArray);
    }

    private function applyBorderToAll()
    {
        $cellRange = $this->designHelper->getAllCellRange();
        $this->designHelper->applyBorder($cellRange);
    }

    private function fixAlignment()
    {
        // make all align right
        $cellRange = $this->designHelper->getAllCellRange();
        $this->alignRight($cellRange);
        // make name column left
        $cellRange = $this->designHelper->getNameColumn();
        $this->alignLeft($cellRange);
        // make header row center
        $cellRange = $this->designHelper->getHeader();
        $this->alignCenter($cellRange);
        // make index column center
        $cellRange = $this->designHelper->getIndexCellRange();
        $this->alignCenter($cellRange);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        $title = $this->salaryStructure->name;
        if (strlen($title) > GroupReportDesignHelper::TITLE_TRUNCATE_LIMIT) {
            $title = substr($title, 0, GroupReportDesignHelper::TITLE_TRUNCATE_LIMIT);
        }
        return $title;
    }

    private function modifyHeader(): void
    {
        $cellRange = $this->designHelper->getHeader(); // All headers
        $this->designHelper->setFontSize($cellRange, GroupReportDesignHelper::HEADER_FONT_SIZE);
        $this->designHelper->setBold($cellRange);
        $this->designHelper->setWrapText($cellRange);
        $this->designHelper->setHeight($this->designHelper->getHeaderStartRow(),
            GroupReportDesignHelper::HEADER_ROW_HEIGHT);
        $this->designHelper->alignTop($cellRange);
    }


    private function setDesignHelper(AfterSheet $event)
    {
        $this->designHelper = new GroupReportDesignHelper($event);
    }

    private function alignRight($cellRange)
    {

        $this->designHelper->alignRight($cellRange);
    }

    private function alignLeft($cellRange)
    {

        $this->designHelper->alignLeft($cellRange);
    }

    private function alignCenter($cellRange)
    {
        $this->designHelper->alignCenter($cellRange);
    }

    private function modifyNameColumn()
    {
        $cellRange = $this->designHelper->getNameColumn();
        $this->designHelper->setFontSize($cellRange, GroupReportDesignHelper::NAME_COLUMN_FONT_SIZE);
        $this->designHelper->setBold($cellRange);
        $this->designHelper->setWidth('B', GroupReportDesignHelper::NAME_COLUMN_WIDTH);
        $this->designHelper->setWrapText($cellRange);
        // if name is big and designation is bigger than increase height for that row
        $highestRowAndColumn = $this->designHelper->getHighestRowAndColumn();
        for ($row = $this->designHelper->getHeaderStartRow(); $row <= $highestRowAndColumn['row']; $row++) {
            $value = $this->designHelper->getCellValue('B', $row);
            if (strlen(utf8_decode($value)) > GroupReportDesignHelper::NAME_MAX_LENGTH_LIMIT) {
                // increase the width of that column
                $this->designHelper->setHeight($row, GroupReportDesignHelper::TOTAL_NAME_HEIGHT);
            }
        }
    }

    private function setAllColumnWidth()
    {
        $highestRowAndColumn = $this->designHelper->getHighestRowAndColumn();
        // set all column width
        for ($column = 'A'; $column != $highestRowAndColumn['column']; $column++) {
            $this->designHelper->setWidth($column, GroupReportDesignHelper::ALL_COLUMN_WIDTH);
        }
    }

    private function setAllRowHeight()
    {
        $highestRowAndColumn = $this->designHelper->getHighestRowAndColumn();
        //set all row height
        for ($row = $this->getHeadStartRow(); $row <= $highestRowAndColumn['row']; $row++) {
            $this->designHelper->setHeight($row, GroupReportDesignHelper::ALL_ROW_HEIGHT);
        }
    }

    private function mergeCells()
    {
        for ($i = 1; $i <= 3; $i++) {
            $cellRange = $this->designHelper->getFullRowRange($i, 'A');
            $this->designHelper->mergeCells($cellRange);
        }
    }

    private function getHeadStartRow()
    {
        return GroupReportDesignHelper::HEADER_ROW_START;
    }

    private function modifyTitles()
    {
        $highestRowAndColumn = $this->designHelper->getHighestRowAndColumn();
        $cellRange = 'A1:' . $highestRowAndColumn['column'] . (int)($this->getHeadStartRow() - 1);
        $this->designHelper->alignCenter($cellRange);
        $this->designHelper->setFont($cellRange, $this->getStyleArrayForFont(GroupReportDesignHelper::TITLE_FONT_SIZE));
        $this->designHelper->setBold($cellRange);
        for ($i = 1; $i <= 3; $i++) {
            $this->designHelper->setHeight($i, GroupReportDesignHelper::TITLE_ROW_HEIGHT);
        }
    }

    /**
     * @param int $size
     *
     * @return array
     */
    private function getStyleArrayForFont($size = GroupReportDesignHelper::ALL_FONT_SIZE): array
    {
        return [
            'font' => array(
                'name' => GroupReportDesignHelper::ALL_FONT_NAME,
                'size' => $size,
            ),
        ];
    }

    private function modifySignatureColumn()
    {
        $highestColumnAndRow = $this->designHelper->getHighestRowAndColumn();
        $this->designHelper->setWidth($highestColumnAndRow['column'], '26');
    }

    private function modifyTotalColumn()
    {
        $columns = [];
        $highestRowAndColumn = $this->designHelper->getHighestRowAndColumn();
        $row = $highestRowAndColumn['row'];
        for ($column = 'A'; $column != $highestRowAndColumn['column']; $column++) {
            $value = $this->designHelper->getCellValue($column, $row);
            if (strlen(utf8_decode($value)) > GroupReportDesignHelper::MAX_VALUE_LENGTH) {
                // increase the width of that column
                $this->designHelper->setWidth($column, GroupReportDesignHelper::TOTAL_COLUMN_WIDTH);
            }
        }
        // decrease the font size
        $cellRange = $this->designHelper->getFullRowRange($highestRowAndColumn['row'], 'A');
        $this->designHelper->setFont($cellRange,
            $this->getStyleArrayForFont(GroupReportDesignHelper::ALL_FONT_SIZE - 3));
    }

}
