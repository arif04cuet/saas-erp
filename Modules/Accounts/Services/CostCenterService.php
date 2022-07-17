<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Modules\Accounts\Repositories\CostCenterRepository;

class CostCenterService
{
    use CrudTrait;

    /**
     * @var CostCenterRepository
     */
    private $costCenterRepository;

    /**
     * CostCenterService constructor.
     * @param CostCenterRepository $costCenterRepository
     */
    public function __construct(CostCenterRepository $costCenterRepository)
    {
        $this->costCenterRepository = $costCenterRepository;
        $this->setActionRepository($costCenterRepository);
    }
}

