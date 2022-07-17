<?php
/**
 * Created by PhpStorm.
 * User: bs130
 * Date: 5/20/19
 * Time: 9:54 AM
 */

namespace Modules\IMS\Services;


use App\Constants\DepartmentShortName;
use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\IMS\Constants\InventoryFixedLocation;
use Modules\IMS\Entities\AuctionDetail;
use Modules\IMS\Entities\InventoryHistory;
use Modules\IMS\Entities\InventoryItemCategory;
use Modules\IMS\Repositories\InventoryHistoryRepository;
use Modules\IMS\Repositories\InventoryRepository;
use Modules\IMS\Repositories\InventoryRequestDetailRepository;
use Modules\IMS\Repositories\InventoryRequestRepository;

class InventoryService
{
    use CrudTrait;

    protected const IN = 'IN';
    protected const OUT = 'OUT';

    private $inventoryRepository;
    private $inventoryHistoryRepository;
    private $inventoryRequestRepository;
    private $inventoryRequestDetailRepository;

    public function __construct(
        InventoryRepository $inventoryRepository,
        InventoryHistoryRepository $inventoryHistoryRepository,
        InventoryRequestRepository $inventoryRequestRepository,
        InventoryRequestDetailRepository $inventoryRequestDetailRepository
    ) {
        $this->inventoryRepository = $inventoryRepository;
        $this->inventoryHistoryRepository = $inventoryHistoryRepository;
        $this->inventoryRequestRepository = $inventoryRequestRepository;
        $this->inventoryRequestDetailRepository = $inventoryRequestDetailRepository;
        $this->setActionRepository($inventoryRepository);
    }

    /**
     * Get Scrap Product which are not in any Auction
     */
    public function getAvailableScrapProducts(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $inventories = $query ? $this->findBy($query) : $this->findAll();

//        $pendingScrapProducts = AuctionDetail::select(DB::Raw('SUM(quantity) as quantity,category_id'))
//            ->groupBy('category_id')->get();
//        foreach ($inventories as $inventory)
//        {
//            foreach ($pendingScrapProducts as $pendingScrapProduct)
//            {
//                if($pendingScrapProduct->category_id == $inventory->inventory_item_category_id )
//                {
//                    $inventory->quantity=$inventory->quantity-$pendingScrapProduct->quantity;
//                }
//            }
//
//        }


        return DropDownDataFormatter::getFormattedDataForDropdown(
            $inventories,
            $implementedKey,
            $implementedValue ?: function ($inventory) {
                return $inventory->inventoryItemCategory->name . ' (' . $inventory->quantity . ')';
            },
            $isEmptyOption
        );

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
    public function getInventoryForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $inventories = $query ? $this->findBy($query) : $this->findAll();

        return DropDownDataFormatter::getFormattedDataForDropdown(
            $inventories,
            $implementedKey,
            $implementedValue ?: function ($inventory) {
                return $inventory->inventoryItemCategory->name . ' (' . $inventory->inventoryItemCategory->unit . ')';
            },
            $isEmptyOption
        );
    }

    /**
     * @param $location
     * @return array
     */
    public function getFixedStoreInventories($location)
    {
        return $this->getInventoryForDropdown(
            null,
            function ($inventory) {
                return $inventory->inventoryItemCategory->id;
            },
            ['location_id' => $location]
        );
    }

    public function getMainStoreInventories()
    {
        return $this->getFixedStoreInventories(InventoryFixedLocation::MAIN_STORE);
    }

    public function incrementInventory(
        int $locationId,
        int $inventoryCategoryId,
        float $quantity,
        $refInventoryId = null,
        bool $isTransfer
    ) {
        $inventory = $this->getInventory($locationId, $inventoryCategoryId);

        $inventory->increment('quantity', $quantity);

        $this->saveInventoryHistory($inventory, $quantity, $refInventoryId, $isTransfer, self::IN);
    }

