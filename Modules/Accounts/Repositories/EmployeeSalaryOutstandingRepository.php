<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\EmployeeSalaryOutstanding;

class EmployeeSalaryOutstandingRepository extends AbstractBaseRepository
{
    protected $modelName = EmployeeSalaryOutstanding::class;
}
