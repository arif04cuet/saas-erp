<?php

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Config;
use Modules\HRM\Repositories\HouseDetailRepository;

class HouseDetailService
{
    use CrudTrait;

    /**
     * @var $houseDetailRepository 
    */

    private $houseDetailRepository;

    /**
     * @param HouseDetailRepository $houseDetailRepository
     */

    public function __construct(
        HouseDetailRepository $houseDetailRepository,
        HouseCategoryService $houseCategoryService
    ) {
        $this->houseDetailRepository = $houseDetailRepository;
        $this->setActionRepository($this->houseDetailRepository);
    }
}

