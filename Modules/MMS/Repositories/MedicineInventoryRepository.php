<?php


namespace Modules\MMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\MMS\Entities\MedicineInventory;

class MedicineInventoryRepository extends AbstractBaseRepository
{
    protected $modelName = MedicineInventory::class;

    /**
     * @return mixed
     */
    public function getInventoriesWithMedicine()
    {
        return $this->model
            ->select('medicine_inventories.medicine_id', DB::raw('sum(quantity) as total'), 'medicines.name', 'medicine_groups.name as group')
            ->leftJoin('medicines', 'medicine_inventories.medicine_id', '=', 'medicines.id')
            ->leftJoin('medicine_groups', 'medicines.group_id', '=', 'medicine_groups.id')
            ->groupBy('medicine_inventories.medicine_id')
            ->get();
    }

}
