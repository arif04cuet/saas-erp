<?php

namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Carbon\Carbon;
use Modules\Accounts\Entities\Journal;
use Modules\Accounts\Entities\JournalEntry;

class JournalEntryRepository extends AbstractBaseRepository
{
    protected $modelName = JournalEntry::class;

    /**
     * Method that returns journal entries for a particular fiscal year and month (if given)
     * @param $fiscalYearId
     * @param $code
     * @param null $month
     * @param bool $cumulative
     * @return mixed
     */
    public function getJournalTransactions($fiscalYearId, $code, $month = null, $cumulative = false)
    {
        $from = $month? !$cumulative? Carbon::parse($month)->format('Y-m-01') : '1971-01-01' : '1971-01-01';
        $to = $month? Carbon::parse($month)->format('Y-m-t') : Carbon::parse()->format('Y-m-t');

        return $this->model->where('fiscal_year_id', $fiscalYearId)
            ->whereBetween('date', [$from, $to])
            ->leftJoin('journal_entry_details', 'journal_entries.id', '=', 'journal_entry_details.journal_entry_id')
            ->where('journal_entry_details.economy_code', $code)
            ->get();
    }
}
