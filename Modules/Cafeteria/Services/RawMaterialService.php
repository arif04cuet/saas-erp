<?php

namespace Modules\Cafeteria\Services;

use Closure;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use App\Utilities\DropDownDataFormatter;
use Modules\Cafeteria\Services\UnitPriceService;
use Modules\Cafeteria\Repositories\RawMaterialRepository;
use Modules\Cafeteria\Services\CafeteriaInventoryService;

class RawMaterialService
{
    use CrudTrait;

    private $rawMaterialRepository;
    private $cafeteriaInventoryService;
    private $unitPriceService;

    public function __construct(
        RawMaterialRepository $rawMaterialRepository,
        CafeteriaInventoryService $cafeteriaInvetoryService,
        UnitPriceService $unitPriceService
    ) {
        $this->rawMaterialRepository = $rawMaterialRepository;
        $this->cafeteriaInventoryService = $cafeteriaInvetoryService;
        $this->unitPriceService = $unitPriceService;
        $this->setActionRepository($this->rawMaterialRepository);
    }

    public function saveRawMaterial(array $data)
    {
        DB::transaction(function () use ($data) {
            /** store raw material */
            $data['status'] = Config::get('constants.cafeteria.status.active');
            $rawMaterial = $this->save($data);

            /** store inventory data */
            $data['raw_material_id'] = $rawMaterial['id'];
            $data['previous_amount'] = 0;

            $this->cafeteriaInventoryService->storeInInventory($data);

            /** store unit price data */
            if ($data['type'] == "finish-food") {
                foreach ($data['category'] as $key => $category) {
                    $arr['category'] = $category;
                    $arr['price'] = $data['price'][$key];
                    $arr['vat'] = $data['vat'][$key];
                    $arr['raw_material_id'] = $rawMaterial['id'];

                    $this->unitPriceService->save($arr);
                }
            }
        });
    }

    public function updateRawMaterial(array $data, $id)
    {
        DB::transaction(function () use ($data, $id) {

            $this->findOrFail($id)->update($data);

            $this->updateUnitPrice($data, $id);
        });
    }

    public function updateUnitPrice($data, $id) 
    {
        if (isset($data['type']) && $data['type'] == "finish-food") {
            foreach ($data['category'] as $key => $category) {
                $arr['category'] = $category;
                $arr['price'] = $data['price'][$key];
                $arr['vat'] = $data['vat'][$key];

                if (isset($data['unit_price_id'])) {
                    $findOne = $this->unitPriceService->findOrFail($data['unit_price_id'][$key]);
                    $findOne->update($arr);
                } else {
                    $arr['raw_material_id'] =  $id;
                    $this->unitPriceService->save($arr);
                }
            }
        } else {
            $count = $this->unitPriceService->findBy(['raw_material_id' => $id])->count();

            /** delete unit price if exists */
            if($count > 0) {
                array_map(function($item) 
                { 
                    $this->unitPriceService->findOrFail($item)->delete(); 
                }, 
                $data['unit_price_id']);
            }
        }
    }

    public function getRawMaterialsForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $materials = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll();
        $lang = App::getLocale();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $materials,
            $implementedKey,
            $implementedValue ?: function ($material) use ($lang) {
                $name = $lang == 'bn' ? $material->bn_name : $material->en_name;
                return $name;
            },
            $isEmptyOption
        );
    }
}
