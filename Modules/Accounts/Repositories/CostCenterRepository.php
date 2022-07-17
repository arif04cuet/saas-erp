<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\CostCenter;

class CostCenterRepository extends AbstractBaseRepository {

    protected $modelName = CostCenter::class;
}
