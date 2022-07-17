<?php

namespace Modules\VMS\Services;

use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Modules\VMS\Entities\VehicleType;
use Modules\VMS\Repositories\VehicleTypeRepository;

class VehicleTypeService
{
    use CrudTrait;

    public function __construct(VehicleTypeRepository $vehicleTypeRepository)
    {
        $this->setActionRepository($vehicleTypeRepository);
    }

    public function getVehicleTypesForDropdown(): array
    {
        $valueClosure = function ($v) {
            return $v->getTitle() ?? trans('labels.not_found');
        };
        $vehicles = $this->actionRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown($vehicles, null, $valueClosure, false);
    }

    public function clearSessionValues()
    {
        if (session()->has('_old_input.title_english')) {
            session()->forget('_old_input.title_english');
        }
        if (session()->has('_old_input.title_bangla')) {
            session()->forget('_old_input.title_bangla');
        }
        if (session()->has('_old_input.code')) {
            session()->forget('_old_input.code');
        }
    }

    public function createSessionValues(VehicleType $vehicleType)
    {
        // set general inputs
        session(['_old_input.title_english' => $vehicleType->title_english]);
        session(['_old_input.title_bangla' => $vehicleType->title_bangla]);
        session(['_old_input.code' => $vehicleType->code]);
    }


}

