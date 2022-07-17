<?php

namespace App\Listeners;

use App\Events\MedicalRequisitionReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Modules\MMS\Services\MedicineInventoryService;
use Modules\MMS\Services\MedicineInventoryHistoryService;
use Modules\MMS\Services\MedicineService;
use Illuminate\Support\Facades\Auth;


class MedicalRequisitionReceiveListener
{
    // use InteractsWithQueue;

    /**
     * @var MedicineService
     */
    private $medicineService;
    /**
     * @var MedicineInventoryService
     */
    private $medicineInventoryService;
    /**
     * @var MedicineInventoryHistoryService
     */
    private $medicineInventoryHistoryService;
    const IN = 'IN';


    /**
     * MedicalRequisitionReceiveListener constructor.
     * @param MedicineService $medicineService
     * @param MedicineInventoryService $medicineInventoryService
     * @param MedicineInventoryHistoryService $medicineInventoryHistoryService
     */
    public function __construct(MedicineService $medicineService, MedicineInventoryService $medicineInventoryService, MedicineInventoryHistoryService $medicineInventoryHistoryService)
    {
        $this->medicineService = $medicineService;
        $this->medicineInventoryService = $medicineInventoryService;
        $this->medicineInventoryHistoryService = $medicineInventoryHistoryService;

    }

    /**
     * @param MedicalRequisitionReceived $event
     * @return bool
     */
    public function handle(MedicalRequisitionReceived $event)
    {
        $event->requisition->each(function ($requisitionDetail, $index) use ($event) {

            $medicinRelationCheck = $this->checkMedicinExistOrNot($requisitionDetail->category_id);

            if ($medicinRelationCheck !== 0) {
                $quantity = (!empty($requisitionDetail->quantity)) ? $requisitionDetail->quantity : 0;
                $medicineId = $medicinRelationCheck;
                $inventoryInfo = $this->updateOrSaveInventory($medicineId, $quantity);
                if (!empty($inventoryInfo['inventory'])) {
                    $priviousQty = $inventoryInfo['previous_quantity'];
                    $this->saveInventoryHistory($medicineId, $quantity, $priviousQty);
                }
            }
        });
        return true;
        // Log::info('RegisterUserHandler::handle');
    }

    /**
     * @param $categoryId
     * @return int
     */
    public function checkMedicinExistOrNot($categoryId)
    {
        $checkMedicin = $this->medicineService->findBy(['category_id' => $categoryId])->first();
        if (!empty($checkMedicin)) {
            return $checkMedicin->id;
        } else {
            return 0;
        }
    }

    /**
     * @param int $medicineId
     * @param int $quantity
     * @return array
     */
    private function updateOrSaveInventory(int $medicineId, int $quantity)
    {
        $inventory = $this->medicineInventoryService->findBy([
            'medicine_id' => $medicineId
        ])->first();
        $previous_quantity = 0;
        if (empty($inventory)) {
            $inventory = $this->medicineInventoryService->save([
                'medicine_id' => $medicineId,
                'quantity' => $quantity,
                'previous_quantity' => $previous_quantity
            ]);
        } else {
            $previous_quantity = $inventory->quantity;
            $inventory->increment('quantity', $quantity);
            $inventory->previous_quantity = $previous_quantity;
            $inventory->save();
        }
        $result = ['inventory' => $inventory, 'previous_quantity' => $previous_quantity];
        return $result;
    }


    /**
     * @param $medicineId
     * @param $quantity
     * @param $priviousQty
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function saveInventoryHistory($medicineId, $quantity, $priviousQty)
    {
        $data = [
            'medicine_id' => $medicineId,
            'quantity' => $quantity,
            'previous_quantity' => $priviousQty,
            'flow_type' => 'IN',
            'updated_by' => Auth::id()
        ];
        return $this->medicineInventoryHistoryService->save($data);

    }
}
