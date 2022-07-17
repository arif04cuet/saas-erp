<?php

namespace Modules\Publication\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Modules\Accounts\Entities\JournalEntryDetail;
use Modules\Accounts\Services\FiscalYearService;
use Modules\Accounts\Services\JournalEntryService;
use Modules\Publication\Repositories\PublicationIncomeExpenseEntryRepository;

class PublicationIncomeExpenseEntryService
{
    use CrudTrait;

    /**
     * @var $publicationIncomeExpenseEntryRepository
     * @var $jounalEntryService
     * @var $fiscalYearService
     */

    private $publicationIncomeExpenseEntryRepository;
    private $journalEntryService;
    private $fiscalYearService;

    /**
     * @param PublicationIncomeExpenseEntryRepository $publicationIncomeExpenseEntryRepository
     * @param JournalEntryService $jounalEntryService 
     * @param FiscalYearService $fiscalYearService
     */

    public function __construct(
        JournalEntryService $journalEntryService,
        PublicationIncomeExpenseEntryRepository $publicationIncomeExpenseEntryRepository,
        FiscalYearService $fiscalYearService
    ) {
        $this->journalEntryService = $journalEntryService;
        $this->publicationIncomeExpenseEntryRepository = $publicationIncomeExpenseEntryRepository;
        $this->fiscalYearService = $fiscalYearService;
        $this->setActionRepository($this->publicationIncomeExpenseEntryRepository);
    }

    public function store(array $data)
    {
        try {
            $journalEntryData = $this->prepareJournalEntryData($data);

            $journalEntry = $this->journalEntryService->postJournalEntry($journalEntryData);

            $journalEntryData['journal_entry_id'] = $journalEntry->id;

            $this->save($journalEntryData);

            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function prepareJournalEntryData($data)
    {
        $masterArray = [];
        $journalEntryArray = [];
        $journalEntryDetailArray = [];

        $draft = array_keys(config('constants.journal_entry.statuses'))[0];
        $local = JournalEntryDetail::getSources()[0]; //local
        $fiscalYearId = $this->fiscalYearService->getFiscalYearByDate($data['date'])->id;

        $journalEntryArray = [
            'date' => $data['date'],
            'reference' => $data['reference'],
            'journal_id' => $data['journal_id'],
            'fiscal_year_id' => $fiscalYearId,
            'status' => $draft,
        ];

        foreach ($data['publication_journal_entries'] as $journalEntry) {
            $tempArray = [];
            $tempArray = [
                'economy_code' => $journalEntry['economy_code'],
                'credit_amount' => $journalEntry['credit_amount'],
                'debit_amount' => $journalEntry['debit_amount'],
                'source' => $local,
                'account_transaction_type' => $journalEntry['account_transaction_type'],
                'is_cash_book_entry' => $journalEntry['is_cash_book_entry'],
                'remark' => $journalEntry['remark'],
                'status' => $draft,
            ];
            $journalEntryDetailArray[] = $tempArray;
        }

        // push cash book entry array
        $data['cash_book_entries']['source'] = $local;
        $data['cash_book_entries']['remark'] = null;
        $data['cash_book_entries']['status'] = $draft;
        array_push($journalEntryDetailArray, $data['cash_book_entries']);

        $masterArray['journal_entry_meta_data'] = $journalEntryArray;
        $masterArray['journal_entry_details'] = $journalEntryDetailArray;
        $masterArray['payment_type'] = $data['cash_book_entries']['payment_type'];

        return $masterArray;
    }
}
