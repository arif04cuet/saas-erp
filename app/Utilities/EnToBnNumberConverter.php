<?php

namespace App\Utilities;

use Carbon\Carbon;
use phpDocumentor\Reflection\Types\This;

class EnToBnNumberConverter
{
    public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

    public static $eng_to_bn = array(
        '1' => '১',
        '2' => '২',
        '3' => '৩',
        '4' => '৪',
        '5' => '৫',
        '6' => '৬',
        '7' => '৭',
        '8' => '৮',
        '9' => '৯',
        '0' => '০'
    );
    public static $num_to_bd = array(
        '0' => 'শূন্য ',
        '1' => 'এক',
        '2' => 'দুই',
        '3' => 'তিন',
        '4' => 'চার',
        '5' => 'পাঁচ',
        '6' => 'ছয়',
        '7' => 'সাত',
        '8' => 'আট',
        '9' => 'নয়',
        '10' => 'দশ',
        '11' => 'এগার',
        '12' => 'বার',
        '13' => 'তের',
        '14' => 'চৌদ্দ',
        '15' => 'পনের',
        '16' => 'ষোল',
        '17' => 'সতের',
        '18' => 'আঠার',
        '19' => 'ঊনিশ',
        '20' => 'বিশ',
        '21' => 'একুশ',
        '22' => 'বাইশ',
        '23' => 'তেইশ',
        '24' => 'চব্বিশ',
        '25' => 'পঁচিশ',
        '26' => 'ছাব্বিশ',
        '27' => 'সাতাশ',
        '28' => 'আঠাশ',
        '29' => 'ঊনত্রিশ',
        '30' => 'ত্রিশ',
        '31' => 'একত্রিশ',
        '32' => 'বত্রিশ',
        '33' => 'তেত্রিশ',
        '34' => 'চৌত্রিশ',
        '35' => 'পঁয়ত্রিশ',
        '36' => 'ছত্রিশ',
        '37' => 'সাঁইত্রিশ',
        '38' => 'আটত্রিশ',
        '39' => 'ঊনচল্লিশ',
        '40' => 'চল্লিশ',
        '41' => 'একচল্লিশ',
        '42' => 'বিয়াল্লিশ',
        '43' => 'তেতাল্লিশ',
        '44' => 'চুয়াল্লিশ',
        '45' => 'পঁয়তাল্লিশ',
        '46' => 'ছেচল্লিশ',
        '47' => 'সাতচল্লিশ',
        '48' => 'আটচল্লিশ',
        '49' => 'ঊনপঞ্চাশ',
        '50' => 'পঞ্চাশ',
        '51' => 'একান্ন',
        '52' => 'বায়ান্ন',
        '53' => 'তিপ্পান্ন',
        '54' => 'চুয়ান্ন',
        '55' => 'পঞ্চান্ন',
        '56' => 'ছাপ্পান্ন',
        '57' => 'সাতান্ন',
        '58' => 'আটান্ন',
        '59' => 'ঊনষাট',
        '60' => 'ষাট',
        '61' => 'একষট্টি',
        '62' => 'বাষট্টি',
        '63' => 'তেষট্টি',
        '64' => 'চৌষট্টি',
        '65' => 'পঁয়ষট্টি',
        '66' => 'ছেষট্টি',
        '67' => 'সাতষট্টি',
        '68' => 'আটষট্টি',
        '69' => 'ঊনসত্তর',
        '70' => 'সত্তর',
        '71' => 'একাত্তর',
        '72' => 'বাহাত্তর',
        '73' => 'তিয়াত্তর',
        '74' => 'চুয়াত্তর',
        '75' => 'পঁচাত্তর',
        '76' => 'ছিয়াত্তর',
        '77' => 'সাতাত্তর',
        '78' => 'আটাত্তর',
        '79' => 'ঊনআশি',
        '80' => 'আশি',
        '81' => 'একাশি',
        '82' => 'বিরাশি',
        '83' => 'তিরাশি',
        '84' => 'চুরাশি',
        '85' => 'পঁচাশি',
        '86' => 'ছিয়াশি',
        '87' => 'সাতাশি',
        '88' => 'আটাশি',
        '89' => 'ঊননব্বই',
        '90' => 'নব্বই',
        '91' => 'একানব্বই',
        '92' => 'বিরানব্বই',
        '93' => 'তিরানব্বই',
        '94' => 'চুরানব্বই',
        '95' => 'পঁচানব্বই',
        '96' => 'ছিয়ানব্বই',
        '97' => 'সাতানব্বই',
        '98' => 'আটানব্বই',
        '99' => 'নিরানব্বই'
    );

