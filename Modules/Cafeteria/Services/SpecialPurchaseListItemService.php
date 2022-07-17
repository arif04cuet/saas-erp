<?php

namespace Modules\Cafeteria\Services;

use App\Traits\CrudTrait;
use Modules\Cafeteria\Repositories\SpecialPurchaseListItemRepository;

class SpecialPurchaseListItemService
{
    use CrudTrait;

    /**
     * @var $specialPurchaseListItemRepository
     */
    
    private $specialPurchaseListItemRepository;

    /**
     * @param SpecialPurchaseListItemRepository $specialPurchaseListItemRepository;
     */

    public function __construct(SpecialPurchaseListItemRepository $specialPurchaseListItemRepository)
    {
        $this->specialPurchaseListItemRepository = $specialPurchaseListItemRepository;
        $this->setActionRepository($this->specialPurchaseListItemRepository);
    }

    public function hasItemInList($id) 
    {
       return $this->specialPurchaseListItemRepository->hasItemInList($id);
    }

    public function deleteIfItemNotInList($purchaseListId, $itemIds)
    {
        $this->specialPurchaseListItemRepository->deleteIfItemNotInList($purchaseListId, $itemIds);
    }
}

