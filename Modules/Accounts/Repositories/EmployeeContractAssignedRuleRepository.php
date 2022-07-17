<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\EmployeeContractAssignedRule;

class EmployeeContractAssignedRuleRepository extends AbstractBaseRepository
{
    protected $modelName = EmployeeContractAssignedRule::class;
}
