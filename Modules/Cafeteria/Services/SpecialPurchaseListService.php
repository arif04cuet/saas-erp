<?php

namespace Modules\Cafeteria\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\Cafeteria\Services\SpecialPurchaseListItemService;
use Modules\Cafeteria\Repositories\SpecialPurchaseListRepository;

class SpecialPurchaseListService
{
  use CrudTrait;

  /**
   * @var $specialPurchaseListRepository
   * @var $specialPurchaseListItemsService
   */

   private $specialPurchaseListRepository;
   private $specialPurchaseListItemService;

   /**
    * @param SpecialPurchaseListRepository $specialPurchaseListRepository
    * @param SpecialPurchaseListItemRepository $specialPurchaseListItemRepository
    */

    public function __construct(
        SpecialPurchaseListRepository $specialPurchaseListRepostiory,
        SpecialPurchaseListItemService $specialPurchaseListItemService
    ) {
        $this->specialPurchaseListRepository = $specialPurchaseListRepostiory;
        $this->specialPurchaseListItemService = $specialPurchaseListItemService;
        $this->setActionRepository($this->specialPurchaseListRepository);
    }

    public function storeSpecialPurchaseList(array $data)
    {
        DB::transaction(function () use($data) {
            $save = $this->save($data);

            foreach ($data['purchase-list-entries'] as $item) {
                $item['special_purchase_list_id'] = $save->id;
    
                $this->specialPurchaseListItemService->save($item);
            }
        });
    }

    public function updateSpecialPurchaseList(array $data, $purchaseListId)
    {
        DB::transaction(function () use ($data, $purchaseListId) {

            $this->findOrFail($purchaseListId)->update($data);

            foreach ($data['purchase-list-entries'] as $item) {
                $isItemExist = !empty($item['item_id']) ? $this->specialPurchaseListItemService->hasItemInList($item['item_id']) : false;

                if ($isItemExist) {
                    $findItem = $this->specialPurchaseListItemService->findOrFail($item['item_id']);
                    $findItem->update($item);
                } else {
                    $item['special_purchase_list_id'] = $purchaseListId;
                    $this->specialPurchaseListItemService->save($item);
                }
            }

            $getAllItemId = collect($data['purchase-list-entries'])->pluck('item_id')->toArray();

            $this->specialPurchaseListItemService->deleteIfItemNotInList($purchaseListId, $getAllItemId);
        });
    }
}

