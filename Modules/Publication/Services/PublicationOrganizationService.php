<?php

namespace Modules\Publication\Services;

use Closure;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\App;
use App\Utilities\DropDownDataFormatter;
use Modules\Publication\Repositories\PublicationOrganizationRepository;

class PublicationOrganizationService
{
    use CrudTrait;

    private $publicationOrganizationRepository;

    public function __construct(PublicationOrganizationRepository $publicationOrganizationRepository)
    {
        $this->publicationOrganizationRepository = $publicationOrganizationRepository;
        $this->setActionRepository($this->publicationOrganizationRepository);
    }

    public function getOrganizationsForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $organizations = $query ? $this->publicationOrganizationRepository->findBy($query) : $this->publicationOrganizationRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $organizations,
            $implementedKey,
            $implementedValue ?: function ($organizations) {
                return $organizations->name_en . ' - ' . $organizations->name_bn;
            },
            $isEmptyOption
        );
    }
}
