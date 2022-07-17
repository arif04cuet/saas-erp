<?php

namespace Modules\Accounts\Imports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Modules\Accounts\Entities\EconomyCode;
use Modules\Accounts\Entities\EconomyHead;

class ImportEconomicCode implements ToModel, WithStartRow
{
    // there are total of 7 column. 1-6 is for head and 7 number is for code
    // headArray will have the latest head for each column
    // headArray = array( 0 => latest head of 0 column , 1 => , 2 => ) you get the idea of it
    const  TYPE_COLUMN_NUMBER = 0;
    const  CATEGORY_COLUMN_NUMBER = 1;
    const  SUB_CATEGORY_COLUMN_NUMBER = 2;
    const  ITEM_COLUMN_NUMBER = 3;
    const  SUB_ITEM_COLUMN_NUMBER = 4;
    const  DETAIL_COLUMN_NUMBER = 5;
    const  ENGLISH_COLUMN_NUMBER = 6;
    const  BANGLA_COLUMN_NUMBER = 7;
    const  STATUS_COLUMN_NUMBER = 8;
    const  USED_FOR_REVENUE_BUDGET = 'Revenue';
    const  HEAD_ROWS =
        [
            self::TYPE_COLUMN_NUMBER => 'type',
            self::CATEGORY_COLUMN_NUMBER => 'category',
            self::SUB_CATEGORY_COLUMN_NUMBER => 'sub_category',
            self::ITEM_COLUMN_NUMBER => 'item',
            self::SUB_ITEM_COLUMN_NUMBER => 'sub_item',
            self::DETAIL_COLUMN_NUMBER => 'code',
            self::ENGLISH_COLUMN_NUMBER => 'name_english',
            self::BANGLA_COLUMN_NUMBER => 'name_bangla',
            self::STATUS_COLUMN_NUMBER => 'description'
        ];
    const EXTENSION = 'xlsx';

    private $headTrack = array();


    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param array $row
     * @return Model|Model[]|void|null
     */
    public function model(array $row)
    {
        list($column, $value) = $this->detectKey($row);
        // run only on valid value
        if (isset($column, $value, $row[self::ENGLISH_COLUMN_NUMBER], $row[self::BANGLA_COLUMN_NUMBER])) {
            $this->insertToDb($column, $value, $row);
        }
    }

    /**
     * @param array $row
     */
    private function insertToDb(string $column, string $value, array $row)
    {
        if ($column < 5) {
            //its a head, save it to db and update headArray
            $englishName = $row[self::ENGLISH_COLUMN_NUMBER];
            $banglaName = $row[self::BANGLA_COLUMN_NUMBER];
            $parentCode = $this->checkParentCode($column, $this->headTrack);
            // saving to db
            $newHead = new EconomyHead();
            $newHead->code = $value;
            $newHead->parent_id = $parentCode;
            $newHead->bangla_name = $banglaName;
            $newHead->english_name = $englishName;
            $newHead->save();
            //  headTrack update
            $this->headTrack[$column] = $value;
        } else {
            //its a code, save it to db and make its head from the 5th column
            $englishName = $row[self::ENGLISH_COLUMN_NUMBER];
            $banglaName = $row[self::BANGLA_COLUMN_NUMBER];
            $status = $row[self::STATUS_COLUMN_NUMBER];
            //save it to db
            $newCode = new EconomyCode();
            $newCode->code = $value;
            $newCode->english_name = $englishName;
            $newCode->bangla_name = $banglaName;
            $newCode->economy_head_code = $this->headTrack[self::SUB_ITEM_COLUMN_NUMBER];
            $newCode->save();
        }
    }

    private function detectKey(array $row)
    {

        foreach ($row as $key => $value) {
            if (isset($row[$key])) {
                return array($key, $value);
            }
        }
    }

    private function checkParentCode(int $column, array $headTrack)
    {
        //return 0 as parentId
        if (!$column) {
            return 0;
        }
        for ($i = $column - 1; $i >= 0; $i--) {
            if (isset($headTrack[$i])) {
                return $headTrack[$i];
            }
        }
    }
}
