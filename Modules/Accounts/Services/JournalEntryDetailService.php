<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\AccountBalance;
use Modules\Accounts\Entities\JournalEntry;
use Modules\Accounts\Entities\JournalEntryDetail;
use Modules\Accounts\Repositories\JournalEntryDetailRepository;

class JournalEntryDetailService
{
    use CrudTrait;
    private $accountTransactionHistoryService;
    private $accountBalanceService;
    private $economySectorService;
    private $economyCodeService;

    public function __construct(
        JournalEntryDetailRepository $journalEntryDetailRepository,
        AccountTransactionHistoryService $accountTransactionHistoryService,
        AccountBalanceService $accountBalanceService,
        EconomySectorService $economySectorService,
        EconomyCodeService $economyCodeService
    ) {
        $this->setActionRepository($journalEntryDetailRepository);
        $this->accountTransactionHistoryService = $accountTransactionHistoryService;
        $this->accountBalanceService = $accountBalanceService;
        $this->economySectorService = $economySectorService;
        $this->economyCodeService = $economyCodeService;
    }

    /**
     * @param array $data
     *
     * @return Model
     */
    public function saveData(array $data)
    {
        /**
         * Steps:
         * --------------------------------------------------------
         * 1. Create Journal Entry Detail
         * 2. Update Account Balance
         * 3. Create Account Transaction
         * ----------------------------------------------------------
         */
        $journalEntryDetail = $this->actionRepository->save($data);
        // update account balance
        $accountBalance = $this->accountBalanceService->getCurrentBalance(
            $data['economy_code'], $data['fiscal_year_id']
        );
        $previousLocalBalance = $accountBalance->current_local_balance;
        $previousRevenueBalance = $accountBalance->current_revenue_balance;
        $accountBalance = $this->updateAccountBalance($data, $accountBalance, $journalEntryDetail);
        // create account transaction
        $accountTransaction = $this->createAccountTransaction(
            $journalEntryDetail,
            $accountBalance,
            $previousLocalBalance,
            $previousRevenueBalance
        );
        return $journalEntryDetail;
    }

    /**
     * @param Model $journalEntryDetail
     * @param Model $accountBalance
     * @param         $previousLocalBalance
     * @param         $previousRevenueBalance
     *
     * @return Model
     */
    private function createAccountTransaction(
        Model $journalEntryDetail,
        Model $accountBalance,
        $previousLocalBalance,
        $previousRevenueBalance
    ): Model {
        $accountTransactionData = [];
        if ($journalEntryDetail->source == JournalEntryDetail::getSources()[0]) // local
        {
            $updatedBalance = $accountBalance->current_local_balance;
            $accountTransactionData = $this->accountTransactionHistoryService->createTransactionArray(
                $journalEntryDetail,
                $accountBalance,
                $previousLocalBalance,
                $updatedBalance
            );
        } else {
            $updatedBalance = $accountBalance->current_revenue_balance;
            $accountTransactionData = $this->accountTransactionHistoryService->createTransactionArray(
                $journalEntryDetail,
                $accountBalance,
                $previousRevenueBalance,
                $updatedBalance
            );
        }
        return $this->accountTransactionHistoryService->save($accountTransactionData);
    }

    /**
     * @param array $data
     * @param Model $accountBalance
     * @param Model $journalEntryDetail
     *
     * @return Model
     */
    private function updateAccountBalance(array $data, Model $accountBalance, Model $journalEntryDetail): Model
    {
        if (isset($data['payment_type'])) {
            // this is a bank/cash entry
            $accountBalance = $this->accountBalanceService->updateBalance($accountBalance, $journalEntryDetail, true);
        } else {
            $accountBalance = $this->accountBalanceService->updateBalance($accountBalance, $journalEntryDetail);
        }
        return $accountBalance;
    }

    /**
     * Detect if an economyCode is a sector code
     * @param $code
     * @return bool|mixed
     */
    public function isEconomySector($code)
    {
        $economyCode = $this->economyCodeService->findBy(['code' => $code])->first();
        if (is_null($economyCode)) {    // i have a sector code, not economyCode
            $economySector = $this->economySectorService->findBy(['code' => $code])->first();
            return $economySector;
        }
        return false;
    }

    /**
     * Change status of Journal entry detail
     *
     * @param JournalEntryDetail $journalEntryDetail
     * @param                      $status
     *
     * @return mixed
     */
    public function changeStatus(JournalEntryDetail $journalEntryDetail, $status)
    {
        return $journalEntryDetail->update(['status' => $status]);
    }
}

