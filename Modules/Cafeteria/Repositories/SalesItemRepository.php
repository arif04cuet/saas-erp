<?php


namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\SalesItem;

class SalesItemRepository extends AbstractBaseRepository 
{

    protected $modelName = SalesItem::class;

 
    public function hasItemInList($id) 
    {
        return $this->model->where('id', $id)->count() ? true : false;
    }

    public function deleteIfItemNotInList($salesId, $itemIds)
    {
        return $this->model->where('sales_id', $salesId)->whereNotIn('id', $itemIds)->delete();
    }

}
