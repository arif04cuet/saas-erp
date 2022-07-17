<?php

namespace Modules\Cafeteria\Services;

use Closure;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\App;
use App\Utilities\DropDownDataFormatter;
use Modules\Cafeteria\Repositories\SpecialGroupRepository;

class SpecialGroupService
{
    use CrudTrait;

    /**
     * @var $specialGroupRepository;
     */

     private $specialGroupRepository;

     /**
      * @param SpecialGroupRepository $specialGroupRepository;
      */

      public function __construct(SpecialGroupRepository $specialGroupRepository)
      {
          $this->specialGroupRepository = $specialGroupRepository;
          $this->setActionRepository($this->specialGroupRepository);
      }

    public function getSpecialGroupsForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $groups = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll();
        $lang = App::getLocale();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $groups,
            $implementedKey,
            $implementedValue ?: function ($group) use ($lang) {
                $name = $lang == 'bn' ? $group->bn_name : $group->en_name;
                return $name;
            },
            $isEmptyOption
        );
    }
}

