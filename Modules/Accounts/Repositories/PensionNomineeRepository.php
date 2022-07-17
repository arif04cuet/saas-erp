<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\PensionNominee;

class PensionNomineeRepository extends AbstractBaseRepository {
    protected $modelName = PensionNominee::class;

    public function deleteByIds(array $ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

    public function getNomineesByEmployeeId(int $employeeId)
    {
        return $this->model->where('employee_id', $employeeId)->get();
    }
}
