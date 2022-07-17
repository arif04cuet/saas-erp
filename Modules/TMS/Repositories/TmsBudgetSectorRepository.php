<?php

namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TmsBudgetSector;

class TmsBudgetSectorRepository extends AbstractBaseRepository {

    protected $modelName = TmsBudgetSector::class;

    public function deleteByBudgetExceptSectors(int $budgetId, array $sectorIds)
    {
        return $this->model->where('tms_budget_id', $budgetId)->whereNotIn('id', $sectorIds)->delete();
    }
}
