<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\GpfLoan;

class GpfLoanRepository extends AbstractBaseRepository {

    protected $modelName = GpfLoan::class;

    public function fetchLoansBetweenRange($employeeId, $from, $to)
    {
        return $this->model->where('employee_id', $employeeId)
            ->whereBetween('sanction_date', [$from, $to]);
    }

    public function getEmployees()
    {
        return GpfLoan::where( 'employee_id', '<>', '0')
            ->distinct('employee_id')
            ->get();
    }
}
