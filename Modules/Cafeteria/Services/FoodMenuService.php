<?php

namespace Modules\Cafeteria\Services;

use Closure;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use App\Utilities\DropDownDataFormatter;
use Modules\Cafeteria\Entities\FoodMenu;
use Modules\Cafeteria\Services\RawMaterialService;
use Modules\Cafeteria\Services\FoodMenuItemService;
use Modules\Cafeteria\Repositories\FoodMenuRepository;

class FoodMenuService
{
    use CrudTrait;

    /**
     * @var $foodMenuRepository
     */
    private $foodMenuRepository;
    /**
     * @var $foodMenuItemService
     */
    private $foodMenuItemService;
    /**
     * @var rawMaterialService;
     */
    private $rawMaterialService;
    /**
     * @var $cafeteriaInventoryService;
     */
    private $cafeteriaInventoryService;

    /**
     * @param FoodMenuRepository $foodMenuRepository
     * @param FoodMenuItemService $foodMenuItemService
     * @param RawMaterialService $rawMaterialService
     */

    public function __construct(
        FoodMenuRepository $foodMenuRepository,
        FoodMenuItemService $foodMenuItemService,
        RawMaterialService $rawMaterialService,
        cafeteriaInventoryService $cafeteriaInventoryService
    ) {
        $this->foodMenuRepository = $foodMenuRepository;
        $this->foodMenuItemService = $foodMenuItemService;
        $this->rawMaterialService = $rawMaterialService;
        $this->cafeteriaInventoryService = $cafeteriaInventoryService;
        $this->setActionRepository($this->foodMenuRepository);
    }

    public function saveFoodMenu(array $data)
    {
        DB::transaction(function () use ($data) {
            $save = $this->save($data);

            $this->saveFoodMenuItems($data, $save['id']);
        });
    }

    public function updateFoodMenu(array $data, $id)
    {
       DB::transaction(function () use ($data, $id) {

            $this->findorfail($id)->update($data);

            $this->foodMenuItemService->deleteFoodMenuItems($id);

            $this->saveFoodMenuItems($data, $id);

       });

    }

    public function saveFoodMenuItems($data, $id)
    {
        /** store food items under a food menu */
        foreach ($data['raw_material_id'] as $value) {
            if ($value == null) {
                continue;
            }

            $foodItems['food_menu_id'] = $id;
            $foodItems['raw_material_id'] = $value;
            $this->foodMenuItemService->save($foodItems);
        }
    }

    public function getFoodMenuForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $foodMenu = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll();
        $lang = App::getLocale();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $foodMenu,
            $implementedKey,
            $implementedValue ?: function ($foodMenu) use ($lang) {
                $name = $lang == 'bn' ? $foodMenu->bn_name : $foodMenu->en_name;
                return $name;
            },
            $isEmptyOption
        );
    }

    public function filter(array $data)
    {
        if(!is_null($data['food_menu_id']) && $data['food_menu_id']) {
            $collection = $this->foodMenuItemService->getFoodItems($data['food_menu_id']);
            $foodItems = $this->getFinishFoodItemsUnderEachMenu($collection);
        } else {
            $collection = $this->rawMaterialService->findBy(['type' => 'finish-food', 'status' => 'active']);
            $foodItems = $this->getAllFinishFoodItems($collection);
        }

        return $foodItems;
    }

    public function getFinishFoodItemsUnderEachMenu($collection)
    {
        $foodItems = [];
        /**
         * prepare data for finish food list
         */
        foreach ($collection as $value) {
            $quantity = $value->rawMaterial->inventories->available_amount;
            $unitPrice = $value->rawMaterial->unitPrices[0]->price;
            if (app()->isLocale('en')) {
                $item['raw_material_name'] = $value->rawMaterial->en_name;
                $item['unit_name'] = $value->rawMaterial->unit->en_name;
            } else {
                $item['raw_material_name'] = $value->rawMaterial->bn_name;
                $item['unit_name'] = $value->rawMaterial->unit->bn_name;
            }
            $item['quantity'] = $quantity;
            $item['unit_price'] = $unitPrice;
            $item['total_price'] = $quantity * $unitPrice;

            array_push($foodItems, $item);
        }

        return $foodItems;
    }

    public function getAllFinishFoodItems($collection)
    {
        $foodItems = [];
        /**
         * prepare data for finish food list
         */
        foreach ($collection as $value) {
            $quantity = $value->inventories->available_amount;
            $unitPrice = $value->unitPrices[0]->price;
            if (app()->isLocale('en')) {
                $item['raw_material_name'] = $value->en_name;
                $item['unit_name'] = $value->unit->en_name;
            } else {
                $item['raw_material_name'] = $value->bn_name;
                $item['unit_name'] = $value->unit->bn_name;
            }
            $item['quantity'] = $quantity;
            $item['unit_price'] = $unitPrice;
            $item['total_price'] = $quantity * $unitPrice;

            array_push($foodItems, $item);
        }

        return $foodItems;
    }
}

