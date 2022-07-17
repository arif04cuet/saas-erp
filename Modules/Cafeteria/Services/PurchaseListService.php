<?php

namespace Modules\Cafeteria\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Utilities\EnToBnNumberConverter;
use Modules\Cafeteria\Services\UnitService;
use Modules\Cafeteria\Services\RawMaterialService;
use Modules\Cafeteria\Services\CafeteriaInventoryService;
use Modules\Cafeteria\Repositories\PurchaseListRepository;
use Modules\Cafeteria\Repositories\PurchaseItemListRepository;

class PurchaseListService
{
    use CrudTrait;

    private $purchaseListRepository;
    private $purchaseItemListRepository;
    private $unitService;
    private $rawMaterialService;
    private $cafeteriaInventoryService;

    public function __construct(
        PurchaseListRepository $purchaseListRepository,
        PurchaseItemListRepository $purchaseItemListRepository,
        UnitService $unitService,
        RawMaterialService $rawMaterialService,
        CafeteriaInventoryService $cafeteriaInventoryService
    ) {
        $this->purchaseListRepository = $purchaseListRepository;
        $this->purchaseItemListRepository = $purchaseItemListRepository;
        $this->unitService = $unitService;
        $this->rawMaterialService = $rawMaterialService;
        $this->cafeteriaInventoryService = $cafeteriaInventoryService;
        $this->setActionRepository($this->purchaseListRepository);
    }

    public function savePurchaseList(array $data)
    {
        DB::transaction(function () use ($data) {

            $data['user_id'] = Auth::user()->id;
            $save = $this->save($data);

            foreach ($data['purchase-list-entries'] as $item) {
                $item['purchase_list_id'] = $save->id;
                $item['status'] = Config::get('constants.cafeteria.status.pending');
                $item['purchase_date'] = $data['purchase_date'];

                $this->purchaseItemListRepository->save($item);
            }
        });
    }

    public function updatePurchaseList(array $data, $purchaseListId)
    {
        DB::transaction(function () use ($data, $purchaseListId) {

            $this->findOrFail($purchaseListId)->update($data);

            foreach ($data['purchase-list-entries'] as $item) {
                $isItemExist = !empty($item['item_id']) ? $this->purchaseItemListRepository->hasItemInList($item['item_id']) : false;

                if ($isItemExist) {
                    $findItem = $this->purchaseItemListRepository->findOrFail($item['item_id']);
                    $findItem->update($item);
                } else {
                    $item['purchase_list_id'] = $purchaseListId;
                    $item['status'] = Config::get('constants.cafeteria.status.pending');
                    $item['purchase_date'] = $data['purchase_date'];

                    $this->purchaseItemListRepository->save($item);
                }
            }

            $getAllItemId = collect($data['purchase-list-entries'])->pluck('item_id')->toArray();

            $this->purchaseItemListRepository->deleteIfItemNotInList($purchaseListId, $getAllItemId);
        });
    }

    public function approvePurchaseList(array $data, $purchaseListId)
    {
        DB::transaction(function () use ($data, $purchaseListId) {

            $this->findOrFail($purchaseListId)->update($data);

            foreach ($data['purchase-list-entries'] as $item) {
                if (!isset($item['status']) || $data['status'] == "rejected") {
                    $item['status'] = Config::get('constants.cafeteria.status.rejected');
                } else {
                    $item['status'] = Config::get('constants.cafeteria.status.approved');

                    $this->updateInventory($data, $item);
                }

                $isItemExist = !empty($item['item_id']) ? $this->purchaseItemListRepository->hasItemInList($item['item_id']) : false;

                if ($isItemExist) {
                    $findItem = $this->purchaseItemListRepository->findOrFail($item['item_id']);
                    $findItem->update($item);
                } else {
                    $item['purchase_list_id'] = $data['purchase_list_id'];
                    $item['purchase_date'] = $data['purchase_date'];
                    
                    $this->purchaseItemListRepository->save($item);
                }
            }
        });
    }

    public function updateInventory($data, $item)
    {
        /** prepare data for update inventory  and invenotory transactions */
        $data['reference_table'] = Config::get('constants.cafeteria.reference_table.purchase-lists');
        $data['reference_table_id'] = $data['purchase_list_id'];
        $data['status'] = Config::get('constants.cafeteria.status.purchased');
        $data['raw_material_id'] = $item['raw_material_id'];
        $data['quantity'] = $item['quantity'];

        $this->cafeteriaInventoryService->updateItemAmountInInventory($data);
    }

    public function getPurchaseListFilterData()
    {
        if (Auth::user()->hasAnyRole(Config::get('constants.cafeteria.roles.cafeteria_manager'))) {
            $purchaseLists = $this->findAll(null, null, ['column' => 'id', 'direction' => 'DESC']);
        } elseif (Auth::user()->hasAnyRole(Config::get('constants.cafeteria.roles.cafeteria_user'))) {
            $purchaseLists = $this->findBy(['user_id' => Auth::user()->id], null, ['column' => 'id', 'direction' => 'DESC']);
        } else {
            $purchaseLists = [];
        }

        return $purchaseLists;
    }

}
