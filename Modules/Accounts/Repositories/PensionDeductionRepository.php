<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\PensionDeduction;

class PensionDeductionRepository extends AbstractBaseRepository
{

    protected $modelName = PensionDeduction::class;

}
