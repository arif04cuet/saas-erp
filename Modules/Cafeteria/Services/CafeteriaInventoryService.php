<?php

namespace Modules\Cafeteria\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Modules\Cafeteria\Repositories\CafeteriaInventoryRepository;
use Modules\Cafeteria\Services\CafeteriaInventoryTransactionService;

class CafeteriaInventoryService
{
    use CrudTrait;

    private $cafeteriaInventoryRepository;
    private $cafeteriaInventoryTransactionService;

    public function __construct(
        CafeteriaInventoryRepository $cafeteriaInventoryRepository,
        CafeteriaInventoryTransactionService $cafeteriaInventoryTransactionService
    ) {
        $this->cafeteriaInventoryRepository = $cafeteriaInventoryRepository;
        $this->cafeteriaInventoryTransactionService = $cafeteriaInventoryTransactionService;
        $this->setActionRepository($this->cafeteriaInventoryRepository);
    }

    public function storeInInventory(array $data)
    {
        $save = $this->save($data);

        $item['reference_table'] = Config::get('constants.cafeteria.reference_table.initiated');
        $item['reference_table_id'] = 0;
        $item['quantity'] = $data['available_amount'];
        $item['status'] = Config::get('constants.cafeteria.status.initiated');

        /** store inventory transaction log */
        $this->storeTransactionLog($save, $item);
    }

    public function updateItemAmountInInventory($item)
    {
        DB::transaction(function () use ($item) {

            $rawMaterialId = $item['raw_material_id'];

            $existItem = $this->cafeteriaInventoryRepository->findOneBy(['raw_material_id' => $rawMaterialId]);

            $inventoryData['available_amount'] = $existItem['available_amount'] + $item['quantity'];
            $inventoryData['previous_amount']  = $existItem['available_amount'];

            $existItem->update($inventoryData);

            /** store inventory transaction log */
            $this->storeTransactionLog($existItem, $item);
        });
    }

    public function deductMaterialAmountFromInventory($item) 
    {    
        DB::transaction(function () use ($item) {
            $rawMaterialId = $item['raw_material_id'];

            $existItem = $this->cafeteriaInventoryRepository->findOneBy(['raw_material_id' => $rawMaterialId]);

            $inventoryData['available_amount'] = $existItem['available_amount'] - $item['quantity'];
            $inventoryData['previous_amount']  = $existItem['available_amount'];

            $existItem->update($inventoryData);

            /** store inventory transaction log */
            $this->storeTransactionLog($existItem, $item);
        });
    }

    public function storeTransactionLog($existItem, $item) 
    {
        $item['cafeteria_inventory_id'] = $existItem->id;
        $item['date'] = date('Y-m-d');

        $this->cafeteriaInventoryTransactionService->save($item);
    }
}
