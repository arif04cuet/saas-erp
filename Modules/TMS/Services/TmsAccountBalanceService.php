<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Collection;
use Modules\TMS\Entities\TmsAccountBalance;
use Modules\TMS\Entities\TmsJournalEntry;
use Modules\TMS\Entities\TmsJournalEntryDetail;
use Modules\TMS\Entities\TmsSubSector;
use Modules\TMS\Repositories\TmsAccountBalanceRepository;

class TmsAccountBalanceService
{
    use CrudTrait;

    public function __construct(TmsAccountBalanceRepository $tmsAccountBalanceRepository)
    {
        $this->setActionRepository($tmsAccountBalanceRepository);
    }

    /**
     * Create an account balance instance from entry and detail
     * @param TmsJournalEntry $tmsJournalEntry
     * @param TmsJournalEntryDetail $tmsJournalEntryDetail
     * @return TmsAccountBalance
     */
    public function createUpdateAccountBalance(
        TmsJournalEntry $tmsJournalEntry,
        TmsJournalEntryDetail $tmsJournalEntryDetail
    ): TmsAccountBalance {
        // if not exist, create first then update
        // if exist, just update
        $accountBalance = $this->findBy(['tms_sub_sector_id' => $tmsJournalEntryDetail->tms_sub_sector_id])->first();
        if (is_null($accountBalance)) {
            $accountBalance = $this->save(
                [
                    'training_id' => $tmsJournalEntry->training_id,
                    'tms_sub_sector_id' => $tmsJournalEntryDetail->tms_sub_sector_id,
                ]
            );
        }
        $totalReceiveAmount = $accountBalance->total_receive_amount;
        $totalPaymentAmount = $accountBalance->total_payment_amount;
        $transactionTypes = array_keys(TmsJournalEntryDetail::getTransactionTypes());
        if ($tmsJournalEntryDetail->transaction_type == $transactionTypes[0]) {
            // if received
            $totalReceiveAmount += $tmsJournalEntryDetail->is_cash_book_entry
                ? $tmsJournalEntryDetail->debit_amount
                : $tmsJournalEntryDetail->credit_amount;
        } else {
            // if payment
            $totalPaymentAmount += $tmsJournalEntryDetail->is_cash_book_entry
                ? $tmsJournalEntryDetail->credit_amount
                : $tmsJournalEntryDetail->debit_amount;
        }
        $this->update($accountBalance,
            ['total_receive_amount' => $totalReceiveAmount, 'total_payment_amount' => $totalPaymentAmount]);

        return $accountBalance;
    }

    /**
     * If journal entry details are about to be deleted, adjust the account balance first !
     * @param TmsJournalEntry $tmsJournalEntry
     */
    public function adjustAccountBalance(TmsJournalEntry $tmsJournalEntry)
    {
        foreach ($tmsJournalEntry->tmsJournalEntryDetails as $tmsJournalEntryDetail) {
            $accountBalance = $this->findBy(['tms_sub_sector_id' => $tmsJournalEntryDetail->tms_sub_sector_id])->first();
            $totalReceiveAmount = $accountBalance->total_receive_amount;
            $totalPaymentAmount = $accountBalance->total_payment_amount;
            $transactionTypes = array_keys(TmsJournalEntryDetail::getTransactionTypes());
            if ($tmsJournalEntryDetail->transaction_type == $transactionTypes[0]) {
                // if received
                $totalReceiveAmount -= $tmsJournalEntryDetail->is_cash_book_entry
                    ? $tmsJournalEntryDetail->debit_amount
                    : $tmsJournalEntryDetail->credit_amount;
            } else {
                // if payment
                $totalPaymentAmount -= $tmsJournalEntryDetail->is_cash_book_entry
                    ? $tmsJournalEntryDetail->credit_amount
                    : $tmsJournalEntryDetail->debit_amount;
            }
            $this->update($accountBalance,
                ['total_receive_amount' => $totalReceiveAmount, 'total_payment_amount' => $totalPaymentAmount]);
        }
    }

    /**
     * @param $trainingId
     * @param $tmsSubSectorId
     * @return Collection - ['total_receive_amount'],['total_receive_amount']
     */
    public function getBalanceInformation($trainingId, $tmsSubSectorId)
    {
        $balanceInformation = collect();
        $tmsAccountBalance = $this
            ->findBy(['tms_sub_sector_id' => $tmsSubSectorId, 'training_id' => $trainingId])
            ->first();
        if (is_null($tmsAccountBalance)) {
            $balanceInformation['total_receive_amount'] = 0.0;
            $balanceInformation['total_payment_amount'] = 0.0;
        } else {
            $balanceInformation['total_receive_amount'] = $tmsAccountBalance->total_receive_amount;
            $balanceInformation['total_payment_amount'] = $tmsAccountBalance->total_payment_amount;
        }
        return $balanceInformation;
    }

}

