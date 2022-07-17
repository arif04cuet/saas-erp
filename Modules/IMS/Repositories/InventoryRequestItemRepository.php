<?php


namespace Modules\IMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\InventoryRequestItem;

class InventoryRequestItemRepository extends AbstractBaseRepository {

    protected $modelName = InventoryRequestItem::class;

}
