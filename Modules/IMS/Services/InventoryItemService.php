<?php

namespace Modules\IMS\Services;

use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\IMS\Repositories\InventoryItemRepository;

class InventoryItemService
{
    use CrudTrait;
    /**
     * @var InventoryItemRepository
     */
    private $inventoryItemRepository;
    /**
     * @var InventoryItemCategoryService
     */
    private $inventoryItemCategoryService;
    /**
     * @var InventoryLocationService
     */
    private $inventoryLocationService;

    /**
     * InventoryItemService constructor.
     * @param InventoryItemRepository $inventoryItemRepository
     * @param InventoryItemCategoryService $inventoryItemCategoryService
     * @param InventoryLocationService $inventoryLocationService
     */
    public function __construct(
        InventoryItemRepository $inventoryItemRepository,
        InventoryItemCategoryService $inventoryItemCategoryService,
        InventoryLocationService $inventoryLocationService
    ) {
        $this->inventoryItemRepository = $inventoryItemRepository;
        $this->setActionRepository($inventoryItemRepository);
        $this->inventoryItemCategoryService = $inventoryItemCategoryService;
        $this->inventoryLocationService = $inventoryLocationService;
    }

    public function store(array $data)
    {
        try {
            DB::transaction(function () use ($data) {
                $category = $this->inventoryItemCategoryService->findOne($data['inventory_item_category_id']);
                foreach ($data['inventory_item_entries'] as $inventoryItemEntry) {
                    $inventoryItemEntry['inventory_item_category_id'] = $category->id;
                    $inventoryItemEntry['unique_id'] = $this->getUniqueId($category->id);
                    $inventoryItemEntry['created_by'] = Auth::user()->id;
                    $this->save($inventoryItemEntry);
                }
            });
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    public function updateItem(array $data, $id)
    {
        return $this->findOne($id)->update($data);
    }

    /**
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Model|Collection
     */
    public function getInventoryItemCategory($id = null)
    {
        return $id ? $this->inventoryItemCategoryService->findOne($id, ['items']) :
            $this->inventoryItemCategoryService->findAll();
    }

    public function getLocationsForDropdown()
    {
        return $this->inventoryLocationService->getLocationsForDropdown(null, null, null, true);
    }

    public function getUniqueId($categoryId)
    {
        $itemCategory = $this->inventoryItemCategoryService->findOne($categoryId);
        $prefix = ($itemCategory->short_code ?? "ITEM") . '-' . Carbon::parse()->format('y');
        $itemCount = $this->findBy(['inventory_item_category_id' => $categoryId])->count() + 1;
        return $this->inventoryItemCategoryService->generateUniqueId($prefix, $itemCount);
    }

    public function getItemsForDropDown($isEmptyOption = false)
    {
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $this->findBy(['status' => 'active']),
            null,
            function ($item) {
                return $item->title;
            },
            $isEmptyOption
        );
    }

}

