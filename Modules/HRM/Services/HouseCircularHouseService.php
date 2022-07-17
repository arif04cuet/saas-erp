<?php

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Modules\HRM\Repositories\HouseCircularHouseRepository;

class HouseCircularHouseService
{
    use CrudTrait;

    /**
     * @var $houseCircularHouseRepository
     */

    private $houseCircularHouseRepository;

    /**
     * @param HouseCircularHouseRepository $houseCircularHouseRepository
     */

    public function __construct(HouseCircularHouseRepository $houseCircularHouseRepository)
    {
        $this->houseCircularHouseRepository = $houseCircularHouseRepository;
        $this->setActionRepository($this->houseCircularHouseRepository);
    }

    public function deleteCircularHouses($catrgory_id)
    {
        return $this->houseCircularHouseRepository->deleteCircularHouses($catrgory_id);
    }
}

