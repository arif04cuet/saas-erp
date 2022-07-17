<?php

namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\TmsBudget;

class TmsBudgetRepository extends AbstractBaseRepository
{

    protected $modelName = TmsBudget::class;
}
