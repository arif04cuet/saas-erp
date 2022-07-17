<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\LumpSumDeduction;

class LumpSumDeductionRepository extends AbstractBaseRepository
{
    protected $modelName = LumpSumDeduction::class;

}
