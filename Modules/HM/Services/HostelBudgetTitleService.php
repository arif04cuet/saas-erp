<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 12/6/2018
 * Time: 2:53 PM
 */

namespace Modules\HM\Services;


use App\Traits\CrudTrait;
use Carbon\Carbon;
use Modules\Accounts\Services\FiscalYearService;
use Modules\HM\Entities\HostelBudget;
use Modules\HM\Entities\HostelBudgetSection;
use Modules\HM\Repositories\HostelBudgetTitleRepository;

class HostelBudgetTitleService
{
    use CrudTrait;

    private $hostelBudgetTitleRepository;

    /**
     * @var FiscalYearService
     */
    private $fiscalYearService;


    public function __construct(
        HostelBudgetTitleRepository $hostelBudgetTitleRepository,
        FiscalYearService $fiscalYearService
    ) {
        $this->hostelBudgetTitleRepository = $hostelBudgetTitleRepository;
        $this->setActionRepository($this->hostelBudgetTitleRepository);
        $this->fiscalYearService = $fiscalYearService;
    }

    public function getHostelBudgetTitles($filterByAccountsFiscalYear = false)
    {
        $data = $this->hostelBudgetTitleRepository->getHostelBudgetTitle();
        if ($filterByAccountsFiscalYear) {
            $titleIds = collect(array_keys($data->toArray()));
            $titleIds = $titleIds->filter(function ($titleId) {
                $fiscalYear = $this->getFiscalYearFromHostelBudgetTitle($titleId);
                if (!is_null($fiscalYear)) {
                    return true;
                }
                return false;
            });
            return $this->actionRepository->getHostelBudgets($titleIds->toArray())->pluck('name', 'id');
        }
        return $data;
    }

    public function getTitleWithBudget($id)
    {
        $titleWithBudget = $this->hostelBudgetTitleRepository->getTitleWithHostelBudget($id);
        $incomeBudgets = [];
        $expenseBudgets = [];
        $reportOptions = HostelBudgetSection::getReportShowOptions(true);
        $titleWithBudget->hostelBudgets->each(function ($b) use (
            $reportOptions,
            &$incomeBudgets,
            &$expenseBudgets
        ) {
            $budgetSection = $b->budgetSection;
            if (!isset($incomeBudgets['total_amount']) && !isset($incomeBudgets['total_approved_amount'])
                && !isset($expenseBudgets['total_amount']) && !isset($expenseBudgets['total_approved_amount'])
            ) {
                $incomeBudgets['total_amount'] = 0;
                $incomeBudgets['total_approved_amount'] = 0;
                $expenseBudgets['total_amount'] = 0;
                $expenseBudgets['total_approved_amount'] = 0;
            }
            if ($budgetSection->show_as == $reportOptions[0]) {
                $incomeBudgets['data'][] = $b;
                $incomeBudgets['total_amount'] += $b->budget_amount ?? 0;
                $incomeBudgets['total_approved_amount'] += $b->budget_approved_amount ?? 0;
            } else {
                $expenseBudgets['data'][] = $b;
                $expenseBudgets['total_amount'] += $b->budget_amount ?? 0;
                $expenseBudgets['total_approved_amount'] += $b->budget_approved_amount ?? 0;
            }
        });
        $titleWithBudget['income_budgets'] = $incomeBudgets;
        $titleWithBudget['expense_budgets'] = $expenseBudgets;
        return $titleWithBudget;
    }

    public function getPendingOrApproveTitle()
    {
        return $this->hostelBudgetTitleRepository->getApproveOrPendingTitle();
    }

    public function getHostelBudgetTitleForDropdown($plusMinusFromThisYear = -1, $onlyWithBudgets = false)
    {
        return $this->actionRepository->getHostelBudgetTitleForDropdown($plusMinusFromThisYear, $onlyWithBudgets);
    }

    public function getFiscalYearFromHostelBudgetTitle($hostelBudgetTitleId)
    {
        $hostelBudgetTitle = $this->findOne($hostelBudgetTitleId);
        $currentYear = $hostelBudgetTitle->current_year;
        return $this->fiscalYearService->getFiscalYearByHostelBudgetTitleYear($currentYear);
    }

    public function getHostelBudgetTitleFromDate(Carbon $date)
    {
        $year = $date->year;
        return $this->findBy(['current_year' => $year])->first();
    }

}
