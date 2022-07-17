<?php
namespace Modules\Accounts\Exports\Helper;

use Maatwebsite\Excel\Events\AfterSheet;

class OfficerReportDesignHelper extends DesignHelper
{
    const TITLE_TRUNCATE_LIMIT = 31;
    const TITLE_FONT_SIZE = 14;
    const TITLE_ROW_HEIGHT = 32;
    // header related values
    const HEADER_FONT_SIZE = 11;
    const HEADER_ROW_HEIGHT = 100;
    const HEADER_ROW_START = 13;
    // name column values
    const NAME_COLUMN_WIDTH = 29;
    const NAME_COLUMN_FONT_SIZE = 12;

    // all cell related value
    const ALL_ROW_HEIGHT = 17;
    const ALL_COLUMN_WIDTH = 4;
    const ALL_FONT_NAME = 'NIKOSH';
    const ALL_FONT_SIZE = 11;
    const TOTAL_COLUMN_WIDTH = self::ALL_COLUMN_WIDTH + 4;
    const MAX_VALUE_LENGTH = 6;

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

    public function getStyleArrayForFont($size = OfficerReportDesignHelper::ALL_FONT_SIZE)
    {
        return [
            'font' => array(
                'name' => OfficerReportDesignHelper::ALL_FONT_NAME,
                'size' => $size,
            ),
        ];
    }

    public function getStyleArrayForHeaderFont($size = OfficerReportDesignHelper::HEADER_FONT_SIZE)
    {
        return [
            'font' => array(
                'name' => OfficerReportDesignHelper::ALL_FONT_NAME,
                'size' => $size,
            ),
        ];
    }

    public function getStyleArrayForTitleFont($size = OfficerReportDesignHelper::TITLE_FONT_SIZE)
    {
        return [
            'font' => array(
                'name' => OfficerReportDesignHelper::ALL_FONT_NAME,
                'size' => $size,
            ),
        ];
    }

    public function getStyleArrayForNameFont($size = OfficerReportDesignHelper::NAME_COLUMN_FONT_SIZE)
    {
        return [
            'font' => array(
                'name' => OfficerReportDesignHelper::ALL_FONT_NAME,
                'size' => $size,
            ),
        ];
    }


    public function alignToLeft()
    {
        $cellRange = $this->getFullColumnRange('1', 'A');
        parent::alignLeft($cellRange);
    }

    public function alignToRight()
    {
        $highestRowAndColumn = $this->getHighestRowAndColumn();
        $cellRange = $this->getFullColumnRange('14', 'P');
        parent::alignRight($cellRange);
    }

    public function alignToCenter()
    {
        $cellRange = '';
        parent::alignCenter($cellRange);
    }

    public function setAllColumnWidth()
    {
        $highestRowAndColumn = $this->getHighestRowAndColumn();
        // set all column width
        for ($column = 'A'; $column != 'U'; $column++) {
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

    public function getHeadStartRow()
    {
        return self::HEADER_ROW_START;
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
        return 'A'.$this->getHeaderStartRow().":".'T'.$highestColumnAndRow['row'];
    }


    public function getAllColumnWidths()
    {
        return $this->calculateColumnWidths();
    }

    public function getTitleRange()
    {
        return "A1:A2";
    }

    public function getNameRange()
    {
        return $this->getFullRowRange('9', 'A');
    }
}
