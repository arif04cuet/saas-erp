<?php

namespace Modules\Cafeteria\Services;

use Closure;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\App;
use App\Utilities\DropDownDataFormatter;
use Modules\Cafeteria\Repositories\UnitRepository;

class UnitService
{
    use CrudTrait;

    private $unitRepository;

    public function __construct(UnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
        $this->setActionRepository($this->unitRepository);
    }

    public function getUnitsForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $units = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll();
        $lang = App::getLocale();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $units,
            $implementedKey,
            $implementedValue ? : function($unit) use ($lang) {
                $name = $lang == 'bn' ? $unit->bn_name : $unit->en_name;
                return $name;
            },
            $isEmptyOption
        );
    }

}