    public function decrementInventory(
        int $locationId,
        int $inventoryCategoryId,
        float $quantity,
        $refInventoryId = null,
        bool $isTransfer
    ) {
        $inventory = $this->getInventory($locationId, $inventoryCategoryId);

        $inventory->decrement('quantity', $quantity);

        $this->saveInventoryHistory($inventory, $quantity, $refInventoryId, $isTransfer, self::OUT);
    }

    /**
     * @param int $locationId
     * @param int $inventoryCategoryId
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    private function getInventory(int $locationId, int $inventoryCategoryId)
    {
        $inventory = $this->findBy([
            'location_id' => $locationId,
            'inventory_item_category_id' => $inventoryCategoryId
        ])->first();

        if (empty($inventory)) {
            $inventory = $this->save([
                'location_id' => $locationId,
                'inventory_item_category_id' => $inventoryCategoryId,
                'quantity' => 0
            ]);
        }

        return $inventory;
    }

    /**
     * @param $inventory
     * @param float $quantity
     * @param int $refInventoryId
     * @param bool $isTransfer
     * @param string $type
     */
    private function saveInventoryHistory(
        $inventory,
        float $quantity,
        $refInventoryId = null,
        bool $isTransfer,
        string $type
    ): void {
        $inventory->histories()->create([
            'ref_inventory_id' => $refInventoryId,
            'type' => $type,
            'quantity' => $quantity,
            'is_transfer' => $isTransfer,
        ]);
    }

    public function get()
    {
        return $this->findAll();
    }

    public function requests()
    {
        return $this->inventoryRequestRepository->findAll();
    }

    public function requestDetails()
    {
        return $this->inventoryRequestDetailRepository->findBy([], null,
            ['column' => 'created_at', 'direction' => 'desc']);
    }

    public function getItemInventoriesByDept(InventoryItemCategory $inventoryItemCategory)
    {
        $isAdministrationDepartment = $this->isAdministrationDepartment();

        $departmentLocations = $this->getDepartmentLocations();

        $inventories = $this->findBy(
            ['inventory_item_category_id' => $inventoryItemCategory->id],
            ['inventoryItemCategory', 'inventoryLocation']
        )->filter(function ($inventory) use (
            $inventoryItemCategory,
            $departmentLocations,
            $isAdministrationDepartment
        ) {
            return $isAdministrationDepartment
                ? ($inventory->inventoryItemCategory->id == $inventoryItemCategory->id)
                : (($inventory->inventoryItemCategory->id == $inventoryItemCategory->id)
                    && (in_array($inventory->inventoryLocation->id, $departmentLocations))
                );
        });

        return $inventories;
    }

    public function getInventoryHistoriesByItemCategory(InventoryItemCategory $inventoryItemCategory)
    {
        $isAdministrationDepartment = $this->isAdministrationDepartment();

        $departmentLocations = $this->getDepartmentLocations();

        return $this->inventoryHistoryRepository->findBy([], null, ['column' => 'created_at', 'direction' => 'desc'])
            ->filter(function ($inventoryHistory) use (
                $inventoryItemCategory,
                $departmentLocations,
                $isAdministrationDepartment
            ) {

                return $isAdministrationDepartment
                    ? ($inventoryHistory->inventory->inventoryItemCategory->id == $inventoryItemCategory->id)
                    : (($inventoryHistory->inventory->inventoryItemCategory->id == $inventoryItemCategory->id)
                        && (in_array($inventoryHistory->inventory->inventoryLocation->id, $departmentLocations))
                    );

            });
    }

    public function getInventoryItemsByLocation()
    {
        return $this->findAll()->groupBy('location_id');
    }

    /**
     * @return array
     */
    private function getDepartmentLocations(): array
    {
        $department = get_user_department();

        $departmentLocations = is_null($department->id) ? [] : (is_object($dLs = Arr::get($department,
            'inventoryLocations', [])) ? $dLs->map(function ($dL) {
            return $dL->id;
        })->toArray() : []);

        return $departmentLocations;
    }

    /**
     * @return bool
     */
    private function isAdministrationDepartment()
    {
        $isAdministration = (get_user_department()->department_code == DepartmentShortName::InventoryDivision);

        return $isAdministration;
    }


}
