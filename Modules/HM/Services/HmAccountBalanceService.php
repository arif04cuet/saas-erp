<?php

namespace Modules\HM\Services;

use App\Traits\CrudTrait;
use Modules\HM\Entities\HmAccountBalance;
use Modules\HM\Entities\HmJournalEntry;
use Modules\HM\Entities\HmJournalEntryDetail;
use Modules\HM\Repositories\HmAccountBalanceRepository;

class HmAccountBalanceService
{
    use CrudTrait;

    public function __construct(HmAccountBalanceRepository $hmAccountBalanceRepository)
    {
        $this->setActionRepository($hmAccountBalanceRepository);
    }

    /**
     * Create an account balance instance from entry and detail
     * @param HmJournalEntry $hmJournalEntry
     * @param HmJournalEntryDetail $hmJournalEntryDetail
     * @return HmAccountBalance
     */
    public function createUpdateAccountBalance(
        HmJournalEntry $hmJournalEntry,
        HmJournalEntryDetail $hmJournalEntryDetail
    ): HmAccountBalance {
        // if not exist, create first then update
        // if exist, just update
        $accountBalance = $this->findBy([
            'fiscal_year_id' => $hmJournalEntry->fiscal_year_id,
            'hostel_budget_section_id' => $hmJournalEntryDetail->hostel_budget_section_id
        ])->first();
        if (is_null($accountBalance)) {
            $accountBalance = $this->save(
                [
                    'fiscal_year_id' => $hmJournalEntry->fiscal_year_id,
                    'hostel_budget_section_id' => $hmJournalEntryDetail->hostel_budget_section_id,
                ]
            );
        }
        $totalReceiveAmount = $accountBalance->total_receive_amount;
        $totalPaymentAmount = $accountBalance->total_payment_amount;
        $transactionTypes = HmJournalEntry::transactionTypes();
        if ($hmJournalEntryDetail->transaction_type == $transactionTypes['receive']) {
            $totalReceiveAmount += $hmJournalEntryDetail->is_cash_book_entry
                ? $hmJournalEntryDetail->debit_amount
                : $hmJournalEntryDetail->credit_amount;
        } else {
            $totalPaymentAmount += $hmJournalEntryDetail->is_cash_book_entry
                ? $hmJournalEntryDetail->credit_amount
                : $hmJournalEntryDetail->debit_amount;
        }
        $this->update($accountBalance,
            ['total_receive_amount' => $totalReceiveAmount, 'total_payment_amount' => $totalPaymentAmount]);

        return $accountBalance;
    }

    /**
     * @param $fiscalYearId
     * @param $hostelBudgetSectionId
     * @return Collection - ['total_receive_amount'],['total_receive_amount']
     */
    public function getBalanceInformation($fiscalYearId, $hostelBudgetSectionId)
    {
        $balanceInformation = collect();
        $hmAccountBalance = $this
            ->findBy(['hostel_budget_section_id' => $hostelBudgetSectionId, 'fiscal_year_id' => $fiscalYearId])
            ->first();
        if (is_null($hmAccountBalance)) {
            $balanceInformation['total_receive_amount'] = 0.0;
            $balanceInformation['total_payment_amount'] = 0.0;
        } else {
            $balanceInformation['total_receive_amount'] = $hmAccountBalance->total_receive_amount;
            $balanceInformation['total_payment_amount'] = $hmAccountBalance->total_payment_amount;
        }
        return $balanceInformation;
    }


}

