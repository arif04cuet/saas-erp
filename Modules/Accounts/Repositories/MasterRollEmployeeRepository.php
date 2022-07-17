<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\MasterRoll;
use Modules\Accounts\Entities\MasterRollEmployee;

class MasterRollEmployeeRepository extends AbstractBaseRepository
{
    protected $modelName = MasterRollEmployee::class;
}
