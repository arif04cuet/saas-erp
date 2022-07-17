<?php

namespace Modules\HRM\Services;

use Closure;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\App;
use App\Utilities\DropDownDataFormatter;
use Modules\HRM\Repositories\HouseCategoryRepository;

class HouseCategoryService
{
    use CrudTrait;

    /**
     * @var $houseCategoryRepository
     */

    private $houseCategoryRepository;


    /**
     * @param HouseCategoryRepository $houseCategoryRepository
    */

    public function __construct(HouseCategoryRepository $houseCategoryRepository)
    {
        $this->houseCategoryRepository = $houseCategoryRepository;
        $this->setActionRepository($this->houseCategoryRepository);
    }

    public function getHouseCategoryForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $category = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $category,
            $implementedKey,
            $implementedValue ?: function ($category) {
                return $category->name;
            },
            $isEmptyOption
        );
    }
}

