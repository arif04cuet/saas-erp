<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Auth;
use Modules\Accounts\Entities\AccountBalance;
use Modules\Accounts\Entities\JournalEntryDetail;
use Modules\Accounts\Repositories\AccountTransactionHistoryRepository;

class AccountTransactionHistoryService
{
    use CrudTrait;

    public function __construct(AccountTransactionHistoryRepository $accountTransactionRepository)
    {
        $this->setActionRepository($accountTransactionRepository);
    }

    /**
     * @param JournalEntryDetail $journalEntryDetail
     * @param AccountBalance $accountBalanceHistory
     * @param $previousBalance
     * @param $updatedBalance
     * @return array
     */
    public function createTransactionArray(
        JournalEntryDetail $journalEntryDetail,
        AccountBalance $accountBalanceHistory,
        $previousBalance,
        $updatedBalance
    )
    {
        return [
            'employee_id' => Auth::id(), // this can not be accessed from worker
            'economy_code' => $journalEntryDetail->economy_code,
            'journal_entry_detail_id' => $journalEntryDetail->id,
            'fiscal_year_id' => $journalEntryDetail->journalEntry->fiscal_year_id,
            'previous_balance' => $previousBalance,
            'updated_balance' => $updatedBalance,
        ];
    }

    public function filter(array $data)
    {
        $query = $this->actionRepository->getModel()->newQuery();

        if (!is_null($data['economy_code'])) {
            $query->where('economy_code', $data['economy_code']);
        }

        if (!is_null($data['fiscal_year_id'])) {
            $query->where('fiscal_year_id', $data['fiscal_year_id']);
        }


        $filtered = $query->get();

        if (!is_null($data['source'])) {
            $filtered = $filtered->filter(function ($obj) use ($data) {
                return $obj->journalEntryDetail->source == $data['source'];
            });
        }
        return $filtered;
    }
}

