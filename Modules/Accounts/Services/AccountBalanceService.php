<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\AccountBalance;
use Modules\Accounts\Entities\JournalEntryDetail;
use Modules\Accounts\Repositories\AccountBalanceRepository;

class AccountBalanceService
{
    use CrudTrait;
    private $accountTranscationService;

    public function __construct(
        AccountBalanceRepository $accountBalanceHistoryRepository,
        AccountTransactionHistoryService $accountTransactionService
    )
    {
        $this->setActionRepository($accountBalanceHistoryRepository);
        $this->accountTranscationService = $accountTransactionService;
    }

    /**
     * @param $economyCode
     * @param $fiscalYearId
     * @return Model
     */
    public function getCurrentBalance($economyCode, $fiscalYearId)
    {
        $result = $this->actionRepository->getModel()::where([
            ['economy_code', '=', $economyCode],
            ['fiscal_year_id', '=', $fiscalYearId]
        ])->first();

        // if not found, create one and return it
        if (is_null($result)) {
            $result = $this->createNewBalance($economyCode, $fiscalYearId);
        }
        return $result;
    }

    /**
     * @param $economyCode
     * @param $fiscalYearId
     * @return Model
     */
    private function createNewBalance($economyCode, $fiscalYearId)
    {
        $dataArray = [
            'fiscal_year_id' => $fiscalYearId,
            'economy_code' => $economyCode,
            'current_local_balance' => 0,
            'initial_local_balance' => 0,
            'current_revenue_balance' => 0,
            'initial_revenue_balance' => 0,
        ];
        return $this->actionRepository->save($dataArray);
    }

    /**
     * @param AccountBalance $accountBalanceHistory
     * @param JournalEntryDetail $journalEntryDetail
     * @param bool $isCashBookEntry
     * @return Model
     */
    public function updateBalance(
        AccountBalance $accountBalanceHistory,
        JournalEntryDetail $journalEntryDetail,
        bool $isCashBookEntry = false
    ): Model
    {
        $source = $journalEntryDetail->source;
        if ($source == JournalEntryDetail::getSources()[0]) {                                           // local
            return $this->updateLocalBalance($accountBalanceHistory, $journalEntryDetail, $isCashBookEntry);
        } else {                                                                                        // revenue
            return $this->updateRevenueBalance($accountBalanceHistory, $journalEntryDetail, $isCashBookEntry);
        }
    }

    /**
     * @param AccountBalance $accountBalance
     * @param JournalEntryDetail $journalEntryDetail
     * @param bool $isCashBookEntry
     * @return Model
     */
    private function updateLocalBalance(
        AccountBalance $accountBalance,
        JournalEntryDetail $journalEntryDetail,
        bool $isCashBookEntry = false
    )
    {
        $updateArray = [];
        $transactionType = $journalEntryDetail->account_transaction_type;
        $balance = $accountBalance->current_local_balance;
        if ($transactionType == JournalEntryDetail::getTransactionTypes()[0])  // receipt-->Amount in credit-->increment
        {
            $value = 0;
            if ($isCashBookEntry) {
                $value += $journalEntryDetail->debit_amount;
            } else {
                $value += $journalEntryDetail->credit_amount;
            }
            $balance += $value;
            //update total_local_receipt
            $updateArray['total_local_receipt'] = $accountBalance->total_local_receipt + $value;
        } else {                                                               // payment--->Amount in debit-->decrement
            $value = 0;
            if ($isCashBookEntry) {
                $value -= $journalEntryDetail->credit_amount;
            } else {
                $value -= $journalEntryDetail->debit_amount;
            }
            $balance -= $value;
            //update total_local_payment
            $updateArray['total_local_payment'] = abs($accountBalance->total_local_payment - $value);
        }
        $updateArray['current_local_balance'] = $balance;
        if ($this->isFirstLocalBalanceOfFiscalYear($accountBalance)) {
            $updateArray['initial_local_balance'] = $balance;
        }
        return $this->actionRepository->update($accountBalance, $updateArray);
    }


    /**
     * @param AccountBalance $accountBalance
     * @param JournalEntryDetail $journalEntryDetail
     * @param bool $isCashBookEntry
     * @return Model
     */
    private function updateRevenueBalance(
        AccountBalance $accountBalance,
        JournalEntryDetail $journalEntryDetail,
        bool $isCashBookEntry = false
    ): Model
    {
        $updateArray = [];
        $transactionType = $journalEntryDetail->account_transaction_type;
        $balance = $accountBalance->current_revenue_balance;
        if ($transactionType == JournalEntryDetail::getTransactionTypes()[0]) { // receipt--credit has amount--increment it
            $value = 0;
            if ($isCashBookEntry) {
                //for cash entry -- its opposite
                $value += $journalEntryDetail->debit_amount;
            } else {
                $value += $journalEntryDetail->credit_amount;
            }
            $balance += $value;
            //update total_revenue_receipt
            $updateArray['total_revenue_receipt'] = $accountBalance->total_revenue_receipt + $value;
        } else {
            // payment --- debit has amount -- decrement it
            $value = 0;
            if ($isCashBookEntry) {

                $value += $journalEntryDetail->credit_amount;
            } else {
                $value += $journalEntryDetail->debit_amount;
            }
            $balance -= $value;
            //update total_revenue_payment
            $updateArray['total_revenue_payment'] = abs($accountBalance->total_revenue_payment - $value);
        }
        $updateArray['current_revenue_balance'] = $balance;
        if ($this->isFirstRevenueBalanceOfFiscalYear($accountBalance)) {
            $updateArray['initial_revenue_balance'] = $balance;
        }
        return $this->actionRepository->update($accountBalance, $updateArray);
    }

    /**
     * @param AccountBalance $accountBalanceHistory
     * @return bool
     */
    private function isFirstLocalBalanceOfFiscalYear(AccountBalance $accountBalanceHistory): bool
    {
        return $accountBalanceHistory->initial_local_balance == 0.0 && $accountBalanceHistory->current_local_balance == 0.0;
    }

    /**
     * @param AccountBalance $accountBalanceHistory
     * @return bool
     */
    private function isFirstRevenueBalanceOfFiscalYear(AccountBalance $accountBalanceHistory): bool
    {
        return $accountBalanceHistory->initial_revenue_balance == 0.0 && $accountBalanceHistory->current_revenue_balance == 0.0;
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

        return $filtered;
    }

}

