<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Modules\Accounts\Repositories\EmployeeLumpSumRepository;
use Modules\Accounts\Repositories\LumpSumDeductionRepository;

class LumpSumDeductionService
{
    use CrudTrait;

    public function __construct(LumpSumDeductionRepository $lumpSumDeductionRepository)
    {
        $this->setActionRepository($lumpSumDeductionRepository);
    }


}

