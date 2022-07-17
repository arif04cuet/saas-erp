<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\JournalEntryDetail;

class JournalEntryDetailRepository extends AbstractBaseRepository
{
    protected $modelName = JournalEntryDetail::class;

    /**
     * Method that returns transactions for given journal entries and transaction type (if given)
     * @param array $journalEntries
     * @param null $transactionType
     * @return mixed
     */
    public function getTransactionsByJournalEntries(array  $journalEntries, $transactionType = null)
    {
        return $this->model->whereIn('journal_entry_id', $journalEntries)
            ->where('account_transaction_type', $transactionType)
            ->get();
    }
}
