<?php


namespace Modules\HM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\HM\Entities\HmJournalEntry;

class HmJournalEntryRepository extends AbstractBaseRepository
{

    protected $modelName = HmJournalEntry ::class;


    public function getJournalEntriesWithDetails($fiscalYearId = null, $journalId = null, $month = null)
    {
        $query = $this->model::with('hmJournalEntryDetails.hostelBudgetSection');
        if (!is_null($fiscalYearId)) {
            $query = $query->whereFiscalYearId($fiscalYearId);
        }
        if (!is_null($journalId)) {
            $query = $query->journalId($journalId);
        }
        if (!is_null($month)) {
            $query = $query->whereMonth('date', $month);
        }
        return $query->get();

    }

}