    public static $num_to_bn_decimal = array(
        '0' => 'শূন্য ',
        '1' => 'এক ',
        '2' => 'দুই ',
        '3' => 'তিন ',
        '4' => 'চার ',
        '5' => 'পাঁচ ',
        '6' => 'ছয় ',
        '7' => 'সাত ',
        '8' => 'আট ',
        '9' => 'নয় '
    );
    public static $hundred = 'শত';
    public static $thousand = 'হাজার';
    public static $lakh = 'লক্ষ';
    public static $crore = 'কোটি';

    /**
     * Takes a number and returns the comma formatted string following the bengali currency format
     * @param $num
     * @return string|string[]
     */
    public static function currencyFormatBn($num)
    {
        $numArr = explode('.', $num);
        $positions = [3, 5, 7, 10, 12, 14, 17, 19];
        $integerNum = (int)$numArr[0];
        $decimal = $numArr[1] ?? 0;
        $formattedNum = (string)$integerNum;
        $count = 0;
        foreach ($positions as $position) {
            if ($position >= strlen($integerNum)) {
                break;
            }
            $formattedNum = substr_replace($formattedNum, ',', ($position + $count) * (-1), 0);
            $count++;
        }
        return $decimal ? $formattedNum . '.' . $decimal : $formattedNum;
    }

    public static function bn2en($number, $isFormatted = true, $decimalPoint = 0)
    {
        $number = $isFormatted ? number_format($number, $decimalPoint) : round($number, $decimalPoint);
        if (app()->isLocale('en')) {
            return str_replace(self::$bn, self::$en, $number);;
        } else {
            return $number;
        }
    }

    public static function en2bn($number, $isFormatted = true, $decimalPoint = 0)
    {
        $number = $isFormatted ?
            self::currencyFormatBn(number_format($number, $decimalPoint, '.', '')) : round($number, $decimalPoint);
        if (app()->isLocale('bn')) {
            return str_replace(self::$en, self::$bn, $number);
        } else {
            return $number;
        }
    }

    public static function convertToWords($number)
    {
        if (app()->isLocale('bn')) {
            return self::numberToBanglaWords($number);
        } else {
            return self::numberToEnglishWords($number);
        }
    }

    public static function numberToBanglaWords($number)
    {
        if (!is_numeric($number)) {
            return 'Invalid';
        }
        if (is_float($number)) {
            $dot = explode(".", $number);
            return self::numberSelector($dot[0]) . ' দশমিক ' . self::numToBnDecimal($dot[1] ?? 0);
        } else {
            return self::numberSelector($number);
        }
    }

    private static function numberSelector($number)
    {
        if ($number > 9999999) {
            return self::crore($number);
        } elseif ($number > 99999) {
            return self::lakh($number);
        } elseif ($number > 999) {
            return self::thousand($number);
        } elseif ($number > 99) {
            return self::hundred($number);
        } else {
            return self::underHundred($number);
        }
    }

    private static function numToBnDecimal($number)
    {
        $word = strtr($number, self::$num_to_bn_decimal);
        return $word;
    }

    private static function underHundred($number)
    {
        $number = ($number == 0) ? self::$num_to_bd[0] : self::numToBn($number);
        return $number;
    }

    public static function hundred($number)
    {
        $a = (int)($number / 100);
        $b = $number % 100;
        $hundred = ($a == 0) ? '' : self::numToBn($a) . '' . self::$hundred;
        return $hundred . ' ' . self::underHundred($b);
    }

    private static function thousand($number)
    {
        $a = (int)($number / 1000);
        $b = $number % 1000;
        $thousand = ($a == 0) ? '' : self::numToBn($a) . ' ' . self::$thousand;
        return $thousand . ' ' . self::hundred($b);
    }

    private static function lakh($number)
    {
        $a = (int)($number / 100000);
        $b = $number % 100000;
        $lakh = ($a == 0) ? '' : self::numToBn($a) . ' ' . self::$lakh;
        return $lakh . ' ' . self::thousand($b);
    }

    private static function crore($number)
    {
        $a = (int)($number / 10000000);
        $b = $number % 10000000;
        $more_than_core = ($a > 99) ? self::lakh($a) : self::numToBn($a);
        return $more_than_core . ' ' . self::$crore . ' ' . self::lakh($b);
    }

    private static function numToBn($number)
    {
        $word = strtr($number, self::$num_to_bd);
        return $word;
    }

    /**
     * @param $number
     * @return string
     */
    private static function numberToEnglishWords($number)
    {
        $hyphen = '-';
        $conjunction = '  ';
        $separator = ' ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Fourty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety',
            100 => 'Hundred',
            1000 => 'Thousand',
            1000000 => 'Million',
            1000000000 => 'Billion',
            1000000000000 => 'Trillion',
            1000000000000000 => 'Quadrillion',
            1000000000000000000 => 'Quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . EnToBnNumberConverter::numberToEnglishWords(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int)($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . EnToBnNumberConverter::numberToEnglishWords($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int)($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = EnToBnNumberConverter::numberToEnglishWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= EnToBnNumberConverter::numberToEnglishWords($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string)$fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

}


