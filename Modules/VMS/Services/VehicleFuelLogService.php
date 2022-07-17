<?php

namespace Modules\VMS\Services;

use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use App\Utilities\DropDownDataFormatter;
use Modules\VMS\Repositories\VehicleFuelLogRepository;
use Modules\VMS\Repositories\VehicleRepository;
use Modules\VMS\Repositories\VehicleFillingStationRepository;

class VehicleFuelLogService
{

    use CrudTrait;
    use FileTrait;

    /**
     * @var $vehicleFuelLogRepository
     * @var $vehicleRepository
     * @var $vehicleFillingStationRepository
     */

    private $vehicleFuelLogRepository;
    private $vehicleRepository;
    private $vehicleFillingStationRepository;

    /**
     * VehicleFuelLogService constructor.
     * @param VehicleFuelLogRepository $vehicleFuelLogRepository
     * @param VehicleRepository $vehicleRepository
     * @param VehicleFillingStationRepository $vehicleFillingStationRepository
     */

    public function __construct(
        VehicleFuelLogRepository $vehicleFuelLogRepository,
        VehicleRepository $vehicleRepository,
        VehicleFillingStationRepository $vehicleFillingStationRepository
    )
    {
        $this->vehicleFuelLogRepository = $vehicleFuelLogRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->vehicleFillingStationRepository = $vehicleFillingStationRepository;
        $this->setActionRepository($this->vehicleFuelLogRepository);
    }


    /**
     * @param Closure|null $implementedValue
     * @param Closure|null $implementedKey
     * @param array|null $query
     * @param false $isEmptyOption
     * @return array
     */
    public function getVehiclesForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    )
    {
        $vehicles = $query ? $this->vehicleRepository->findBy($query) : $this->vehicleRepository->findAll();
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


    public function acknowledgementFiles($data)
    {
        $vehicleFuelLog = $this->vehicleFuelLogRepository->findOrFail($data['id']);

        $photo = $this->storeRequesterFiles($data);
        if ($vehicleFuelLog->update(['acknowledgement_slip' => $photo[0], 'status' => 1])) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param $data
     * @return array
     */
    private function storeRequesterFiles($data): array
    {
        $photoPath = array_key_exists('photo', $data) ? $this->upload($data['photo'], 'vms_fuel_voucher_attachment') : null;

        return array($photoPath);
    }

    /**
     * @return array
     */
    public function getFillingStationIds()
    {
        return $this->vehicleFillingStationRepository->findAll()->pluck('id')->toArray();
    }


}

