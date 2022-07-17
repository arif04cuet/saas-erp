<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 5/15/19
 * Time: 3:26 PM
 */

namespace Modules\IMS\Services;


use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\IMS\Entities\Inventory;
use Modules\IMS\Entities\InventoryItemCategory;
use Modules\IMS\Repositories\InventoryItemCategoryRepository;

class InventoryItemCategoryService
{
    use CrudTrait;
    /**
     * @var InventoryItemCategoryRepository
     */
    private $inventoryItemCategoryRepository;

    public function __construct(InventoryItemCategoryRepository $inventoryItemCategoryRepository)
    {
        /** @var InventoryItemCategoryRepository $inventoryItemCategoryRepository */
        $this->inventoryItemCategoryRepository = $inventoryItemCategoryRepository;
        $this->setActionRepository($inventoryItemCategoryRepository);
    }

    public function store(array $data)
    {
        $data['unique_id'] = $this->generateUniqueId();
        $category = $this->inventoryItemCategoryRepository->save($data);
        return $category;
    }

    public function updateInventoryItemCategory(InventoryItemCategory $inventoryItemCategory, array $data)
    {
        return $inventoryItemCategory->update($data);
    }

    /**
     * <h3>Inventory Item Category Dropdown</h3>
     * <p>Custom Implementation of concatenation</p>
     *
     * @param Closure $implementedValue Anonymous Implementation of Value
     * @param Closure $implementedKey Anonymous Implementation Key index
     * @param array|null $query
     * @param bool $isEmptyOption
     * @return array
     */
    public function getItemCategoryForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $inventoryItemCategories = $query ? $this->inventoryItemCategoryRepository->findBy($query) : $this->inventoryItemCategoryRepository->findAll();

        return DropDownDataFormatter::getFormattedDataForDropdown(
            $inventoryItemCategories,
            $implementedKey,
            $implementedValue ?: function ($inventoryItemCategory) {
                return $inventoryItemCategory->name . ' (' . $inventoryItemCategory->unit . ')';
            },
            $isEmptyOption
        );
    }

    public function getDepartmentalItemCategories()
    {
        $employeeDepartment = get_user_department();
        $locationIds = $employeeDepartment->inventoryLocations->pluck('id');
        $inventories = Inventory::whereIn('location_id', $locationIds)->get();
        $categoryIds = $inventories->pluck('inventory_item_category_id');
        return $itemCategories = InventoryItemCategory::whereIn('id', $categoryIds)->get();
    }

    public function addCategoryPrice($data)
    {
        $inventory = $this->findBy([
            'id' => $data['inventory_item_category_id']
        ])->first();
        return $inventory->update(['price' => $data['price']]);
    }

    /**
     * Generates and returns unique id for new inventory category
     * @param null $prefix
     * @param null $itemCount
     * @return string
     */
    public function generateUniqueId($prefix = null, $itemCount = null)
    {
        $prefix = $prefix ? trim($prefix) : 'INV-CAT-' . Carbon::parse()->format('y');
        $itemCount = str_pad(($itemCount ?? $this->findAll()->count() + 1), 5, "0", STR_PAD_LEFT);
        return strtoupper($prefix . '-' . $itemCount);
    }
}
