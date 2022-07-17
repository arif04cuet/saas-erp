<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Modules\TMS\Entities\TmsJournalEntry;
use Modules\TMS\Entities\TmsJournalEntryDetail;
use Modules\TMS\Repositories\TmsCashBookEntryRepository;

class TmsCashBookEntryService
{
    use CrudTrait;

    public function __construct(TmsCashBookEntryRepository $tmsCashBookEntryRepository)
    {
        $this->setActionRepository($tmsCashBookEntryRepository);
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
            'tms_sub_sector_id' => $cashBookEntry['tms_sub_sector_id'] ?? trans('labels.not_found'),
            'debit_amount' => $cashBookEntry['debit_amount'] ?? 0.0,
            'credit_amount' => $cashBookEntry['credit_amount'] ?? 0.0,
            'is_cash_book_entry' => $cashBookEntry['is_cash_book_entry'] ?? false,
        ];
    }

    /**
     * @param TmsJournalEntry $tmsJournalEntry
     * @param TmsJournalEntryDetail $tmsJournalEntryDetail
     * @param array $cashBookEntryArray
     * @return array
     */
    public function prepareCashBookEntryArray(
        TmsJournalEntry $tmsJournalEntry,
        TmsJournalEntryDetail $tmsJournalEntryDetail,
        array $cashBookEntryArray
    ): array {
        $amount = $cashBookEntryArray['debit_amount']
            ? $cashBookEntryArray['debit_amount']
            : $cashBookEntryArray['credit_amount'];
        return [
            'training_id' => $tmsJournalEntry->training_id,
            'tms_journal_entry_detail_id' => $tmsJournalEntryDetail->id,
            'payment_type' => $cashBookEntryArray['payment_type'],
            'date' => $tmsJournalEntry->date,
            'amount' => $amount,
        ];
    }

    public function deleteCashBookEntry(TmsJournalEntry $tmsJournalEntry)
    {
        return $tmsJournalEntry->tmsJournalEntryDetails->each(function ($tmsJournalDetail) {
            $tmsJournalDetail->tmsCashBookEntry()->delete();
        });

    }
}

