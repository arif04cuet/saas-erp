<?php


namespace Modules\IMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\IMS\Entities\InventoryItem;

class InventoryItemRepository extends AbstractBaseRepository
{

    protected $modelName = InventoryItem::class;

    /**
     * Returns Collections of Items according to category and location that will pass through parameter
     * If location id is null, will return all the items that has no location for provided categories
     * If location id is default, will return all items for provided categories for all locations
     * @param array $categoryIds
     * @param int|null $locationId
     * @return mixed
     */
    public function getItemsByCategoriesAndLocation(array $categoryIds, $locationId = 0)
    {
        // return is_null($locationId) ? $this->model
        //     ->whereIn('inventory_item_category_id', $categoryIds)
        //     ->whereNull('inventory_location_id')
        //     ->get() : $locationId ?

        //     $this->model
        //         ->whereIn('inventory_item_category_id', $categoryIds)
        //         ->where('inventory_location_id', $locationId)
        //         ->get() : $this->model->whereIn('inventory_item_category_id', $categoryIds)->get();

        if(is_null($locationId)){
            $result = $this->model
            ->whereIn('inventory_item_category_id', $categoryIds)
            ->whereNull('inventory_location_id')
            ->get();
        }elseif($locationId){
            $result = $this->model
            ->whereIn('inventory_item_category_id', $categoryIds)
            ->where('inventory_location_id', $locationId)
            ->get();
        }else{
            $result = $this->model->whereIn('inventory_item_category_id', $categoryIds)->get();
        }

        return $result;
    }
    
        
}
