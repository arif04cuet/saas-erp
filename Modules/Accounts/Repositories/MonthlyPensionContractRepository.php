<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\MonthlyPensionContract;

class MonthlyPensionContractRepository extends AbstractBaseRepository {

    protected $modelName = MonthlyPensionContract::class;

    public function updateByEmployeeId($employeeId, array $values)
    {
        return $this->model->where('employee_id', $employeeId)->update($values);
    }
}
