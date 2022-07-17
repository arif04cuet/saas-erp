<?php
namespace Modules\Accounts\Exports\Helper;

use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Shared\Font;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class GroupReportDesignHelper
{
    const TITLE_TRUNCATE_LIMIT = 31;
    const TITLE_FONT_SIZE = 20;
    const TITLE_ROW_HEIGHT = 32;
    // header related values
    const HEADER_FONT_SIZE = 11;
    const HEADER_ROW_HEIGHT = 110;
    const HEADER_ROW_START = 5;
    // name column values
    const NAME_COLUMN_WIDTH = 29;
    const NAME_COLUMN_FONT_SIZE = 12;
    const NAME_MAX_LENGTH_LIMIT = 80; // if any name increases than this, increase its width
    const TOTAL_NAME_HEIGHT = self::ALL_ROW_HEIGHT + 4;
    // all cell related value
    const ALL_ROW_HEIGHT = 70;
    const ALL_COLUMN_WIDTH = 8;
    const ALL_FONT_NAME = 'Nikosh';
    const ALL_FONT_SIZE = 14;
    const TOTAL_COLUMN_WIDTH = self::ALL_COLUMN_WIDTH + 5;
    const MAX_VALUE_LENGTH = 6;
    private $event;

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
        $this->event->sheet->getDelegate()->getStyle($cellRange)
            ->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

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

    public function getHeader()
    {
        return $this->getFullRowRange($this->getHeaderStartRow(), 'A');
    }

    public function getNameColumn()
    {
        return $this->getFullColumnRange($this->getHeaderStartRow(), 'B');
    }

    public function getIndexColumn()
    {

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
    public function getAllCellRange()
    {
        $highestRowAndColumn = $this->getHighestRowAndColumn();
        return $range = 'A'.self::HEADER_ROW_START.':'.$highestRowAndColumn['column'].$highestRowAndColumn['row'];
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
        $this->event->sheet->getPageSetup()->setFitToWidth(0);
        $this->event->sheet->getPageSetup()->setFitToHeight(1);
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

    public function getHeaderStartRow()
    {
        return self::HEADER_ROW_START;
    }

    public function getCellValue($column, $row)
    {
        $cell = $this->getCell($column, $row);
        if (!is_null($cell)) {
            return $cell->getValue();
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
