<?php

namespace Modules\VMS\Services;

use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Modules\VMS\Repositories\VehicleFillingStationRepository;

class VehicleFillingStationService
{
    use CrudTrait;

    /**
     * @var $vehicleFillingStationRepository
     */

    private $vehicleFillingStationRepository;

    /**
     * @param VehicleFillingStationRepository $vehicleFillingStationRepository
     */

    public function __construct(VehicleFillingStationRepository $vehicleFillingStationRepository)
    {
        $this->vehicleFillingStationRepository = $vehicleFillingStationRepository;
        $this->setActionRepository($this->vehicleFillingStationRepository);
    }



    /**
     * @param Closure|null $implementedValue
     * @param Closure|null $implementedKey
     * @param array|null $query
     * @param false $isEmptyOption
     * @return array
     */
    public function getFillingStationForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    )
    {
        $vehicles = $query ? $this->vehicleFillingStationRepository->findBy($query) : $this->vehicleFillingStationRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $vehicles,
            $implementedKey ?: function ($vehicles) {
                return $vehicles->id;
            },
            $implementedValue ?: function ($vehicles) {
                return $vehicles->name;
            },
            $isEmptyOption
        );
    }

}

