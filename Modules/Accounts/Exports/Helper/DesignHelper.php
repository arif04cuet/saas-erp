<?php
namespace Modules\Accounts\Exports\Helper;

use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DesignHelper
{
    /**
     * GroupReportDesignHelper constructor.
     *
     * @param  AfterSheet  $event
     */
    public function __construct(AfterSheet $event)
    {
        $this->event = $event;
    }

    /**
     * @param $cellRange
     *
     * @throws Exception
     */
    public function alignCenter($cellRange)
    {
        $this->event->sheet->getDelegate()->getStyle($cellRange)
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

    /**
     * @param $cellRange
     *
     * @throws Exception
     */
    public function alignRight($cellRange)
    {
        $this->event->sheet->getDelegate()->getStyle($cellRange)
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
    }

    /**
     * @param $cellRange
     *
     * @throws Exception
     */
    public function alignLeft($cellRange)
    {
        $this->event->sheet->getDelegate()->getStyle($cellRange)
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    }

    public function alignTop($cellRange)
    {
        $this->event->sheet->getDelegate()
            ->getStyle($cellRange)
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_TOP);
    }

    public function alignVerticalAndHorizontalCenter($cellRange)
    {
        $this->event->sheet->getDelegate()
            ->getStyle($cellRange)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->event->sheet->getDelegate()
            ->getStyle($cellRange)
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);
    }


    /**
     * @param         $cellRange
     * @param  array  $styleArray
     *
     * @throws Exception
     */
    public function setFont($cellRange, array $styleArray)
    {
        $this->event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
    }

    /**
     * @param $cellRange
     * @param $value
     *
     * @throws Exception
     */
    public function setFontSize($cellRange, $value)
    {
        $this->event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize($value);
    }

    public function getHighestRowAndColumn()
    {
        return $this->event->sheet->getDelegate()->getHighestRowAndColumn();
    }

    /**
     * @return string
     */
    public function getAllCellRange($startRow, $startColumn)
    {
        $highestRowAndColumn = $this->getHighestRowAndColumn();
        return $range = $startColumn.$startRow.':'.$highestRowAndColumn['column'].$highestRowAndColumn['row'];
    }

    public function getIndexCellRange()
    {
        return $this->getFullColumnRange('4', 'A');
    }

    /**
     * @param $cellRange
     *
     * @throws Exception
     */
    public function setWrapText($cellRange)
    {
        $this->event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setWrapText(true);
    }

    /**
     * @param $cellRange
     *
     * @throws Exception
     */
    public function setBold($cellRange)
    {
        $this->event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
    }

    /**
     * @param $column
     * @param $value
     */
    public function setWidth($column, $value)
    {
        $this->event->sheet->getDelegate()->getColumnDimension($column)->setWidth($value);
    }

    /**
     * @param $row
     * @param $value
     */
    public function setHeight($row, $value)
    {
        $this->event->sheet->getDelegate()->getRowDimension($row)->setRowHeight($value);
    }

    /**
     * @param  bool  $value
     */
    public function setPrintGridLines(bool $value = true)
    {
        $this->event->sheet->getDelegate()->setPrintGridlines($value);
    }

    public function setPrintFitToWidth()
    {
        $this->event->sheet->getPageSetup()->setFitToWidth(1);
        $this->event->sheet->getPageSetup()->setFitToHeight(0);
    }

    public function setPrintFitToHeight()
    {
        $this->event->sheet->getPageSetup()->setFitToHeight(1);
        $this->event->sheet->getPageSetup()->setFitToWidth(0);
    }


    public function setPrintFitToHeightAndWeight()
    {
        $this->event->sheet->getPageSetup()->setFitToWidth(1);
        $this->event->sheet->getPageSetup()->setFitToHeight(1);
    }

    /**
     * @param $orientation
     */
    public function setPageOrientation($orientation)
    {
        $this->event->sheet->getPageSetup()->setOrientation($orientation);
    }

    /**
     * @param $top
     * @param $right
     * @param $bottom
     * @param $left
     */
    public function setPageMargin($top, $right, $bottom, $left)
    {
        $this->event->sheet->getPageMargins()->setTop($top);
        $this->event->sheet->getPageMargins()->setRight($right);
        $this->event->sheet->getPageMargins()->setLeft($left);
        $this->event->sheet->getPageMargins()->setBottom($bottom);
    }

    public function setPrintBreak($cellNumber)
    {
        $this->event->sheet->setBreak($cellNumber, Worksheet::BREAK_ROW);
    }

    /**
     * @param         $cellRange
     * @param  array  $styleArray
     *
     * @throws Exception
     */
    public function applyBorder($cellRange)
    {
        $this->event->sheet->getDelegate()->getStyle($cellRange)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }

    public function mergeCells($cellRange)
    {
        $this->event->sheet->getDelegate()->mergeCells($cellRange);
    }

    public function getFullRowRange($startRow, $startColumn)
    {
        $highestRowAndColumn = $this->getHighestRowAndColumn();
        return $startColumn.$startRow.':'.$highestRowAndColumn['column'].$startRow;

    }

    public function getFullColumnRange($startRow, $startColumn)
    {
        $highestRowAndColumn = $this->getHighestRowAndColumn();
        return $startColumn.$startRow.':'.$startColumn.$highestRowAndColumn['row'];
    }

    public function setPaperSize($value)
    {
        $this->event->sheet->getPageSetup()->setPaperSize($value);
    }

    public function makeColumnAutosize($column)
    {
        //Font::setAutoSizeMethod(Font::AUTOSIZE_METHOD_EXACT);
        $this->event->sheet->getColumnDimension($column)->setAutosize(true);
    }

    public function autoFitToWidth($column)
    {
        $this->event->sheet->getDelegate()->autoFitColumn($column);
    }


    public function getCellValue($column, $row)
    {
        $cell = $this->getCell($column, $row);
        if (!is_null($cell)) {
            return trim($cell->getValue());
        }
        return null;
    }


    public function getCell($column, $row)
    {
        $cell = null;
        if ($this->event->sheet->cellExists($column.$row)) {
            $cell = $this->event->sheet->getCell($column.$row);
        }
        return $cell;
    }

    public function calculateColumnWidths()
    {
        return $this->event->sheet->calculateColumnWidths();
    }

}
