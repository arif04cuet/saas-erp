<?php

namespace Modules\Cafeteria\Services;

use Closure;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\App;
use App\Utilities\DropDownDataFormatter;
use Modules\Cafeteria\Repositories\RawMaterialCategoryRepository;

class RawMaterialCategoryService
{
    use CrudTrait;

    /**
     * @var $rawMaterialCategoryRepository
     */

    private $rawMaterialCategoryRepository;

    /**
     * @param RawMaterialCategoryRepository $rawMaterialCafeteriaRepository
     */

    public function __construct(RawMaterialCategoryRepository $rawMaterialCatergoryRepository)
    {
        $this->rawMaterialCategoryRepository = $rawMaterialCatergoryRepository;
        $this->setActionRepository($this->rawMaterialCategoryRepository);
    }

    public function getRawMaterialCategoryForDropDown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $category = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll();
        $lang = App::getLocale();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $category,
            $implementedKey,
            $implementedValue ? : function($category) use ($lang) {
                $name = $lang == 'bn' ? $category->bn_name : $category->en_name;
                return $name;
            },
            $isEmptyOption
        );
    }
}

