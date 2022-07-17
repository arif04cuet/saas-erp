<?php

namespace Modules\Cafeteria\Services;

use App\Traits\CrudTrait;
use Modules\Cafeteria\Repositories\SalesItemRepository;

class SalesItemService
{
    use CrudTrait;

    /**
     * @var $salesItemRepository
     */
    private $salesItemRepository;

    /**
     * @param SalesItemRepository $salesItemRepository
     */

     public function __construct(SalesItemRepository $salesItemRepository)
     {
         $this->salesItemRepository = $salesItemRepository;
         $this->setActionRepository($this->salesItemRepository);
     }

     public function hasItemInList($itemId)
     {
        return $this->salesItemRepository->hasItemInList($itemId);
     }

     public function deleteIfItemNotInList($salesId, $itemId)
     {
        return $this->salesItemRepository->deleteIfItemNotInList($salesId, $itemId);
     }

}

