<?php


namespace Modules\Cafeteria\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Cafeteria\Entities\SpecialPurchaseListItem;

class SpecialPurchaseListItemRepository extends AbstractBaseRepository 
{

    protected $modelName = SpecialPurchaseListItem::class;

    public function hasItemInList($id) 
    {
        return $this->model->where('id', $id)->count() ? true : false;
    }

    public function deleteIfItemNotInList($purchaseListId, $itemIds)
    {
        return $this->model->where('special_purchase_list_id', $purchaseListId)->whereNotIn('id', $itemIds)->delete();
    }

}
