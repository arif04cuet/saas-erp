<?php

namespace Modules\HM\Services;

use App\Utilities\EnToBnNumberConverter;
use Modules\Accounts\Services\FiscalYearService;
use Modules\HM\Entities\HostelBudgetSection;
use Modules\HM\Entities\HostelBudgetTitle;

class HmAnnualBudgetReportService
{
    /**
     * @var HostelBudgetTitleService
     */
    private $hostelBudgetTitleService;
    /**
     * @var FiscalYearService
     */
    private $fiscalYearService;
    /**
     * @var HostelBudgetService
     */
    private $hmBudgetService;
    /**
     * @var $hmJournalEntryService
     */
    private $hmJournalEntryService;
    /**
     * @var HostelBudgetSectionService
     */
    private $hostelBudgetSectionService;

    public function __construct(
        FiscalYearService $fiscalYearService,
        HmJournalEntryService $hmJournalEntryService,
        HostelBudgetService $hmBudgetService,
        HostelBudgetSectionService $hostelBudgetSectionService,
        HostelBudgetTitleService $hostelBudgetTitleService
    ) {
        $this->hostelBudgetTitleService = $hostelBudgetTitleService;
        $this->hmBudgetService = $hmBudgetService;
        $this->fiscalYearService = $fiscalYearService;
        $this->hostelBudgetSectionService = $hostelBudgetSectionService;
        $this->hmJournalEntryService = $hmJournalEntryService;
    }

    public function getHostelBudgetTitleForDropdown()
    {
        $hostelBudgetTitles = $this->hostelBudgetTitleService->findAll();
        $filtered = $hostelBudgetTitles->filter(function ($t) {
            return $t->hostelBudgets->count();
        })->pluck('name', 'id');
        return $filtered;
    }

    public function getAnnualBudgetReportData(HostelBudgetTitle $hostelBudgetTitle)
    {
        $fiscalYear = $this->fiscalYearService->getFiscalYearByHostelBudgetTitleYear($hostelBudgetTitle->current_year);
        $previousFiscalYear = $this->fiscalYearService->getFiscalYearByHostelBudgetTitleYear($hostelBudgetTitle->current_year - 1);
        $yearlyIncomeExpenseData = $this->hmJournalEntryService->getIncomeExpenseData(true, false,
            ['fiscal_year' => $previousFiscalYear]);
        $yearlyIncomeExpenseData['budget'] = $this->hmBudgetService->getBudgetOfAllHostelSection($hostelBudgetTitle);
        $yearlyIncomeExpenseData['section'] = $this->getHostelBudgetSectionsForReport();
        $yearlyIncomeExpenseData['fiscal_year'] = $this->fiscalYearService->getFiscalYearName($fiscalYear);
        $yearlyIncomeExpenseData['previous_fiscal_year'] = $this->fiscalYearService->getFiscalYearName($previousFiscalYear);
        return $yearlyIncomeExpenseData;
    }

    public function getHostelBudgetSectionsForReport()
    {
        return $this->hostelBudgetSectionService->findBy(['show_in_report' => 1])->each(function ($b) {
            $b->name = $b->getTitle();
            return $b;
        })->keyBy('id');
    }

    public function getViewFormattedData($budgetReportData)
    {
        $masterData = collect();
        $incomeData = collect();
        $expenseData = collect();
        $reportOptions = HostelBudgetSection::getReportShowOptions(true);
        $incomeSum = 0;
        $budgetIncomeSum = 0;
        $expenseSum = 0;
        $budgetExpenseSum = 0;
        foreach ($budgetReportData['section'] as $key => $value) {
            if ($value->show_as == $reportOptions[0]) {
                //income
                $incomeData[] = $key;
                $incomeSum += isset($budgetReportData['income'][$key]) ? $budgetReportData['income'][$key] : 0;
                $budgetIncomeSum += isset($budgetReportData['budget'][$key]) ? $budgetReportData['budget'][$key] : 0;
            } else {
                //expense
                $expenseData[] = $key;
                $expenseSum += isset($budgetReportData['expense'][$key]) ? $budgetReportData['expense'][$key] : 0;
                $budgetExpenseSum += isset($budgetReportData['budget'][$key]) ? $budgetReportData['budget'][$key] : 0;
            }
        }
        // push the difference of income and expense in expense array
        $expenseData[] = 'difference';
        $masterData['income'] = $incomeData;
        $masterData['expense'] = $expenseData;
        $masterData['difference'] = abs($budgetExpenseSum - $budgetIncomeSum);
        $masterData['incomeSum'] = EnToBnNumberConverter::en2bn($incomeSum);
        $masterData['budgetIncomeSum'] = EnToBnNumberConverter::en2bn($budgetIncomeSum);
        $masterData['expenseSum'] = EnToBnNumberConverter::en2bn($expenseSum);
        $masterData['budgetExpenseSum'] = EnToBnNumberConverter::en2bn($budgetExpenseSum + $masterData['difference']);
        $masterData['maxIncomeNumber'] = count($masterData['income']);
        $masterData['maxExpenseNumber'] = count($masterData['expense']);
        $masterData['maxLoopNumber'] = max($masterData['maxIncomeNumber'], $masterData['maxExpenseNumber']);
        return $masterData;
    }

}

