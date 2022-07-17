<?php


namespace App\Utilities;


use Closure;
use Illuminate\Support\Facades\Lang;

class DropDownDataFormatter
{
    /**
     * @param $iterables
     * @param Closure $implementedKey
     * @param Closure $implementedValue
     * @param bool $emptyOption
     * @return array
     */
    public static function getFormattedDataForDropdown(
        $iterables,
        Closure $implementedKey = null,
        Closure $implementedValue = null,
        $emptyOption = false
    ){

        $formattedData = self::isShowingEmptyOption($emptyOption);

        foreach ($iterables as $iterate) {
            $iterateKey = $implementedKey ? $implementedKey($iterate) : $iterate->id;

            $implementedValue = $implementedValue ? : function($data) { return $data->name; };

            $formattedData[$iterateKey] = $implementedValue($iterate);
        }

        return $formattedData;
    }

    private static function isShowingEmptyOption($bool){
        return $bool ? ['' => Lang::trans('labels.select')] : [];
    }

}