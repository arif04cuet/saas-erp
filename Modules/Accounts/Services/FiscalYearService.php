<?php

/**
 * Created by PhpStorm.
 * User: shomrat
 * Date: 10/24/18
 * Time: 7:31 PM
 */

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use App\Utilities\EnToBnNumberConverter;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Lang;
use Modules\Accounts\Entities\FiscalYear;
use Modules\Accounts\Entities\Payslip;
use Modules\Accounts\Repositories\FiscalYearRepository;
use Modules\PMS\Entities\Project;

class FiscalYearService
{
    use CrudTrait;

    protected $fiscalYearRepository;

    /**
     * FiscalYearService constructor.
     *
     * @param FiscalYearRepository $fiscalYearRepository
     */
    public function __construct(FiscalYearRepository $fiscalYearRepository)
    {
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->setActionRepository($fiscalYearRepository);
    }

    public function store(array $data)
    {
        $data['name'] = $this->dateToFiscalYearNameConvert($data['start'], $data['end']);
        $data['start'] = Carbon::parse($data['start']);
        $data['end'] = Carbon::parse($data['end']);
        return $this->save($data);
    }

    public function updateFiscalYear($fiscalYear, array $data)
    {
        $data['name'] = $this->dateToFiscalYearNameConvert($data['start'], $data['end']);
        $data['start'] = Carbon::parse($data['start']);
        $data['end'] = Carbon::parse($data['end']);
        return $this->update($fiscalYear, $data);
    }

    private function dateToFiscalYearNameConvert($startDate, $endDate)
    {
        return date('Y', strtotime($startDate)) . '-' . date('Y', strtotime($endDate));
    }

    /**
     * <h3>Fiscal Year</h3>
     * <p>Custom Implementation of concatenation</p>
     *
     * @param Closure $implementedValue Anonymous Implementation of Value
     * @param Closure $implementedKey Anonymous Implementation Key index
     * @param bool $emptyOption
     *
     * @return array
     */
    public function getFiscalYearsForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        $emptyOption = false
    ) {
        $fiscalYears = $this->actionRepository->findAll(null, null, ['column' => 'end', 'direction' => 'desc']);
        $fiscalYearOptions = [];
        if ($emptyOption) {
            $fiscalYearOptions[0] = Lang::trans('labels.select');
        }
        foreach ($fiscalYears as $fiscalYear) {
            $fiscalYearKey = $implementedKey ? $implementedKey($fiscalYear) : $fiscalYear->id;
            $implementedValue = $implementedValue ?: function ($fiscalYear) {
                return $fiscalYear->name;
            };
            $fiscalYearOptions[$fiscalYearKey] = $implementedValue($fiscalYear);
        }
        return $fiscalYearOptions;
    }

    /**
     * @param Payslip $payslip
     *
     * @return mixed
     */
    public function getFiscalYearFromPayslip(Payslip $payslip)
    {
        $payslipDate = $payslip->period_from;
        //todo:: what the hell! must change this
        $fiscalYear = $this->actionRepository->getModel()
            ->where('start', '<=', '2020-03-01 00:00:00')
            ->where('end', '>=', '2020-03-01 00:00:00')
            ->first();
        return $fiscalYear;
    }

    public function getFiscalYearByHostelBudgetTitleYear($currentYear)
    {
        return $this->actionRepository->getFiscalYearByHostelBudgetTitleYear($currentYear);
    }

    public function getFiscalYearName(FiscalYear $fiscalYear, $localized = true)
    {
        $name = $fiscalYear->name ?? null;
        if ($localized && !is_null($name)) {
            $pieces = explode('-', $name);
            if (isset($pieces[0]) && isset($pieces[1])) {
                $pieces[0] = EnToBnNumberConverter::en2bn($pieces[0], false);
                $pieces[1] = EnToBnNumberConverter::en2bn($pieces[1], false);
            }
            return implode('-', $pieces);
        }
        return trans('labels.not_found');
    }

    public function getFiscalYearByDate($date)
    {
        return $this->fiscalYearRepository->getFiscalYearFromDate($date);
    }

    public function getFiscalYearsForProject(Project $project)
    {
        // we have to return all the fiscal years that covers this project
        $startDate = Carbon::parse($project->created_at)->format('Y-m-d');
        $endDate = Carbon::parse($project->created_at)->addYear($project->duration)->format('Y-m-d');
        return $this->actionRepository->getFiscalYearsBetweenRange($startDate, $endDate);
    }
}
