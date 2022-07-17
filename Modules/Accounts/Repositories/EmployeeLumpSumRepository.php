<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\EmployeeLumpSum;

class EmployeeLumpSumRepository extends AbstractBaseRepository
{
    protected $modelName = EmployeeLumpSum::class;
}
