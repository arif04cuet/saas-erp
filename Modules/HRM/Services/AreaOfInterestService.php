<?php

namespace Modules\HRM\Services;

use Closure;
use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Modules\HRM\Repositories\AreaOfInterestRepository;

class AreaOfInterestService
{
    use CrudTrait;

    /**
     * @var $areaOfInterestRepository
     */

    private $areaOfInterestRepository;

    /**
     * @param AreaOfInterestRepository $areaOfInterestRepository
     */

    public function __construct(AreaOfInterestRepository $areaOfInterestRepository)
    {
        $this->areaOfInterestRepository = $areaOfInterestRepository;
        $this->setActionRepository($this->areaOfInterestRepository);
    }

    public function getInterestsForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $interest = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $interest,
            $implementedKey,
            $implementedValue ?: function ($interest) {
                return $interest->name;
            },
            $isEmptyOption
        );
    }
}

