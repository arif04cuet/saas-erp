<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 5/16/19
 * Time: 4:30 PM
 */
namespace Modules\IMS\Services;

use App\Constants\DepartmentShortName;
use App\Constants\DesignationShortName;
use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Closure;
use Illuminate\Support\Facades\DB;
use Modules\IMS\Constants\InventoryFixedLocation;
use Modules\IMS\Entities\InventoryLocation;
use Modules\IMS\Repositories\InventoryLocationRepository;

class InventoryLocationService
{
    use CrudTrait;
    /**
     * @var InventoryLocationRepository
     */
    private $locationRepository;

    public function __construct(InventoryLocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
        $this->setActionRepository($locationRepository);
    }

    public function store(array $data)
    {
        $location = $this->locationRepository->save($data);
        return $location;
    }

    public function getAllLocationsExceptDefaults()
    {
        return $this->locationRepository->findBy(['is_default' => false], null, ['column'=>'created_at','direction'=>'desc']);
    }

    public function updateLocation(InventoryLocation $location, array $data)
    {
        return DB::transaction(function () use ($location, $data){
            return $location->update($data);
        });
    }

    /**
     * <h3>Locations Dropdown</h3>
     * <p>Custom Implementation of concatenation</p>
     *
     * @param Closure $implementedValue Anonymous Implementation of Value
     * @param Closure $implementedKey Anonymous Implementation Key index
     * @param array|null $query
     * @param bool $isEmptyOption
     * @return array
     */
    public function getLocationsForDropdown(Closure $implementedValue = null, Closure $implementedKey = null, array $query = null, $isEmptyOption = false)
    {
        $locations = $query ? $this->findBy($query) : $this->findAll();

        return DropDownDataFormatter::getFormattedDataForDropdown(
            $locations,
            $implementedKey,
            $implementedValue ? : function($location) {
                $departmentName = optional($location->department)->name ?? 'N/A';
                return $location->name . ' - ' . $departmentName;
            },
            $isEmptyOption
        );
    }

    private function filterBySpecificStoreLocation($name){
        return $this->getLocationsForDropdown(
            function($location) {
                return $location->name;
            },
            null,
            [
                'is_default' => true,
                'name' => $name
            ]
        );
    }

    public function getMainStoreLocation(){
        return $this->filterBySpecificStoreLocation(InventoryFixedLocation::MAIN_STORE_NAME);
    }

    public function getScrapLocation(){
        return $this->filterBySpecificStoreLocation(InventoryFixedLocation::SCRAP_LOCATION_NAME);
    }

    public function getAbandonLocation(){
        return $this->filterBySpecificStoreLocation(InventoryFixedLocation::ABANDON_LOCATION_NAME);
    }

    /**
     * Filter Inventory Location by Department
     *
     * 1. DG and IMS->users(ID) will view all
     * 2. Other User will view only their part
     *
     * @param $departmentCode
     * @return Filtered values
     */
    public function filterLocationByDepartment($departmentCode)
    {
        $locations = $this->getAllLocationsExceptDefaults();

        if(get_user_designation()->short_name == DesignationShortName::DG)
        {
            return $locations;
        }

        if ($departmentCode == DepartmentShortName::InventoryDivision) {
            return $locations;
        } else {
            $filtered = $locations->filter(function ($item) use ($departmentCode) {
                $reqDeptCode = $item->department->department_code;
                if ($reqDeptCode == $departmentCode) {
                    return true;
                }
            });
            return $filtered;
        }
    }
}
