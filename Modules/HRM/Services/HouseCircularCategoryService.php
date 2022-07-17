<?php

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use Modules\HRM\Repositories\HouseCircularCategoryRepository;

class HouseCircularCategoryService
{
    use CrudTrait;

    /**
     * @var $houseCircularCategoryRepository
     */

    private $houseCircularCategoryRepository;

    /**
     * @param HouseCircularCategoryRepository $houseCircularCategoryRepository
     */

    public function __construct(HouseCircularCategoryRepository $houseCircularCategoryRepository)
    {
        $this->houseCircularCategoryRepository = $houseCircularCategoryRepository;
        $this->setActionRepository($this->houseCircularCategoryRepository);
    }

    public function hasItemInList($id)
    {
        return $this->houseCircularCategoryRepository->hasItemInList($id);
    }

    public function deleteIfItemNotInList($houseCircularId, $itemIds) 
    {
        return $this->houseCircularCategoryRepository->deleteIfItemNotInList($houseCircularId, $itemIds);
    }
}

