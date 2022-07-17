<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\EmployeeContract;

class EmployeeContractRepository extends AbstractBaseRepository {

    protected $modelName = EmployeeContract::class;
}
