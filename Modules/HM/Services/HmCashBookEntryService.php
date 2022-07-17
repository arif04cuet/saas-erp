<?php

namespace Modules\HM\Services;

use App\Traits\CrudTrait;
use Modules\HM\Entities\HmJournalEntry;
use Modules\HM\Entities\HmJournalEntryDetail;
use Modules\HM\Repositories\HmCashBookEntryRepository;

class HmCashBookEntryService
{
    use CrudTrait;

    public function __construct(HmCashBookEntryRepository $hmCashBookEntryRepository)
    {
        $this->setActionRepository($hmCashBookEntryRepository);
    }

    /**
     * convert an cash-book-entry-array to tms-journal-entry array
     * @param array $cashBookEntry
     * @return array
     */
    public function convertCashBookEntryToJournalEntry(array $cashBookEntry): array
    {
        return [
            'remark' => 'Cash Book Entry',
            'transaction_type' => $cashBookEntry['transaction_type'] ?? trans('labels.not_found'),
            'hostel_budget_section_id' => $cashBookEntry['hostel_budget_section_id'] ?? trans('labels.not_found'),
            'debit_amount' => $cashBookEntry['debit_amount'] ?? 0.0,
            'credit_amount' => $cashBookEntry['credit_amount'] ?? 0.0,
            'is_cash_book_entry' => $cashBookEntry['is_cash_book_entry'] ?? false,
        ];
    }

    /**
     * @param HmJournalEntry $hmJournalEntry
     * @param HmJournalEntryDetail $hmJournalEntryDetail
     * @param array $cashBookEntryArray
     * @return array
     */
    public function prepareCashBookEntryArray(
        HmJournalEntry $hmJournalEntry,
        HmJournalEntryDetail $hmJournalEntryDetail,
        array $cashBookEntryArray
    ): array {
        $amount = $cashBookEntryArray['debit_amount']
            ? $cashBookEntryArray['debit_amount']
            : $cashBookEntryArray['credit_amount'];
        return [
            'fiscal_year_id' => $hmJournalEntry->fiscal_year_id,
            'hm_journal_entry_detail_id' => $hmJournalEntryDetail->id,
            'payment_type' => $cashBookEntryArray['payment_type'],
            'date' => $hmJournalEntry->date,
            'amount' => $amount,
        ];
    }


}

