<?php

namespace Modules\Cafeteria\Services;

use App\Traits\CrudTrait;
use Modules\Cafeteria\Repositories\FoodMenuItemRepository;

class FoodMenuItemService
{
    use CrudTrait;

    /**
     * @var $foodMenuItemRepository
     */
    private $foodMenuItemRepository;

    /**
     * @param FoodMenuItemRepository $foodMenuItemRepository
     */

    public function __construct(FoodMenuItemRepository $foodMenuItemRepository)
    {
        $this->foodMenuItemRepository = $foodMenuItemRepository;
        $this->setActionRepository($this->foodMenuItemRepository);
    }

    public function deleteFoodMenuItems($id)
    {
        return $this->foodMenuItemRepository->deleteFoodMenuItems($id);
    }

    public function getFoodItems($foodMenuId)
    {
        return $this->foodMenuItemRepository->getFoodItems($foodMenuId);
    }
}

