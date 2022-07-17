<?php

namespace Modules\Cafeteria\Services;

use Closure;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\App;
use App\Utilities\DropDownDataFormatter;
use Modules\Cafeteria\Repositories\VenueRepository;

class VenueService
{
    use CrudTrait;

    private $venueRepository;

    public function __construct(VenueRepository $venueRepository)
    {
        $this->venueRepository = $venueRepository;
        $this->setActionRepository($this->venueRepository);
    }

    public function getVenuesForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $venues = $query ? $this->venueRepository->findBy($query) : $this->venueRepository->findAll();
        $lang = App::getLocale();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $venues,
            $implementedKey,
            $implementedValue ?: function ($venue) use ($lang) {
                $name = $lang == 'bn' ? $venue->name_bn : $venue->name_en;
                return $name;
            },
            $isEmptyOption
        );
    }

}

