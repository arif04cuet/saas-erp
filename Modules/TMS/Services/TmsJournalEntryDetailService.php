<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Modules\HM\Entities\HmAccountBalance;
use Modules\TMS\Entities\TmsAccountBalance;
use Modules\TMS\Entities\TmsBudget;
use Modules\TMS\Entities\TmsCashBookEntry;
use Modules\TMS\Entities\TmsJournalEntry;
use Modules\TMS\Entities\TmsJournalEntryDetail;
use Modules\TMS\Entities\TmsSubSector;
use Modules\TMS\Entities\TmsVatTaxDetail;
use Modules\TMS\Repositories\TmsJournalEntryDetailRepository;

class TmsJournalEntryDetailService
{
    use CrudTrait;

    /**
     * @var TmsCashBookEntry
     */
    private $tmsCashBookEntryService;
    /**
     * @var TmsAccountBalance
     */
    private $tmsAccountBalanceService;
    /**
     * @var TmsBudgetService
     */
    private $tmsBudgetService;
    /**
     * @var TmsVatTaxDetailService
     */
    private $tmsVatTaxDetailService;

    /**
     * TmsJournalEntryDetailService constructor.
     * @param TmsJournalEntryDetailRepository $tmsJournalEntryDetailRepository
     * @param TmsCashBookEntryService $tmsCashBookEntryService
     * @param TmsBudgetService $tmsBudgetService
     * @param TmsVatTaxDetailService $tmsVatTaxDetailService
     * @param TmsAccountBalanceService $tmsAccountBalanceService
     */
    public function __construct(
        TmsJournalEntryDetailRepository $tmsJournalEntryDetailRepository,
        TmsCashBookEntryService $tmsCashBookEntryService,
        TmsBudgetService $tmsBudgetService,
        TmsVatTaxDetailService $tmsVatTaxDetailService,
        TmsAccountBalanceService $tmsAccountBalanceService
    ) {
        $this->setActionRepository($tmsJournalEntryDetailRepository);
        $this->tmsCashBookEntryService = $tmsCashBookEntryService;
        $this->tmsBudgetService = $tmsBudgetService;
        $this->tmsVatTaxDetailService = $tmsVatTaxDetailService;
        $this->tmsAccountBalanceService = $tmsAccountBalanceService;
    }

    /**
     * @param TmsJournalEntry $tmsJournalEntry
     * @param array $tmsJournalEntryDetails
     * @param array $cashBookEntry
     * @throws \Exception
     */
    public function store(TmsJournalEntry $tmsJournalEntry, array $tmsJournalEntryDetails, array $cashBookEntry)
    {
        $convertedEntry = $this->tmsCashBookEntryService->convertCashBookEntryToJournalEntry($cashBookEntry);
        $tmsJournalEntryDetails = collect($tmsJournalEntryDetails)->push($convertedEntry)->toArray();
        $budgetMaxValues = $this->tmsBudgetService->getBudgetMaxValuesForTraining($tmsJournalEntry->training);
        foreach ($tmsJournalEntryDetails as $tmsJournalEntryDetail) {
            //check if budget max value exceeed
            $this->isBudgetValidationPassed($budgetMaxValues, $tmsJournalEntryDetail['tms_sub_sector_id'],
                $tmsJournalEntryDetail['debit_amount']);
            // save to journal entry detail table
            $detail = $tmsJournalEntry->tmsJournalEntryDetails()->save(new TmsJournalEntryDetail($tmsJournalEntryDetail));
            // save to tms-vat-tax-details-table
            $vatTaxDetail = $this->tmsVatTaxDetailService->createOrUpdate($tmsJournalEntry, $detail,
                $tmsJournalEntryDetail);
            // save to cash book entry table
            if ($tmsJournalEntryDetail['is_cash_book_entry']) {
                $tmsCashBookEntryArray = $this->tmsCashBookEntryService->prepareCashBookEntryArray($tmsJournalEntry,
                    $detail, $cashBookEntry);
                $tmsCashBookEntry = $detail->tmsCashBookEntry()->save(new TmsCashBookEntry($tmsCashBookEntryArray));
            }
            // save to account balance table
            $accountBalance = $this->tmsAccountBalanceService
                ->createUpdateAccountBalance($tmsJournalEntry, $detail);
        }
    }

