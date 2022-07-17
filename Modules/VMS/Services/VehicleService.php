<?php

namespace Modules\VMS\Services;

use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\VMS\Entities\Driver;
use Modules\VMS\Entities\Trip;
use Modules\VMS\Entities\Vehicle;
use Modules\VMS\Entities\VehicleType;
use Modules\VMS\Repositories\VehicleRepository;

class VehicleService
{
    use CrudTrait;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->actionRepository = $vehicleRepository;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $data = $this->prepareData($data);
            $this->save($data);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Driver Feature Update Error : ' . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * @param array $data
     * @param Vehicle $vehicle
     * @return bool
     */
    public function updateData(array $data, Vehicle $vehicle)
    {
        try {
            DB::beginTransaction();
            $this->update($vehicle, $data);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Vehicle Feature Update Error : ' . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * @param Vehicle $vehicle
     */
    public function setSessionValues(Vehicle $vehicle)
    {
        session(['_old_input.name' => $vehicle->name ?? trans('labels.not_found')]);
        session(['_old_input.model' => $vehicle->model ?? trans('labels.not_found')]);
        session(['_old_input.registration_number' => $vehicle->registration_number ?? trans('labels.not_found')]);
        session(['_old_input.price' => $vehicle->price ?? trans('labels.not_found')]);
        session(['_old_input.seat' => $vehicle->seat ?? trans('labels.not_found')]);
        session(['_old_input.cc' => $vehicle->cc ?? trans('labels.not_found')]);
        session(['_old_input.chassis_number' => $vehicle->chassis_number ?? trans('labels.not_found')]);
        session(['_old_input.purchase_date' => $vehicle->purchase_date ?? trans('labels.not_found')]);
        session(['_old_input.vehicle_type_id' => $vehicle->vehicle_type_id ?? trans('labels.not_found')]);
    }

    public function clearSessionValues()
    {
        if (session()->has('_old_input.name')) {
            session()->forget('_old_input.name');
        }
        if (session()->has('_old_input.model')) {
            session()->forget('_old_input.model');
        }
        if (session()->has('_old_input.registration_number')) {
            session()->forget('_old_input.registration_number');
        }
        if (session()->has('_old_input.price')) {
            session()->forget('_old_input.price');
        }
        if (session()->has('_old_input.seat')) {
            session()->forget('_old_input.seat');
        }
        if (session()->has('_old_input.cc')) {
            session()->forget('_old_input.cc');
        }
        if (session()->has('_old_input.chassis_number')) {
            session()->forget('_old_input.chassis_number');
        }
        if (session()->has('_old_input.purchase_date')) {
            session()->forget('_old_input.purchase_date');
        }
        if (session()->has('_old_input.vehicle_type_id')) {
            session()->forget('_old_input.vehicle_type_id');
        }
    }

    /**
     * @return array
     */
    public function getVehiclesForDropdown()
    {
        $vehicles = $this->findAll();
        $valueClosure = function ($d) {
            return $d->name . '-' . $d->model;
        };
        return DropDownDataFormatter::getFormattedDataForDropdown($vehicles, null, $valueClosure);
    }

    /**
     * @return array
     */
    public function getFuelTypesForDropdown()
    {
        $fuelTypes = Vehicle::getFuelTypes();
        $dropdownData = [];
        foreach ($fuelTypes as $fuelType) {
            $dropdownData[$fuelType] = trans('vms::vehicle.fuel_type.' . $fuelType);
        }
        return $dropdownData;
    }

    /**
     * @param array $data
     * @return Builder[]|Collection
     */
    public function getVehicles(array $data)
    {
        return $this->actionRepository->getVehicles($data);
    }

    /**
     * @param Vehicle $vehicle
     * @param $status
     * @return bool
     * @throws Exception
     */
    public function changeStatus(Vehicle $vehicle, $status)
    {

        try {
            DB::beginTransaction();
            $approvedStatus = Vehicle::getStatuses();
            if (!array_key_exists($status, $approvedStatus)) {
                // in case someone clever tries to change status from url ;)
                throw new Exception('Wrong Status Input');
                return false;
            }
            $changedStatus = $approvedStatus[$status];
            $vehicle = $vehicle->update(['status' => $changedStatus]);
            DB::commit();
            return $vehicle;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($status . ' does not exist in vehicle status !');
            return false;
        }
    }

    /**
     * If trip is ongoing, make vehicles unavailable
     * If trip is completed, vehicle will be available again
     * @param Trip $trip
     * @param $status
     * @throws Exception
     */
    public function changeStatusByTripStatus(Trip $trip, $status)
    {

//            'pending' => 'pending', -available
//            'rejected' => 'rejected',- available
//            'cancelled' => 'cancelled', -available
//            'approved' => 'approved', - unavailbe
//            'ongoing' => 'ongoing',  - unavailable
//            'completed' => 'completed' - availbe,
        $vehicleStatus = Vehicle::getStatuses();
        $tripStatus = Trip::getStatuses();
        if ($status == $tripStatus['ongoing']) {
            foreach ($trip->vehicles as $vehicle) {
                $this->changeStatus($vehicle, $vehicleStatus['unavailable']);
            }
        }
        if ($status == $tripStatus['completed']) {
            foreach ($trip->vehicles as $vehicle) {
                $this->changeStatus($vehicle, $vehicleStatus['available']);
            }
        }
    }

//-----------------------------------------------------------------------------------------------------------------
//                                          Private Function
//-----------------------------------------------------------------------------------------------------------------
    private function prepareData(array $data): array
    {
        $data['unique_id'] = $this->getUniqueCodeForVehicle($data['vehicle_type_id']);
        return $data;
    }

    private function getUniqueCodeForVehicle($vehicleTypeId)
    {
        $vehicleType = VehicleType::find($vehicleTypeId);
        if (is_null($vehicleType)) {
            throw new Exception('No Vehicle Type Found For ID: ' . $vehicleTypeId);
        }
        $now = Carbon::now();
        $unique_code = $now->format('YmdHisu');
        return $vehicleType->title_english . '-' . $unique_code;
    }
}


