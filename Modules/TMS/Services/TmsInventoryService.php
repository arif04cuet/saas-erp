<?php

namespace Modules\TMS\Services;

use Modules\IMS\Services\InventoryLocationService;
use Modules\IMS\Services\InventoryRequestService;

class TmsInventoryService
{
    // TODO:: Dynamically fetch department code for training department
    public const TRAINING_DEPT_CODE = 'TD';

    /**
     * @var InventoryRequestService
     */
    private $inventoryRequestService;
    /**
     * @var InventoryLocationService
     */
    private $inventoryLocationService;

    /**
     * TmsInventoryService constructor.
     * @param InventoryRequestService $inventoryRequestService
     * @param InventoryLocationService $inventoryLocationService
     */
    public function __construct(
        InventoryRequestService $inventoryRequestService,
        InventoryLocationService $inventoryLocationService
    ) {

        $this->inventoryRequestService = $inventoryRequestService;
        $this->inventoryLocationService = $inventoryLocationService;
    }

    /**
     * Returns the filtered inventory requests for TMS
     * @return \Illuminate\Support\Collection
     */
    public function getFilteredInventoryRequests()
    {
        $departmentCode = self::TRAINING_DEPT_CODE;
        return $this->inventoryRequestService->filterRequestByDepartment($departmentCode);
    }

    /**
     * @return \Modules\IMS\Services\Filtered
     */
    public function getFilteredInventoryLocations()
    {
        $departmentCode = self::TRAINING_DEPT_CODE;
        return $this->inventoryLocationService->filterLocationByDepartment($departmentCode);
    }
}

