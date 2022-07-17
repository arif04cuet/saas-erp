<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 10/15/19
 * Time: 11:43 AM
 */

namespace App\Utilities;


use Carbon\Carbon;

class FiscalYearCalculator
{
    private const YEAR_START_DATE = '01-Jul';
    private const YEAR_END_DATE = '30-Jun';
    private const DEFAULT_DATE_FORMAT = 'd-M-Y';

    public static function getStartAndEndDates(Carbon $date): array
    {
        $crossOverDate = Carbon::createFromFormat('d-M', self::YEAR_START_DATE);

        if ($date->greaterThanOrEqualTo($crossOverDate)) {
            $startDate = self::getStartDate($date);
            $endDate = self::getEndDate($date);
        } else {
            $startDate = self::getStartDate($date);
            $endDate = self::getEndDate($date);
        }

        return [$startDate, $endDate];
    }

    /**
     * @param Carbon $date
     * @return Carbon
     */
    private static function getStartDate(Carbon $date)
    {
        $startDate = Carbon::createFromFormat(
            self::DEFAULT_DATE_FORMAT,
            self::YEAR_START_DATE . "-{$date->format('Y')}"
        );
        return $startDate;
    }

    /**
     * @param Carbon $date
     * @return Carbon
     */
    private static function getEndDate(Carbon $date)
    {
        $endDate = Carbon::createFromFormat(
            self::DEFAULT_DATE_FORMAT,
            self::YEAR_END_DATE . "-{$date->copy()->addYear()->format('Y')}"
        );
        return $endDate;
    }

    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return bool
     * @throws \Exception
     */
    public static function isStartAndEndDateBetweenFiscalYear(Carbon $startDate, Carbon $endDate): bool
    {
        if ($startDate->greaterThan($endDate)) {
            throw new \Exception('Start date has to be less than end date');
        }

        return self::isDateBetweenFiscalYear($startDate) && self::isDateBetweenFiscalYear($endDate);
    }

    /**
     * @param Carbon $date
     * @return bool
     */
    private static function isDateBetweenFiscalYear(Carbon $date): bool
    {
        list($fiscalStartDate, $fiscalEndDate) = self::getStartAndEndDates(Carbon::today()->addYear(-1));

        return $date->greaterThanOrEqualTo($fiscalStartDate) && $date->lessThanOrEqualTo($fiscalEndDate);
    }
}
