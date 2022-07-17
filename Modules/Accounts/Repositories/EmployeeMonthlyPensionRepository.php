<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\EmployeeMonthlyPension;

class EmployeeMonthlyPensionRepository extends AbstractBaseRepository
{

    protected $modelName = EmployeeMonthlyPension::class;

    public function getDraftPensionsByMonths($employeeId, array $months)
    {
        return count($months) ?
            $this->model->where('employee_id', $employeeId)
                ->whereIn('month', $months)
                ->where('status', 'draft')->get() :
            $this->model->where('employee_id', $employeeId)->where('status', 'draft')->get();
    }

    public function getPensionsWithBasic($employeeId, $month)
    {
        return $this->model->where('employee_id', $employeeId)
            ->where('month', $month)
            ->where('basic_pay', '>', 0)
            ->get();
    }
}
