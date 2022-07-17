<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\AccountsBudgetSector;

class AccountsBudgetSectorRepository extends AbstractBaseRepository {

    protected $modelName = AccountsBudgetSector::class;

    public function hasCodeInBudget($budgetId, $code)
    {
         return $this->model->where('accounts_budget_id', $budgetId)->where('code', $code)->count()? true : false;
    }

    public function deleteIfCodesNotInBudget($budgetId, array $codes)
    {
        return $this->model->where('accounts_budget_id', $budgetId)->whereNotIn('code', $codes)->delete();
    }

    public function getAmountByBudgetAndCode($budgetId, $code)
    {
        return $this->model->where('accounts_budget_id', $budgetId)->where('code', $code)->first();
    }
}
