<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\AccountTransactionHistory;

class AccountTransactionHistoryRepository extends AbstractBaseRepository
{
    protected $modelName = AccountTransactionHistory::class;

}
