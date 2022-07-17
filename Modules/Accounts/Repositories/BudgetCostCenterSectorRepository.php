<?php

namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\BudgetCostCenterSector;

class BudgetCostCenterSectorRepository extends AbstractBaseRepository {

    protected $modelName = BudgetCostCenterSector::class;

    public function hasSectorInCenter($budgetCostCenterId, $sectorId)
    {
        return $this->model->where('budget_cost_center_id', $budgetCostCenterId)
            ->where('id', $sectorId)->count()? true : false;
    }

    public function deleteSectorsExcept($budgetCostCenterId, array $sectors)
    {
        return $this->model->where('budget_cost_center_id', $budgetCostCenterId)->whereNotIn('id', $sectors)->delete();
    }

    public function getBudgetAmountByCodeAndBudget($code, $budgetId)
    {
        return $this->model->select('budget_cost_center_sectors.*', 'budget_cost_centers.id')
            ->where('economy_sector_code', $code)
            ->leftJoin('budget_cost_centers', 'budget_cost_centers.id', '=', 'budget_cost_center_sectors.budget_cost_center_id' )
            ->where('budget_cost_centers.accounts_budget_id', $budgetId)
            ->first();
    }
}
