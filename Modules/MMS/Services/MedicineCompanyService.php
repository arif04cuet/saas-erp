<?php

namespace Modules\MMS\Services;

use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Modules\MMS\Repositories\MedicineCompanyRepository;

class MedicineCompanyService
{
    use CrudTrait;

    /**
     * @var $medicineCompanyRepository
     */

    private $medicineCompanyRepository;

    /**
     * @param MedicineCompanyRepository $medicineCompanyRepository
     */

    public function __construct(MedicineCompanyRepository $medicineCompanyRepository)
    {
        $this->medicineCompanyRepository = $medicineCompanyRepository;
        $this->setActionRepository($this->medicineCompanyRepository);
    }


    /**
     * <h3>Medicine Group Dropdown</h3>
     * <p>Custom Implementation of concatenation</p>
     *
     * @param Closure $implementedValue Anonymous Implementation of Value
     * @param Closure $implementedKey Anonymous Implementation Key index
     * @param array|null $query
     * @param bool $isEmptyOption
     * @return array
     */
    public function getCompanyForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    )
    {
        $company = $query ? $this->medicineCompanyRepository->findBy($query) : $this->medicineCompanyRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $company,
            $implementedKey,
            $implementedValue ?: function ($company) {
                return $company->name;
            },
            $isEmptyOption
        );
    }
}

