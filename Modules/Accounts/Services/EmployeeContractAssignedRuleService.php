<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Modules\Accounts\Repositories\EmployeeContractAssignedRuleRepository;

class EmployeeContractAssignedRuleService
{
    use CrudTrait;

    protected $employeeContractAssignedRuleRepository;

    public function __construct(EmployeeContractAssignedRuleRepository $employeeContractAssignedRuleRepository)
    {
        $this->employeeContractAssignedRuleRepository = $employeeContractAssignedRuleRepository;
        $this->setActionRepository($this->employeeContractAssignedRuleRepository);

    }


}

