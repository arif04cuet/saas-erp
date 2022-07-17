<?php

namespace Modules\Cafeteria\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Modules\Cafeteria\Repositories\CafeteriaUnsoldFoodRepository;

class CafeteriaUnsoldFoodService
{
    use CrudTrait;

    /**
     * @var CafeteriaUnsoldFoodRepository
     */

    private $cafeteriaUnsoldFoodRepository;

    /**
     * @var RawMaterialService
     */
    private $rawMaterialService;

    /**
     * @var CafeteriaInventoryTransactionService
     */
    private $cafeteriaInventoryTransactionService;

    /**
     * CafeteriaUnsoldFoodService constructor.
     * @param CafeteriaUnsoldFoodRepository $cafeteriaUnsoldFoodRepository
     * @param RawMaterialService $rawMaterialService
     * @param CafeteriaInventoryTransactionService $cafeteriaInventoryTransactionService
     */

   public function __construct(
       CafeteriaUnsoldFoodRepository $cafeteriaUnsoldFoodRepository,
       RawMaterialService $rawMaterialService,
       CafeteriaInventoryTransactionService $cafeteriaInventoryTransactionService
   ) {
       $this->cafeteriaUnsoldFoodRepository = $cafeteriaUnsoldFoodRepository;
       $this->setActionRepository($this->cafeteriaUnsoldFoodRepository);
       $this->rawMaterialService = $rawMaterialService;
       $this->cafeteriaInventoryTransactionService = $cafeteriaInventoryTransactionService;
   }

   public function moveUnsoldFoods()
   {
       $finishFoods = $this->rawMaterialService->findBy(['type' => 'finish-food', 'status' => 'active']);

       foreach ($finishFoods as $food) {
           if ($food->inventories->available_amount) {
               $this->saveUnSoldFoods($food);

               $this->updateInventory($food);
           }
       }
   }

   public function saveUnSoldFoods($food)
   {
       $unsoldArr = [
           'raw_material_id' => $food->id,
           'quantity' => $food->inventories->available_amount
       ];

       $this->save($unsoldArr);

   }

   public function updateInventory($food)
   {
       $inventoryUpdatedData = [
           'previous_amount' => $food->inventories->available_amount,
           'available_amount' => 0,
       ];

       $food->inventories->update($inventoryUpdatedData);

       $this->storeTransactionLog($food);
   }

   public function storeTransactionLog($food)
   {
       $transactionArr = [
           'reference_table' => config('constants.cafeteria.reference_table.unsold-foods'),
           'reference_table_id' => 0,
           'date' => Carbon::today(),
           'cafeteria_inventory_id' => $food->inventories->id,
           'quantity' => $food->inventories->previous_amount,
           'status' => config('constants.cafeteria.status.unsold')
       ];

       $this->cafeteriaInventoryTransactionService->save($transactionArr);
   }

}

