<?php

namespace Modules\VMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\VMS\Repositories\VehicleDriverAssignRepository;

class VehicleDriverAssignService
{
    use CrudTrait;

    /**
     * @var VehicleService
     */
    private $vehicleService;
    /**
     * @var DriverService
     */
    private $driverService;

    public function __construct(
        VehicleDriverAssignRepository $vehicleDriverAssignRepository,
        VehicleService $vehicleService,
        DriverService $driverService
    ) {
        $this->setActionRepository($vehicleDriverAssignRepository);
        $this->vehicleService = $vehicleService;
        $this->driverService = $driverService;
    }

    public function getVehiclesForDropdown()
    {
        return $this->vehicleService->getVehiclesForDropdown();
    }

    public function getDriversForDropdown()
    {
        return $this->driverService->getDriversForDropdown();
    }

    public function getAllVehicleInformation()
    {
        return $this->vehicleService->findAll()
            ->each(function ($v) {
                $v->vehicle_type_name = optional($v->vehicleType)->getTitle() ?? trans('labels.not_found');
                return $v;
            })
            ->keyBy('id');
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $this->isAlreadyExist($data);
            $this->save($data);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Driver Assign Error: ' . $exception->getMessage() . " Trace: " . $exception->getTraceAsString());
            Session::flash('duplicate', $exception->getMessage());
            return false;
        }
    }

    public function deleteData(array $data)
    {

        try {
            DB::beginTransaction();
            $vehicleDriverAssign = $this->findBy([
                'driver_id' => $data['driver_id'],
                'vehicle_id' => $data['vehicle_id']
            ])->first();
            $this->delete($vehicleDriverAssign->id);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Driver Assign Deletion Error: ' . $exception->getMessage() . " Trace: " . $exception->getTraceAsString());
            return false;
        }

    }

    //---------------------------------------------------------------------------------
    //                          Private Function
    //---------------------------------------------------------------------------------
    private function isAlreadyExist(array $data)
    {
        $driverAssign = $this->findBy([
            'driver_id' => $data['driver_id'],
            'vehicle_id' => $data['vehicle_id']
        ])->first();
        if (!is_null($driverAssign)) {
            throw new \Exception('Driver Already Assigned');
        }
    }

}

