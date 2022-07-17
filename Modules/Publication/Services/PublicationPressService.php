<?php

namespace Modules\Publication\Services;

use Closure;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\App;
use App\Utilities\DropDownDataFormatter;
use Modules\Publication\Repositories\PublicationPressRepository;

class PublicationPressService
{
    use CrudTrait;

    private $publicationPressRepository;

    public function __construct(PublicationPressRepository $publicationPressRepository)
    {
        $this->publicationPressRepository = $publicationPressRepository;
        $this->setActionRepository($this->publicationPressRepository);
    }

    public function getPublicationPressForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ): array
    {
        $materials = $query ? $this->actionRepository->findBy($query) : $this->actionRepository->findAll();
        $lang = App::getLocale();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $materials,
            $implementedKey,
            $implementedValue ?: function ($material) use ($lang) {
                $name = $lang == 'bn' ? $material->press_name_en : $material->press_name_bn;
                return $name;
            },
            $isEmptyOption
        );
    }
}
