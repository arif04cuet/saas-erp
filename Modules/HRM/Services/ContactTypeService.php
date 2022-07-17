<?php

namespace Modules\HRM\Services;

use Closure;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\App;
use App\Utilities\DropDownDataFormatter;
use Modules\HRM\Repositories\ContactTypeRepository;

class ContactTypeService
{
    use CrudTrait;

    /**
     * @var $contactTypeRepository
     */

    private $contactTypeRepository;

    /**
     * @param ContactTypeRepository $contactTypeRepository
     */

     public function __construct(ContactTypeRepository $contactTypeRepository)
     {
         $this->contactTypeRepository = $contactTypeRepository;
         $this->setActionRepository($this->contactTypeRepository);
     }

     public function getContactTypesForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $types = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll();
        $lang = App::getLocale();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $types,
            $implementedKey,
            $implementedValue ?: function ($type) {
                return $type->name;
            },
            $isEmptyOption
        );
    }
}

