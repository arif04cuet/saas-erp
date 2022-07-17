<?php


namespace Modules\IMS\Services;


use App\Traits\CrudTrait;
use Modules\IMS\Entities\InventoryItemCategory;
use Modules\IMS\Repositories\InventoryCategoryGroupRepository;

class InventoryCategoryGroupService
{
    use CrudTrait;

    /**
     * @var InventoryCategoryGroupRepository
     */
    private $inventoryCategoryGroupRepository;

    public function __construct(InventoryCategoryGroupRepository $inventoryCategoryGroupRepository)
    {
        $this->inventoryCategoryGroupRepository = $inventoryCategoryGroupRepository;
        $this->setActionRepository($inventoryCategoryGroupRepository);
    }

    public function updateGroup($groupId, array $data)
    {
        $group = $this->inventoryCategoryGroupRepository->findOne($groupId);
        return $group->update($data);
    }

}