    public function updateData(TmsJournalEntry $tmsJournalEntry, array $tmsJournalEntryDetails, array $cashBookEntry)
    {
        $convertedEntry = $this->tmsCashBookEntryService->convertCashBookEntryToJournalEntry($cashBookEntry);
        $tmsJournalEntryDetails = collect($tmsJournalEntryDetails)->push($convertedEntry)->toArray();
        // adjust the balance for previous values
        $this->tmsAccountBalanceService->adjustAccountBalance($tmsJournalEntry);
        // delete cashBookEntry
        $this->tmsCashBookEntryService->deleteCashBookEntry($tmsJournalEntry);
        // delete all the entries
        $tmsJournalEntry->tmsJournalEntryDetails()->delete();
        // recreate everything
        foreach ($tmsJournalEntryDetails as $tmsJournalEntryDetail) {
            // save to journal entry detail table
            $detail = $tmsJournalEntry->tmsJournalEntryDetails()->save(new TmsJournalEntryDetail($tmsJournalEntryDetail));
            // save to tms-vat-tax-details-table
            $vatTaxDetail = $this->tmsVatTaxDetailService->createOrUpdate($tmsJournalEntry, $detail,
                $tmsJournalEntryDetail);
            // save to cash book entry table
            if ($tmsJournalEntryDetail['is_cash_book_entry']) {
                $tmsCashBookEntryArray = $this->tmsCashBookEntryService->prepareCashBookEntryArray($tmsJournalEntry,
                    $detail, $cashBookEntry);
                $tmsCashBookEntry = $detail->tmsCashBookEntry()->save(new TmsCashBookEntry($tmsCashBookEntryArray));
            }
            // save to account balance table
            $accountBalance = $this->tmsAccountBalanceService->createUpdateAccountBalance($tmsJournalEntry, $detail);
        }
    }

    /**
     * |----------------------------------------------------------------------------------------------------------------
     * |                                         Private Methods
     * |----------------------------------------------------------------------------------------------------------------
     * |
     */

    /**
     * Check if max value crossed for any sector
     * @param $budgetMaxValues
     * @param $tmsSubSectorId - user selected sub sector
     * @param $debitAmount - user input
     * @throws \Exception
     */
    private function isBudgetValidationPassed($budgetMaxValues, $tmsSubSectorId, $debitAmount)
    {
        if (!isset($budgetMaxValues[$tmsSubSectorId])) {
            return;
        }
        if ($debitAmount > $budgetMaxValues[$tmsSubSectorId]) {
            $tmsSubSector = TmsSubSector::find($tmsSubSectorId);
            throw new \Exception(trans('tms::tms_journal_entry.flash_messages.budget_max_value_exceeded',
                ['code' => $tmsSubSector->getTitle()]));
        }
    }

    private function checkIfVatAndTaxSectorDefined(TmsJournalEntry $tmsJournalEntry)
    {
        $training = $tmsJournalEntry->training;
        $budget = optional($training)->budget ?? null;
        if (!is_null($budget)) {
            $tmsVatSubSectorId = $budget->tms_vat_sub_sector_id ?? null;
            $tmsTaxSubSectorId = $budget->tms_tax_sub_sector_id ?? null;
            if ($tmsVatSubSectorId || $tmsTaxSubSectorId) {
                throw new \Exception(trans('tms::tms_journal_entry.flash_messages.vat_tax_sub_sector'));
            }
        } else {
            throw new \Exception(trans('tms::tms_journal_entry.flash_messages.vat_tax_sub_sector'));
        }
    }
}

