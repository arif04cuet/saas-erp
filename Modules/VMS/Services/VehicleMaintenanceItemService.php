<?php

namespace Modules\VMS\Services;

use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Modules\VMS\Repositories\VehicleMaintenanceItemRepository;

class VehicleMaintenanceItemService
{

    use CrudTrait;

    /**
     * @var $vehicleMaintenanceItemRepository
     */
    private $vehicleMaintenanceItemRepository;

    /**
     * VehicleMaintenanceItemService constructor.
     * @param VehicleMaintenanceItemRepository $vehicleMaintenanceItemRepository
     */
    public function __construct(VehicleMaintenanceItemRepository $vehicleMaintenanceItemRepository){
        $this->vehicleMaintenanceItemRepository = $vehicleMaintenanceItemRepository;
        $this->setActionRepository($vehicleMaintenanceItemRepository);

    }


    /**
     * @param Closure|null $implementedValue
     * @param Closure|null $implementedKey
     * @param array|null $query
     * @param false $isEmptyOption
     * @return array
     */
    public function getMaintenanceItemsForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    )
    {
        $maintenanceItem = $query ? $this->vehicleMaintenanceItemRepository->findBy($query) : $this->vehicleMaintenanceItemRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $maintenanceItem,
            $implementedKey ?: function ($maintenanceItem) {
                return $maintenanceItem->id;
            },
            $implementedValue ?: function ($maintenanceItem) {
                return $maintenanceItem->item_name_bn;
            },
            $isEmptyOption
        );
    }
}

