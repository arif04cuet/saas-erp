<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\AccountsBudget;

class AccountsBudgetRepository extends AbstractBaseRepository {

    protected $modelName = AccountsBudget::class;
}
