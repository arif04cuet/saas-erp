<?php

namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\GpfLoanDeposit;

class GpfLoanDepositRepository extends AbstractBaseRepository {

    protected $modelName = GpfLoanDeposit::class;

    public function getAllDepositsByEmployeeId($employeeId)
    {
        return $this->model->select('gpf_loan_deposits.*', 'gpf_loans.id', 'gpf_loans.employee_id')
            ->leftJoin('gpf_loans', 'gpf_loan_deposits.gpf_loan_id', '=', 'gpf_loans.id')
            ->where('gpf_loans.employee_id', $employeeId)
            ->get();
    }
}
