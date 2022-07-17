<?php


namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TmsAdvancePayment;

class TmsAdvancePaymentRepository extends AbstractBaseRepository
{
    protected $modelName = TmsAdvancePayment::class;


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
