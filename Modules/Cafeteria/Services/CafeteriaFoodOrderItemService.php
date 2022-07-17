<?php

namespace Modules\Cafeteria\Services;

use App\Traits\CrudTrait;
use Modules\Cafeteria\Repositories\CafeteriaFoodOrderItemRepository;

class CafeteriaFoodOrderItemService
{
    use CrudTrait;

    /**
     * @var $salesItemRepository
     */
    private $cafeteriaFoodOrderItemRepository;

    /**
     * @param cafeteriaFoodOrderItemRepository $cafeteriaFoodOrderItemRepository
     */

     public function __construct(CafeteriaFoodOrderItemRepository $cafeteriaFoodOrderItemRepository)
     {
         $this->cafeteriaFoodOrderItemRepository = $cafeteriaFoodOrderItemRepository;
         $this->setActionRepository($this->cafeteriaFoodOrderItemRepository);
     }

}

