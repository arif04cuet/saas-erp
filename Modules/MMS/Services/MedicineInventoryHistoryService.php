<?php


namespace Modules\MMS\Services;

use App\Traits\CrudTrait;
use Modules\MMS\Repositories\MedicineInventoryHistoryRepository;


class MedicineInventoryHistoryService
{
    use CrudTrait;

    /**
     * @var $medicineRepository
     * @var $medicineInventoryHistoryRepository
     */

    private $medicineInventoryHistoryRepository;

    /**
     * @param MedicineInventoryHistoryRepository $medicineInventoryHistoryRepository
     */

    public function __construct(MedicineInventoryHistoryRepository $medicineInventoryHistoryRepository)
    {
        $this->medicineInventoryHistoryRepository = $medicineInventoryHistoryRepository;
        $this->setActionRepository($this->medicineInventoryHistoryRepository);
    }


}
