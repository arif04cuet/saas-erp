<?php

namespace Modules\Publication\Services;
use Closure;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\App;
use App\Utilities\DropDownDataFormatter;
use Modules\Publication\Repositories\PublicationTypeRepository;



class PublicationTypeService
{
    use CrudTrait;

    private $publicationTypeRepository;

    public function __construct(PublicationTypeRepository $publicationTypeRepository)
    {
        $this->publicationTypeRepository = $publicationTypeRepository;
        $this->setActionRepository($this->publicationTypeRepository);
    }

    public function getPublicationTypesForDropdown(
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
                $name = $lang == 'bn' ? $material->name_bn : $material->name_en;
                return $name;
            },
            $isEmptyOption
        );
    }
}

