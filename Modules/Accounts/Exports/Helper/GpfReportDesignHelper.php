<?php

namespace Modules\Accounts\Exports\Helper;

use Maatwebsite\Excel\Events\AfterSheet;

class GpfReportDesignHelper extends DesignHelper
{
    // header related values
    const HEADER_FONT_SIZE = 8;
    const HEADER_ROW_START = 5;
    // Name column values
    const NAME_COLUMN_WIDTH = 24;
    const NAME_MAX_LENGTH = 14;
    const NAME_INCREASE_NUMBER = 10;
    // Designation column values
    const DESIGNATION_COLUMN_WIDTH = 24;
    const DESIGNATION_MAX_LENGTH = 14;
    const DESIGNATION_INCREASE_NUMBER = 10;
    // index column values
    const INDEX_COLUMN_WIDTH = 6;
    // all cell related value
    const ALL_ROW_HEIGHT = 30;
    const ALL_COLUMN_WIDTH = 14;
    const ALL_FONT_NAME = 'Nikosh';
    const ALL_FONT_SIZE = 9;

    public function __construct(AfterSheet $event)
    {
        parent::__construct($event);
    }

    public function getHeaderStartRow()   // this class should be abstract
    {
        return self::HEADER_ROW_START;
    }

    public function getHeader()
    {
        return $this->getFullRowRange($this->getHeaderStartRow(), 'A');
    }

    public function getStyleArrayForFont($size = GpfReportDesignHelper::ALL_FONT_SIZE)
    {
        return [
            'font' => array(
                'name' => GpfReportDesignHelper::ALL_FONT_NAME,
                'size' => $size,
            ),
        ];
    }

    public function getStyleArrayForHeaderFont($size = GpfReportDesignHelper::HEADER_FONT_SIZE)
    {
        return [
            'font' => array(
                'name' => GpfReportDesignHelper::ALL_FONT_NAME,
                'size' => $size,
            ),
        ];
    }

    public function setAllColumnWidth()
    {
        $highestRowAndColumn = $this->getHighestRowAndColumn();
        // set all column width
        for ($column = 'A'; $column <= $highestRowAndColumn['column']; $column++) {
            $this->setWidth($column, self::ALL_COLUMN_WIDTH);
        }

    }

    public function setAllRowHeight()
    {
        $highestRowAndColumn = $this->getHighestRowAndColumn();
        //set all row height
        for ($row = 1; $row <= $highestRowAndColumn['row']; $row++) {
            $this->setHeight($row, self::ALL_ROW_HEIGHT);
        }
    }

    /**
     * @return string - cellRange
     */
    public function getNameColumn()
    {
        return $this->getFullColumnRange($this->getHeaderStartRow(), 'B');
    }

    /**
     *
     * @return string - cellRange
     */
    public function getIndexColumn()
    {
        return $this->getFullColumnRange($this->getHeaderStartRow(), 'A');
    }

    public function applyBorderToAll()
    {
        $cellRange = $this->getCellRangeForBorder();
        $this->applyBorder($cellRange);
    }

    private function getCellRangeForBorder()
    {
        $highestColumnAndRow = $this->getHighestRowAndColumn();
        return 'A' . $this->getHeaderStartRow() . ":" . $highestColumnAndRow['column'] . $highestColumnAndRow['row'];
    }

    public function getAllColumnWidths()
    {
        return $this->calculateColumnWidths();
    }

    public function modifyIndexColumn()
    {
        $this->setWidth($this->getIndexColumnName(), self::INDEX_COLUMN_WIDTH);
    }

    public function modifyDesignationColumn()
    {
        $this->setWidth($this->getDesignationColumnName(), self::DESIGNATION_COLUMN_WIDTH);
        $highestRowAndColumn = $this->getHighestRowAndColumn();
        $column = $this->getDesignationColumnName();
        for ($row = '1'; $row != $highestRowAndColumn['row']; $row++) {
            $value = $this->getCellValue($column, $row);
            if (strlen(utf8_decode($value)) > self::DESIGNATION_MAX_LENGTH) {
                // increase the height of that row
                $this->setHeight($row, self::ALL_ROW_HEIGHT + self::DESIGNATION_INCREASE_NUMBER);
            }
        }
    }

    public function modifyNameColumn()
    {
        $this->setWidth($this->getNameColumnName(), self::NAME_COLUMN_WIDTH);
        $highestRowAndColumn = $this->getHighestRowAndColumn();
        $column = $this->getDesignationColumnName();
        for ($row = '1'; $row != $highestRowAndColumn['row']; $row++) {
            $value = $this->getCellValue($column, $row);
            if (strlen(utf8_decode($value)) > self::NAME_MAX_LENGTH) {
                // increase the height of that row
                $this->setHeight($row, self::ALL_ROW_HEIGHT + self::NAME_INCREASE_NUMBER);
            }
        }
    }

    public function modifyAll()
    {
        // make all cellRange wrap Text
        $cellRange = $this->getAllCellRange('1', 'A');
        $this->setWrapText($cellRange);
    }

    public function modifyHeader()
    {
        $cellRange = $this->getHeader();
        $this->setFont($cellRange, $this->getStyleArrayForHeaderFont());
        $this->setBold($cellRange);
    }

    public function fixAlignment()
    {
        $highestRowAndColumn = $this->getHighestRowAndColumn();
        //meta-data
        $cellRange = 'A1:A4';
        $this->alignCenter($cellRange);
        // index column
        $cellRange = $this->getFullColumnRange($this->getHeaderStartRow(), $this->getIndexColumnName());
        $this->alignVerticalAndHorizontalCenter($cellRange);
        // name column
        $cellRange = $this->getFullColumnRange($this->getHeaderStartRow(), 'B');
        $this->alignLeft($cellRange);
        // designation column
        $cellRange = $this->getFullColumnRange($this->getHeaderStartRow(), $this->getDesignationColumnName());
        $this->alignLeft($cellRange);
        // fund number
        $cellRange = $this->getFullColumnRange($this->getHeaderStartRow(), 'D');
        $this->alignVerticalAndHorizontalCenter($cellRange);
        // gpf-contribution
        $cellRange = $this->getFullColumnRange($this->getHeaderStartRow(), 'E');
        $this->alignRight($cellRange);;
        // gpf-advanced
        $cellRange = $this->getFullColumnRange($this->getHeaderStartRow(), 'F');
        $this->alignRight($cellRange);
        // header
        $cellRange = 'A' . $this->getHeaderStartRow() . ':' . $highestRowAndColumn['column'] . $this->getHeaderStartRow();
        $this->alignCenter($cellRange);
        $this->alignTop($cellRange);
    }

    public function getIndexColumnName()
    {
        return 'A';
    }

    public function getDesignationColumnName()
    {
        return 'C';
    }

    public function getNameColumnName()
    {
        return 'B';
    }

    public function alignRight($cellRange)
    {
        parent::alignRight($cellRange);
        $this->alignTop($cellRange);
    }

    public function alignLeft($cellRange)
    {
        parent::alignLeft($cellRange);
        $this->alignTop($cellRange);
    }


}
