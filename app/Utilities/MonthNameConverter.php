<?php

namespace App\Utilities;

use Carbon\Carbon;

class MonthNameConverter
{
    public static $bn = array(
        "জানুয়ারি",
        "ফেব্রুয়ারি",
        "মার্চ",
        "এপ্রিল",
        "মে",
        "জুন",
        "জুলাই",
        "আগস্ট",
        "সেপ্টেম্বর",
        "অক্টোবর",
        "নভেম্বর",
        "ডিসেম্বর"
    );
    public static $en = array(
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    );

    public static $bnMonth = [
        'january' => 'জানুয়ারি',
        'february' => 'ফেব্রুয়ারি',
        'march' => 'মার্চ',
        'april' => 'এপ্রিল',
        'may' => 'মে',
        'june' => 'জুন',
        'july' => 'জুলাই',
        'august' => 'আগস্ট',
        'september' => 'সেপ্টেম্বর',
        'october' => 'অক্টোবর',
        'november' => 'নভেম্বর',
        'december' => 'ডিসেম্বর',
    ];

    public static $bnMonthShort = [
        'jan' => 'জানুঃ',
        'feb' => 'ফেব্রুঃ',
        'mar' => 'মার্চঃ',
        'apr' => 'এপ্রিল',
        'may' => 'মে',
        'jun' => 'জুন',
        'jul' => 'জুলাই',
        'aug' => 'আগস্ট',
        'sep' => 'সেপ্টেঃ',
        'oct' => 'অক্টোঃ',
        'nov' => 'নভেঃ',
        'dec' => 'ডিসেঃ',
    ];

    public static $bnDays = [
        'sat' => 'শনি',
        'sun' => 'রবি',
        'mon' => 'সোম',
        'tue' => 'মঙ্গল',
        'wed' => 'বুধ',
        'thu' => 'বৃহস্পতি',
        'fri' => 'শুক্র',
    ];

    public static function bn2en($month)
    {
        if (app()->isLocale('en')) {
            return str_replace(self::$bn, self::$en, $month);
        } else {
            return $month;
        }
    }

    public static function en2bn($month)
    {
        if (app()->isLocale('bn')) {
            return str_replace(self::$en, self::$bn, $month);
        } else {
            return $month;
        }
    }

    /**
     * Parses from a given date string and returns the month in 'Month, Year' format
     * @param $month
     * @param bool $isShortFormat
     * @return mixed|string
     */
    public static function convertMonthToBn($month, $isShortFormat = false, $returnDate = false)
    {
        $formatString = $isShortFormat ? 'M, y' : 'F, Y';
        $fetchedMonth = Carbon::parse($month)->format($formatString);
        $date = $returnDate ? EnToBnNumberConverter::en2bn(Carbon::parse($month)->format('d')) . " " : "";
        if (app()->isLocale('bn')) {
            $monthArr = explode(', ', $fetchedMonth);
            $fetchedMonth = $isShortFormat ? self::$bnMonthShort[strtolower($monthArr[0])] :
                self::$bnMonth[strtolower($monthArr[0])];
            $fetchedMonth .= ' ' . EnToBnNumberConverter::en2bn($monthArr[1], false);
        }
        return $date . $fetchedMonth;
    }

    public static function convertDayToBn($date, $isShort = true)
    {
        return self::$bnDays[strtolower(Carbon::parse($date)->format('D'))] . ($isShort ? '' : 'বার');
    }

}
