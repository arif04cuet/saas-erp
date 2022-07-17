<?php


namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\CafeteriaFoodOrderItem;

class CafeteriaFoodOrderItemRepository extends AbstractBaseRepository
{
    protected $modelName = CafeteriaFoodOrderItem::class;

    public function hasItemInList($id)
    {
        return $this->model->where('id', $id)->count() ? true : false;
    }

    public function deleteIfItemNotInList($orderId, $itemIds)
    {
        return $this->model->where('cafeteria_food_order_id', $orderId)->whereNotIn('id', $itemIds)->delete();
    }

}
