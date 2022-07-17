<?php

namespace Modules\TMS\Services;

use Modules\TMS\Entities\TmsBudget;
use Modules\TMS\Repositories\TrainingRepository;

class TmsAccountsReportService
{
    /**
     * @var TrainingRepository
     */
    private $trainingRepository;
    /**
     * @var TmsJournalEntryService
     */
    private $tmsJournalEntryService;

    /**
     * TmsAccountsReportService constructor.
     * @param TrainingRepository $trainingRepository
     * @param TmsJournalEntryService $tmsJournalEntryService
     */
    public function __construct(TrainingRepository $trainingRepository, TmsJournalEntryService $tmsJournalEntryService)
    {
        $this->trainingRepository = $trainingRepository;
        $this->tmsJournalEntryService = $tmsJournalEntryService;
    }

    /**
     * @param $trainingId
     * @return array
     */
    public function prepareExpenditureData($trainingId): array
    {
        $training = $this->trainingRepository->findOne($trainingId);
        $budget = optional($training)->tmsBudget;

        $sectorsWithBudget = [];
        $sectorsWithExpense = [];
        $sectorsWithVatAndTax = [];
        foreach ($budget->budgetSectors ?? [] as $budgetSector) {
            $subSector = $budgetSector->subSector;
            $sector = $subSector->sector;
            $expense = $this->tmsJournalEntryService->getEntriesWithTrainingAndSector($trainingId, $subSector->id);
            $vatAndTaxInformation = $this->tmsJournalEntryService->getVatAndTaxInfoForSubSectors($trainingId,
                $subSector->id);
            $sectorsWithVatAndTax[$sector->getLocalizedTitle()][$subSector->getLocalizedTitle()] = $vatAndTaxInformation;
            $sectorsWithBudget[$sector->getLocalizedTitle()][$subSector->getLocalizedTitle()][] = [
                'days' => $budgetSector->no_of_days,
                'persons' => $budgetSector->no_of_person,
                'rate' => $budgetSector->rate,
                'total' => $budgetSector->total
            ];
            $sectorsWithExpense[$sector->getLocalizedTitle()][$subSector->getLocalizedTitle()] = $expense;
        }
        return [$sectorsWithBudget, $sectorsWithExpense, $sectorsWithVatAndTax];
    }

    /**
     * @param $trainingId
     * @return array
     */
    public function prepareBudgetData($trainingId): array
    {
        $training = $this->trainingRepository->findOne($trainingId);
        $budget = optional($training)->tmsBudget;

        $sectorWithBudget = [];
        foreach ($budget->budgetSectors ?? [] as $budgetSector) {
            $subSector = $budgetSector->subSector;
            $sector = $subSector->sector;
            $sectorWithBudget[$sector->getLocalizedTitle()][$subSector->getLocalizedTitle()][] = [
                'days' => $budgetSector->no_of_days,
                'persons' => $budgetSector->no_of_person,
                'rate' => $budgetSector->rate,
                'total' => $budgetSector->total,
                'revised_total' => $budgetSector->revised_total,
            ];
        }
        return $sectorWithBudget;
    }
}

