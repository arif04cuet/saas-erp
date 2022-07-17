<?php

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Modules\HRM\Repositories\HouseApplicationRepository;

class HouseApplicationHouseDetailService
{
    use CrudTrait;

    public function __construct(HouseApplicationRepository $houseApplicationRepository)
    {
        $this->setActionRepository($houseApplicationRepository);
    }

}

