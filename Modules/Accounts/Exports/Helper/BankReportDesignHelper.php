<?php
namespace Modules\Accounts\Exports\Helper;

use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class BankReportDesignHelper extends DesignHelper
{
    // header related values
    const HEADER_FONT_SIZE = 8;
    const HEADER_ROW_START = 6;
    // name
    const NAME_COLUMN_WIDTH = 12;
    const NAME_MAX_LENGTH = 18;
    const NAME_INCREASE_NUMBER = 12;
    // Designation column values
    const DESIGNATION_COLUMN_WIDTH = 22;
    const DESIGNATION_MAX_LENGTH = 18;
    const DESIGNATION_INCREASE_NUMBER = 12;
    // index column values
    const INDEX_COLUMN_WIDTH = 5;
    // all cell related value
    const ALL_ROW_HEIGHT = 32;
    const ALL_COLUMN_WIDTH = 26;
    const ALL_FONT_NAME = 'Nikosh';
    const ALL_FONT_SIZE = 9;

    public function __construct(AfterSheet $event)
    {
        parent::__construct($event);
    }

    public function getHeaderStartRow()   // this method should be abstract
    {
        return self::HEADER_ROW_START;
    }

    public function getHeader()
    {
        return $this->getFullRowRange($this->getHeaderStartRow(), 'A');
    }

    public function getStyleArrayForFont($size = BankReportDesignHelper::ALL_FONT_SIZE)
    {
        return [
            'font' => array(
                'name' => BankReportDesignHelper::ALL_FONT_NAME,
                'size' => $size,
            ),
        ];
    }

    public function getStyleArrayForHeaderFont($size = BankReportDesignHelper::HEADER_FONT_SIZE)
    {
        return [
            'font' => array(
                'name' => BankReportDesignHelper::ALL_FONT_NAME,
                'size' => $size,
            ),
        ];
    }

    public function setAllColumnWidth()
    {
        $highestRowAndColumn = $this->getHighestRowAndColumn();
        // set all column width
        for ($column = 'A'; $column != $highestRowAndColumn['column']; $column++) {
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

    public function getNameColumn()
    {
        return $this->getFullColumnRange($this->getHeaderStartRow(), 'B');
    }

    public function getIndexColumn()
    {

    }

    public function applyBorderToAll()
    {
        $cellRange = $this->getCellRangeForBorder();
        $this->applyBorder($cellRange);
    }

    private function getCellRangeForBorder()
    {
        $highestColumnAndRow = $this->getHighestRowAndColumn();
        return 'A'.$this->getHeaderStartRow().":".$highestColumnAndRow['column'].$highestColumnAndRow['row'];
    }

    public function getAllColumnWidths()
    {
        return $this->calculateColumnWidths();
    }

    public function modifyHeader()
    {
        $cellRange = $this->getHeader();
        $this->setFont($cellRange, $this->getStyleArrayForHeaderFont());
        $this->setBold($cellRange);
    }

    public function customMergeCell()
    {
        // merge meta-data row
        for ($row = 1; $row <= $this->getHeaderStartRow() - 1; $row++) {
            $highestRowAndColumn = $this->getHighestRowAndColumn();
            $cellRange = 'A'.$row.':'.$highestRowAndColumn['column'].$row;
            $this->mergeCells($cellRange);
        }
    }


    public function fixAlignment()
    {
        // Meta-data
        $highestRowAndColumn = $this->getHighestRowAndColumn();
        $cellRange = 'A1'.':'.$highestRowAndColumn['column'].($this->getHeaderStartRow() - 1);
        $this->alignCenter($cellRange);
        // Name column
        $cellRange = $this->getFullColumnRange($this->getHeaderStartRow(), $this->getNameColumnName());
        $this->alignLeft($cellRange);
        // Designation column
        $cellRange = $this->getFullColumnRange($this->getHeaderStartRow(), $this->getDesignationColumnName());
        $this->alignLeft($cellRange);
        // Bank Account number
        $cellRange = $this->getFullColumnRange($this->getHeaderStartRow(), $this->getBankAccountNumberColumn());
        $this->alignVerticalAndHorizontalCenter($cellRange);
        // Amount
        $cellRange = $this->getFullColumnRange($this->getHeaderStartRow(), 'E');
        $this->alignRight($cellRange);
        // Index column
        $cellRange = $this->getFullColumnRange($this->getHeaderStartRow(), $this->getIndexColumnName());
        $this->alignVerticalAndHorizontalCenter($cellRange);
        // header
        $cellRange = 'A'.$this->getHeaderStartRow().':'.$highestRowAndColumn['column'].$this->getHeaderStartRow();
        $this->alignCenter($cellRange);
        $this->alignTop($cellRange);
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

    public function modifyAll()
    {
        // make all cellRange wrap Text
        $cellRange = $this->getAllCellRange($this->getHeaderStartRow(), 'A');
        $this->setWrapText($cellRange);
    }

    public function modifyNameColumn()
    {
        $this->setWidth($this->getNameColumnName(), self::NAME_COLUMN_WIDTH);
        $highestRowAndColumn = $this->getHighestRowAndColumn();
        $column = $this->getNameColumnName();
        for ($row = '1'; $row != $highestRowAndColumn['row']; $row++) {
            $value = $this->getCellValue($column, $row);
            if (strlen(utf8_decode($value)) > self::NAME_MAX_LENGTH) {
                // increase the height of that row
                $this->setHeight($row, self::ALL_ROW_HEIGHT + self::NAME_INCREASE_NUMBER);
            }
        }
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


    // column name methods
    public function getIndexColumnName()
    {
        return 'A';
    }

    public function getNameColumnName()
    {
        return 'B';
    }

    public function getDesignationColumnName()
    {
        return 'C';
    }

    public function getBankAccountNumberColumn()
    {
        return 'D';
    }
}
