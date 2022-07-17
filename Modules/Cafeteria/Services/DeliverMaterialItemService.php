<?php

namespace Modules\Cafeteria\Services;

use App\Traits\CrudTrait;
use Modules\Cafeteria\Repositories\DeliverMaterialItemRepository;

class DeliverMaterialItemService
{
    use CrudTrait;

    /**
     * @var $deliverMaterialItemRepository
     */
    
    private $deliverMaterialItemRepository;

    /**
     * @param DeliverMaterialItemRepository $deliverMaterialItemRepository
     */

    public function __construct(DeliverMaterialItemRepository $deliverMaterialItemRepository)
    {
        $this->deliverMaterialItemRepository = $deliverMaterialItemRepository;
        $this->setActionRepository($this->deliverMaterialItemRepository);
    }

    public function hasItemInList($id)
    {
        return $this->deliverMaterialItemRepository->hasItemInList($id);
    }

    public function deleteIfItemNotInList($deliverId, $getAllItemId)
    {
        return $this->deliverMaterialItemRepository->deleteIfItemNotInList($deliverId, $getAllItemId);
    }
}

