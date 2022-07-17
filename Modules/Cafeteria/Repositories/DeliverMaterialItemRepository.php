<?php


namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\DeliverMaterialItem;

class DeliverMaterialItemRepository extends AbstractBaseRepository 
{

    protected $modelName = DeliverMaterialItem::class;

    public function hasItemInList($id) 
    {
        return $this->model->where('id', $id)->count() ? true : false;
    }

    public function deleteIfItemNotInList($deliverId, $itemIds)
    {
        return $this->model->where('deliver_material_id', $deliverId)->whereNotIn('id', $itemIds)->delete();
    }

}
