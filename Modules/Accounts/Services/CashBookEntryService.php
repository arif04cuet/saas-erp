<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use App\Utilities\EnToBnNumberConverter;
use Modules\Accounts\Entities\CashBookEntry;
use Modules\Accounts\Entities\FiscalYear;
use Modules\Accounts\Entities\JournalEntry;
use Modules\Accounts\Entities\JournalEntryDetail;
use Modules\Accounts\Repositories\CashBookEntryRepository;
use Modules\Accounts\Repositories\JournalEntryRepository;
use Modules\Accounts\Repositories\JournalEntryDetailRepository;
use Modules\Accounts\Repositories\JournalRepository;

class CashBookEntryService
{
    use CrudTrait;
    private $journalRepository;
    private $journalEntryRepository;
    private $journalEntryDetailRepository;

    /**
     * CashBookEntryService constructor.
     * @param CashBookEntryRepository $cashBookEntryRepository
     */
    public function __construct(
        CashBookEntryRepository $cashBookEntryRepository,
        JournalEntryRepository $journalEntryRepository,
        JournalEntryDetailRepository $journalEntryDetailRepository,
        JournalRepository $journalRepository

    ) {
        $this->actionRepository = $cashBookEntryRepository;
        $this->journalRepository = $journalRepository;
        $this->journalEntryRepository = $journalEntryRepository;
        $this->journalEntryDetailRepository = $journalEntryDetailRepository;
    }

    /**
     * @param JournalEntryDetail $journalEntryDetail
     * @param                      $paymentType
     *
     * @return array
     */
    public function createCashBookArray(
        JournalEntryDetail $journalEntryDetail,
        $paymentType
    ) {
        $cashBookData = [
            'journal_entry_detail_id' => $journalEntryDetail->id,
            'fiscal_year_id' => $journalEntryDetail->JournalEntry->fiscal_year_id,
            'payment_type' => $paymentType,
        ];
        // for cash entry -- if receipt --> debit has the amount
        // if payment --> credit has the amount
        if ($journalEntryDetail->account_transaction_type == JournalEntryDetail::getTransactionTypes()[0]) {    //receipt
            $cashBookData['amount'] = $journalEntryDetail->debit_amount;
        } else {
            $cashBookData['amount'] = $journalEntryDetail->credit_amount;
        }
        return $cashBookData;
    }

    public function filter(array $data)
    {
        $query = $this->actionRepository->getModel()->newQuery();
        if (!is_null($data['fiscal_year_id']) && $data['fiscal_year_id']) {
            $query->where('fiscal_year_id', $data['fiscal_year_id']);
        }
        $cashBookEntries = $query->orderBy('created_at', 'desc')->get();

        if (!is_null($data['account_transaction_type']) && $data['account_transaction_type']) {
            $transactionType = $data['account_transaction_type'];
            $cashBookEntries = $cashBookEntries->filter(function ($e) use ($transactionType) {
                return $e->journalEntryDetail->account_transaction_type === $transactionType;
            });
        }

        $cashEntries = collect();
        if (!is_null($data['journal_id']) && $data['journal_id']) {

            $journalEntryDetails = $this->getJournalEntryDetails($data['journal_id']);
            foreach ($cashBookEntries as  $cashBookEntry) {
                foreach ($journalEntryDetails as  $journalEntryDetail) {
                    if ($journalEntryDetail['id'] == $cashBookEntry->journal_entry_detail_id) {
                        $cashEntries->push($cashBookEntry);
                    }
                }
            }
            $cashEntries = $cashEntries->unique();
            return  $cashEntries;
        }
        return $cashBookEntries;
    }

    public function getJournalEntryDetails($journalId)
    {
        $journalEntries = $this->journalEntryRepository->findBy(['journal_id' => $journalId]);
        $journalEntryDetails = [];
        foreach ($journalEntries as  $journalEntry) {
            $details = $this->journalEntryDetailRepository->findBy(['journal_entry_id' => $journalEntry->id])->toArray();
            $journalEntryDetails = array_merge($journalEntryDetails, $details);
        }
        return $journalEntryDetails;
    }

    /**
     * Change Cash Book Entry Status
     * This Method will also change Related
     * JournalEntry and Their Details Status
     * @param CashBookEntry $cashBookEntry
     * @param                 $status
     *
     * @return bool
     */
    public function changeStatus(
        CashBookEntry $cashBookEntry,
        $status
    ) {
        $journalEntry = $cashBookEntry->journalEntry;
        if ($journalEntry->procurementBilling) {
            $procurementBilling = $journalEntry->procurementBilling;
            $procurementBilling->update(['status' => $status]);
        }
        $journalEntry->update(['status' => $status]);
        foreach ($journalEntry->journalEntryDetails as $journalEntryDetail) {
            $journalEntryDetail->update(['status' => $status]);
        }
        return $cashBookEntry->update(['status' => $status]);
    }

    /**
     * Format Collection Data As Json Data
     * For DataTables
     * @param $iterables
     * @return mixed
     */
    public function formatToJsonForDataTable($iterables)
    {
        $number = 1;
        return $iterables->each(function ($obj) use (&$number) {
            $obj->index = EnToBnNumberConverter::en2bn($number, false);
            $obj->journal_entry_id = $obj->journalEntryDetail->journalEntry->id;
            $obj->reference = $obj->journalEntryDetail->journalEntry->reference;
            $obj->fiscal_year_name = EnToBnNumberConverter::en2bn($obj->fiscalYear->name, false);
            $obj->account_transaction_type = $obj->journalEntryDetail->account_transaction_type;
            if ($obj->payment_type == 'bank') {
                $obj->bank_amount = EnToBnNumberConverter::en2bn($obj->amount);
                $obj->cash_amount = null;
            } else {
                $obj->bank_amount = null;
                $obj->cash_amount = EnToBnNumberConverter::en2bn($obj->amount);
            }
            $obj->amount = EnToBnNumberConverter::en2bn($obj->amount);
            $number = $number + 1;
        });
    }
}
