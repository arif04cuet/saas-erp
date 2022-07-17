<?php

namespace Modules\HM\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Session;
use Modules\HM\Entities\HmCashBookEntry;
use Modules\HM\Entities\HmJournalEntry;
use Modules\HM\Entities\HmJournalEntryDetail;
use Modules\HM\Entities\HostelBudgetSection;
use Modules\HM\Entities\HostelBudgetTitle;
use Modules\HM\Repositories\HmJournalEntryDetailRepository;

class HmJournalEntryDetailService
{
    use CrudTrait;

    /**
     * @var HmCashBookEntryService
     */
    private $hmCashBookEntryService;
    /**
     * @var HostelBudgetService
     */
    private $hmBudgetService;
    /**
     * @var $hmAccountBalanceService
     */
    private $hmAccountBalanceService;

    public function __construct(
        HmJournalEntryDetailRepository $hmJournalEntryDetailRepository,
        HmCashBookEntryService $hmCashBookEntryService,
        HmAccountBalanceService $hmAccountBalanceService,
        HostelBudgetService $hmBudgetService
    ) {
        $this->setActionRepository($hmJournalEntryDetailRepository);
        $this->hmCashBookEntryService = $hmCashBookEntryService;
        $this->hmAccountBalanceService = $hmAccountBalanceService;
        $this->hmBudgetService = $hmBudgetService;
    }

    /**
     * @param HmJournalEntry $hmJournalEntry
     * @param array $hmJournalEntryDetails
     * @param array $cashBookEntry
     * @throws \Exception
     */
    public function store(HmJournalEntry $hmJournalEntry, array $hmJournalEntryDetails, array $cashBookEntry)
    {
        $convertedEntry = $this->hmCashBookEntryService->convertCashBookEntryToJournalEntry($cashBookEntry);
        $hmJournalEntryDetails = collect($hmJournalEntryDetails)->push($convertedEntry)->toArray();
        foreach ($hmJournalEntryDetails as $hmJournalEntryDetail) {
            $budgetMaxValues = $this->getHostelBudgetMaxValues($hmJournalEntry->hostel_budget_title_id);
            //check if budget max value exceeed
            if (!$hmJournalEntryDetail['is_cash_book_entry']) {
                $this->isBudgetValidationPassed($budgetMaxValues, $hmJournalEntryDetail['hostel_budget_section_id'],
                    $hmJournalEntryDetail['debit_amount']);
            }
            // save to journal entry detail table
            $detail = $hmJournalEntry->hmJournalEntryDetails()->save(new HmJournalEntryDetail($hmJournalEntryDetail));
            // save to cash book entry table
            if ($hmJournalEntryDetail['is_cash_book_entry']) {
                $hmCashBookEntryArray = $this->hmCashBookEntryService->prepareCashBookEntryArray($hmJournalEntry,
                    $detail, $cashBookEntry);
                $hmCashBookEntry = $detail->hmCashBookEntry()->save(new HmCashBookEntry($hmCashBookEntryArray));
            }
            // save to account balance table
            $accountBalance = $this->hmAccountBalanceService
                ->createUpdateAccountBalance($hmJournalEntry, $detail);

        }
    }

    public function storeSingleJournalEntryDetail(HmJournalEntry $hmJournalEntry, array $hmJournalEntryDetails)
    {
        return $hmJournalEntry->hmJournalEntryDetails()->save(new HmJournalEntryDetail($hmJournalEntryDetails));
    }

    //------------------------------------------------------------------------------------------------
    //                                  Private Methods
    //-------------------------------------------------------------------------------------------------

    /**
     * check if budget limit crossed
     * @param $budgetMaxValues
     * @param $hostelBudgetSectionId
     * @param $debitAmount
     * @throws \Exception
     */
    private function isBudgetValidationPassed($budgetMaxValues, $hostelBudgetSectionId, $debitAmount)
    {
        $hostelBudgetSection = HostelBudgetSection::find($hostelBudgetSectionId);
        if (!isset($budgetMaxValues[$hostelBudgetSectionId])) {
            throw new \Exception(trans('tms::tms_journal_entry.flash_messages.budget_not_found',
                ['code' => $hostelBudgetSection->getTitle()]));
            Session::flash('budget-exceed', trans('tms::tms_journal_entry.flash_messages.budget_not_found'),
                ['code' => $hostelBudgetSection->getTitle()]);
        }
        if ($debitAmount > $budgetMaxValues[$hostelBudgetSectionId]) {

            throw new \Exception(trans('tms::tms_journal_entry.flash_messages.budget_max_value_exceeded',
                ['code' => $hostelBudgetSection->getTitle()]));
            Session::flash('budget-exceed', trans('tms::tms_journal_entry.flash_messages.budget_max_value_exceeded'),
                ['code' => $hostelBudgetSection->getTitle()]);

        }
    }

    private function getHostelBudgetMaxValues($hostelBudgetTitleId)
    {
        $hostelBudgetTitle = HostelBudgetTitle::find($hostelBudgetTitleId);
        return $this->hmBudgetService->getHostelBudgetMaxValues($hostelBudgetTitle);
    }

}

