<?php

namespace Modules\VMS\Services;

use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\VMS\Entities\Driver;
use Modules\VMS\Repositories\DriverRepository;

class DriverService
{
    use CrudTrait;

    public function __construct(DriverRepository $driverRepository)
    {
        $this->actionRepository = $driverRepository;
    }


    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $this->save($data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Driver Feature Store Error : ' . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    public function updateData(array $data, Driver $driver)
    {
        try {
            DB::beginTransaction();
            $this->update($driver, $data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Driver Feature Update Error : ' . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    public function setSessionValues(Driver $driver)
    {
        session(['_old_input.name_english' => $driver->name_english ?? trans('labels.not_found')]);
        session(['_old_input.name_bangla' => $driver->name_bangla ?? trans('labels.not_found')]);
        session(['_old_input.date_of_birth' => $driver->date_of_birth ?? trans('labels.not_found')]);
        session(['_old_input.address' => $driver->address ?? trans('labels.not_found')]);
        session(['_old_input.license_number' => $driver->license_number ?? trans('labels.not_found')]);
    }

    public function clearSessionValues()
    {
        if (session()->has('_old_input.name_english')) {
            session()->forget('_old_input.name_english');
        }
        if (session()->has('_old_input.name_bangla')) {
            session()->forget('_old_input.name_bangla');
        }
        if (session()->has('_old_input.date_of_birth')) {
            session()->forget('_old_input.date_of_birth');
        }
        if (session()->has('_old_input.address')) {
            session()->forget('_old_input.address');
        }
        if (session()->has('_old_input.license_number')) {
            session()->forget('_old_input.license_number');
        }
    }

    public function getDriversForDropdown()
    {
        $drivers = $this->findAll();
        $valueClosure = function ($d) {
            return $d->getName();
        };
        return DropDownDataFormatter::getFormattedDataForDropdown($drivers, null, $valueClosure);
    }


}

