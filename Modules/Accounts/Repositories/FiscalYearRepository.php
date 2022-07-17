<?php

/**
 * Created by PhpStorm.
 * User: shomrat
 * Date: 10/10/18
 * Time: 12:10 PM
 */

namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\FiscalYear;

class FiscalYearRepository extends AbstractBaseRepository
{
    protected $modelName = FiscalYear::class;


    public function getFiscalYearByHostelBudgetTitleYear($currentYear)
    {
        return $this->model->newQuery()->whereYear('start', $currentYear)->first();
    }

    public function getFiscalYearFromDate(string $date)
    {
        return $this->model->whereDate('start', '<=', trim($date))->whereDate('end', '>=', trim($date))->first();
    }

    public function getFiscalYearsBetweenRange(string $startDate, string $endDate)
    {
        $startFiscalYear = $this->getFiscalYearFromDate($startDate);
        $endFiscalYear = $this->getFiscalYearFromDate($endDate);
        if (is_null($startFiscalYear) || is_null($endFiscalYear)) {
            return collect();
        }
        $fiscalYears = $this->model->newQuery()
            ->whereDate('start', '>=', $startFiscalYear->start)
            ->whereDate('end', '<=', $endFiscalYear->end)
            ->get();
        return $fiscalYears;
    }
}
