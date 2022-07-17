<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\Accounts\Entities\EmployeeAdvancePayment;

class EmployeeAdvancePaymentRepository extends AbstractBaseRepository
{
    protected $modelName = EmployeeAdvancePayment::class;

    public function getSummary()
    {
        return $this->getModel()
            ->selectRaw('
                MAX(id) as id,
                employee_id,
                SUM(total_debit_amount) as total_debit_amount,
                SUM(total_credit_amount) as total_credit_amount')
            ->groupBy('employee_id')
            ->get();
    }
}
