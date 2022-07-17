<?php

namespace Modules\HM\Services;

use Modules\IMS\Services\InventoryLocationService;
use Modules\IMS\Services\InventoryRequestService;

class HmInventoryService
{
    // TODO:: Dynamically fetch department code for Hostel department
    public const HOSTEL_DEPT_CODE = 'HD';

    /**
     * @var InventoryRequestService
     */
    private $inventoryRequestService;
    /**
     * @var InventoryLocationService
     */
    private $inventoryLocationService;

    /**
     * HmInventoryService constructor.
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
     * Returns the filtered inventory requests for HM
     * @return \Illuminate\Support\Collection
     */
    public function getFilteredInventoryRequests()
    {
        $departmentCode = self::HOSTEL_DEPT_CODE;
        return $this->inventoryRequestService->filterRequestByDepartment($departmentCode);
    }

    /**
     * @return \Modules\IMS\Services\Filtered
     */
    public function getFilteredInventoryLocations()
    {
        $departmentCode = self::HOSTEL_DEPT_CODE;
        return $this->inventoryLocationService->filterLocationByDepartment($departmentCode);
    }
}

