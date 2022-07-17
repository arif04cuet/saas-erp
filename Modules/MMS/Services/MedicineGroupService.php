<?php


namespace Modules\MMS\Services;

use App\Traits\CrudTrait;
use Modules\MMS\Repositories\MedicineGroupRepository;
use App\Utilities\DropDownDataFormatter;

class MedicineGroupService
{
    use CrudTrait;

    /**
     * @var $medicineGroupRepository
     */

    private $medicineGroupRepository;

    /**
     * @param MedicineGroupRepository $medicineGroupRepository
     */

    public function __construct(MedicineGroupRepository $medicineGroupRepository)
    {
        $this->medicineGroupRepository = $medicineGroupRepository;
        $this->setActionRepository($this->medicineGroupRepository);
    }


    /**
     * <h3>Medicine Group Dropdown</h3>
     * <p>Custom Implementation of concatenation</p>
     *
     * @param Closure $implementedValue Anonymous Implementation of Value
     * @param Closure $implementedKey Anonymous Implementation Key index
     * @param array|null $query
     * @param bool $isEmptyOption
     *
     * @return array
     */
    public function getMedicineGroupForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    )
    {
        $medicine_group = $query ? $this->medicineGroupRepository->findBy($query) : $this->medicineGroupRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $medicine_group,
            $implementedKey,
            $implementedValue ?: function ($medicine_group) {
                return $medicine_group->name;
            },
            $isEmptyOption
        );
    }
}
