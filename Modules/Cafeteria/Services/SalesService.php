<?php

namespace Modules\Cafeteria\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Modules\Cafeteria\Services\SalesItemService;
use Modules\Cafeteria\Repositories\SalesRepository;
use Modules\Cafeteria\Services\CafeteriaInventoryService;

class SalesService
{

    use CrudTrait;

    /**
     * @var $salesRepository;
     * @var $salesItemService
     * @var $cafeteriaInventoryService;
    */

    private $salesRepository;
    private $salesItemService;
    private $cafeteriaInventoryService;

    /**
     * @param SalesRepository $salesRepostiory ;
     * @param \Modules\Cafeteria\Services\SalesItemService $salesItemService
     * @param CafeteriaInventoryService $cafeteriaInventoryService ;
     */

    public function __construct(
        SalesRepository $salesRepostiory,
        SalesItemService $salesItemService,
        CafeteriaInventoryService $cafeteriaInventoryService
    ) {
        $this->salesRepository = $salesRepostiory;
        $this->salesItemService = $salesItemService;
        $this->cafeteriaInventoryService = $cafeteriaInventoryService;
        $this->setActionRepository($this->salesRepository);
    }

    public function storeSalesData(array $data, $type)
    {
        DB::transaction(function () use ($data, $type) {
            if ($data['due'] <= 0) {
                $data['status'] = Config::get('constants.cafeteria.status.paid');
            } else {
                $data['status'] = Config::get('constants.cafeteria.status.due');
            }

            $sales = $this->save($data);

            foreach($data['sales-entries'] as $item) {
                $item['sales_id'] = $sales->id;

                $this->salesItemService->save($item);

                // Update Inventory
                if ($type == 'sales') {
                    $this->deductAmountInInventory($item, $sales->id);
                }
            }

        });
    }

    public function updateSalesData(array $data, $salesId)
    {
        DB::transaction(function () use ($data, $salesId) {
            if ($data['due'] <= 0) {
                $data['status'] = Config::get('constants.cafeteria.status.paid');
            } else {
                $data['status'] = Config::get('constants.cafeteria.status.due');
            }

            $existsData = $this->findOrFail($salesId);
            $data['paid'] += $existsData->paid;
            $existsData->update($data);

            foreach($data['sales-entries'] as $item) {
                $isItemExist = !empty($item['item_id']) ? $this->salesItemService->hasItemInList($item['item_id']) : false;
                $inventoryArr = $item;

                if ($isItemExist) {
                    $findItem = $this->salesItemService->findOrFail($item['item_id']);

                    $qtyExists = $findItem->quantity;
                    $qtyNew = $item['quantity'];
                    $inventoryArr['quantity'] = abs($findItem->quantity - $item['quantity']);

                    $findItem->update($item);

                    // update inventory
                    if($qtyNew > $qtyExists) {
                        $this->deductAmountInInventory($inventoryArr, $salesId);
                    } else {
                        $this->addedAmountInInventory($inventoryArr, $salesId);
                    }
                } else {
                    $item['sales_id'] = $salesId;
                    $this->salesItemService->save($item);
                    $this->deductAmountInInventory($inventoryArr, $salesId);
                }

            }

            $getAllItemIds = collect($data['sales-entries'])->pluck('item_id')->toArray();

            $this->salesItemService->deleteIfItemNotInList($salesId, $getAllItemIds);

        });
    }

    public function deductAmountInInventory($inventoryArr, $salesId)
    {
        $inventoryArr['reference_table'] = Config::get('constants.cafeteria.reference_table.sales');
        $inventoryArr['reference_table_id'] = $salesId;
        $inventoryArr['status'] = Config::get('constants.cafeteria.status.deducted');

        $this->cafeteriaInventoryService->deductMaterialAmountFromInventory($inventoryArr);
    }

    public function addedAmountInInventory($inventoryArr, $salesId)
    {
        $inventoryArr['reference_table'] = Config::get('constants.cafeteria.reference_table.sales');
        $inventoryArr['reference_table_id'] = $salesId;
        $inventoryArr['status'] = Config::get('constants.cafeteria.status.added');

        $this->cafeteriaInventoryService->updateItemAmountInInventory($inventoryArr);
    }

}

