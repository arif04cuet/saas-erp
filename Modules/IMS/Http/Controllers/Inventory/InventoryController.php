<?php

namespace Modules\IMS\Http\Controllers\Inventory;

use App\Constants\DepartmentShortName;
use App\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Modules\IMS\Entities\InventoryItemCategory;
use Modules\IMS\Entities\InventoryLocation;
use Modules\IMS\Repositories\InventoryItemRepository;
use Modules\IMS\Services\InventoryCategoryGroupService;
use Modules\IMS\Services\InventoryLocationService;
use Modules\IMS\Services\InventoryRequestService;
use Modules\IMS\Services\InventoryService;

class InventoryController extends Controller
{
    private $inventoryService;
    private $locationService;
    private $inventoryRequestService;
    private $inventoryGroupService;
    /**
     * @var InventoryItemRepository
     */
    private $inventoryItemRepository;

    /**
     * Display a listing of the resource.
     * @param InventoryService $inventoryService
     * @param InventoryLocationService $locationService
     * @param InventoryRequestService $inventoryRequestService
     * @param InventoryCategoryGroupService $inventoryCategoryGroupService
     * @param InventoryItemRepository $inventoryItemRepository
     */
    public function __construct(
        InventoryService $inventoryService,
        InventoryLocationService $locationService,
        InventoryRequestService $inventoryRequestService,
        InventoryCategoryGroupService $inventoryCategoryGroupService,
        InventoryItemRepository $inventoryItemRepository
    ) {
        $this->inventoryService = $inventoryService;
        $this->locationService = $locationService;
        $this->inventoryRequestService = $inventoryRequestService;
        $this->inventoryGroupService = $inventoryCategoryGroupService;
        $this->inventoryItemRepository = $inventoryItemRepository;
    }

    public function index()
    {
        $currentDepartment = get_user_department();

        if ($currentDepartment->department_code == DepartmentShortName::InventoryDivision) {
            $locations = $this->locationService->findAll();
        } else {
            if ($currentDepartment->id) {
                $locations = $this->locationService->findBy(['department_id' => $currentDepartment->id]);
            } else {
                $locations = collect();
            }
        }
        /*
        |--------------------------------------------------------------------------
        |                Show Only User Department's Categories
        |--------------------------------------------------------------------------
        */
        $inventoryCategoryList = [];

        foreach ($locations as $location) {
            foreach ($location->inventories as $inventory) {
                array_push($inventoryCategoryList, $inventory->inventoryItemCategory->id);
            }
        }
        $inventoryCategoryList = array_unique($inventoryCategoryList);

        $categories = InventoryItemCategory::whereIn('id', $inventoryCategoryList)->get();
        $inventoryDetailList = [];

        foreach ($categories as $category) {
            $inventoryDetail['category_name'] = $category->name . ' (' . $category->unit . ')';
            $inventoryDetail['category_id'] = $category->id;
            $inventoryDetail['type'] = $category->type;
            $inventoryDetail['total'] = 0;
            $inventoryDetail['locations'] = [];

            if (count($locations)) {
                foreach ($locations as $location) {
                    $inventoryDetail['locations'][$location->id] = 0;

                    foreach ($category->inventories as $inventory) {
                        if ($inventory->location_id == $location->id) {
                            $inventoryDetail['locations'][$location->id] = $inventory->quantity;
                        }
                    }

                    $inventoryDetail['total'] += $inventoryDetail['locations'][$location->id];
                }
            }
            if ($category->group_id) {
                $inventoryDetailList[$category->group_id][] = $inventoryDetail;
            } else {
                $inventoryDetailList['common_group'][] = $inventoryDetail;
            }
        }

        $language = 'name_' . Config::get('app.locale');
        $groups = $this->inventoryGroupService->findAll()->pluck($language, 'id');
        return view('ims::inventory.index', compact(
                'inventoryDetailList',
                'locations',
                'groups'
            )
        );
    }

    /**
     * @param InventoryItemCategory $inventoryItemCategory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(InventoryItemCategory $inventoryItemCategory)
    {
        $inventories = $this->inventoryService->getItemInventoriesByDept($inventoryItemCategory);
        $histories = $this->inventoryService->getInventoryHistoriesByItemCategory($inventoryItemCategory);
        $inventoryItems = $this->inventoryItemRepository->getItemsByCategoriesAndLocation([$inventoryItemCategory->id]);

        return view('ims::inventory.show',
            compact('inventoryItemCategory', 'inventories', 'histories', 'inventoryItems')
        );
    }

    public function reportByUsers()
    {
        $requestDetails = $this->inventoryService->requestDetails();
        $users = User::all();

        return view('ims::inventory.report.index', compact('requestDetails', 'users'));
    }

    public function reportByCategoryItems()
    {
        $requestDetails = $this->inventoryService->requestDetails();
        $categoryItems = InventoryItemCategory::all();

        return view('ims::inventory.report.category-items', compact('requestDetails', 'categoryItems'));
    }
}
