<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\AccountBalance;

class AccountBalanceRepository extends AbstractBaseRepository
{
    protected $modelName = AccountBalance::class;


}
