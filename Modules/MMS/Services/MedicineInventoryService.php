<?php


namespace Modules\MMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\MMS\Entities\MedicineInventory;
use Modules\MMS\Entities\MedicineInventoryHistory;
use Modules\MMS\Repositories\MedicineInventoryRepository;
use Modules\MMS\Repositories\MedicineInventoryHistoryRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class MedicineInventoryService
{
    use CrudTrait;

    /**
     * @var $medicineInventoryRepository
     * @var $medicineInventoryHistoryRepository
     */

    private $medicineInventoryRepository;
    private $medicineInventoryHistoryRepository;
    /**
     * @var MedicineInventoryHistoryService
     */
    private $medicineInventoryHistoryService;

    /**
     * @param MedicineInventoryRepository $medicineInventoryRepository
     * @param MedicineInventoryHistoryRepository $medicineInventoryHistoryRepository
     * @param MedicineInventoryHistoryService $medicineInventoryHistoryService ;
     */

    public function __construct(
        MedicineInventoryRepository $medicineInventoryRepository,
        MedicineInventoryHistoryRepository $medicineInventoryHistoryRepository,
        MedicineInventoryHistoryService $medicineInventoryHistoryService

    )
    {
        $this->medicineInventoryRepository = $medicineInventoryRepository;
        $this->medicineInventoryHistoryRepository = $medicineInventoryHistoryRepository;
        $this->medicineInventoryHistoryService = $medicineInventoryHistoryService;
        $this->setActionRepository($this->medicineInventoryRepository);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return $medicineInventory = $this->medicineInventory->save($data);
        });
    }

    public function medicalInventoryStore(array $data)
    {
        try {
            $medicineId = trim($data['medicine_id']);
            $inventory = $this->findBy([
                'medicine_id' => $medicineId
            ])->first();
            $previous_quantity = 0;
            if (empty($inventory)) {
                $inventory = $this->save([
                    'medicine_id' => $medicineId,
                    'quantity' => $data['quantity'],
                    'previous_quantity' => $previous_quantity
                ]);
            } else {
                $previous_quantity = $inventory->quantity;
                $inventory->increment('quantity', $data['quantity']);
                $inventory->previous_quantity = $previous_quantity;
                $inventory->save();
            }
            $data = [
                'medicine_id' => $medicineId,
                'quantity' => $data['quantity'],
                'previous_quantity' => $previous_quantity,
                'flow_type' => 'IN',
                'updated_by' => Auth::id()
            ];
            $this->medicineInventoryHistoryService->save($data);
            return true;
        } catch (\Exception $e) {
            return false;
            Log::error($e->getMessage());
        }

    }

    /**
     * @param array $data
     * @return bool
     */
    public function updateMedicineInventory(MedicineInventory $medicineInventory, array $data)
    {
        return DB::transaction(function () use ($medicineInventory, $data) {
            return $medicineInventory->update($data);
        });

    }

    public function saveMedicineInventoryHistory(MedicineInventoryHistory $medicineInventoryHistory, array $data)
    {
        return DB::transaction(function () use ($medicineInventoryHistory, $data) {
            return $medicineInventoryHistory->save($data);
        });

    }

}
