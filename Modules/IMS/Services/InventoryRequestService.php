<?php


namespace Modules\IMS\Services;


use App\Constants\DepartmentShortName;
use App\Constants\DesignationShortName;
use App\Entities\User;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Services\EmployeeService;
use Modules\IMS\Constants\InventoryFixedLocation;
use Modules\IMS\Constants\InventoryRequestType;
use Modules\IMS\Entities\Inventory;
use Modules\IMS\Entities\InventoryLocation;
use Modules\IMS\Entities\InventoryRequest;
use Modules\IMS\Entities\InventoryRequestDetail;
use Modules\IMS\Repositories\InventoryItemRepository;
use Modules\IMS\Repositories\InventoryRequestItemRepository;
use Modules\IMS\Repositories\InventoryRequestRepository;
use App\Events\MedicalRequisitionReceived;
use Modules\HRM\Repositories\SectionRepository;

class InventoryRequestService
{
    use CrudTrait;
    public const MEDICAL_REQUEST_SECTION='MC';
    private $inventoryRequestRepository;
    private $employeeService;
    private $inventoryService;
    private $locationService;
    private $inventoryItemCategoryService;
    private $sectionRepository;
    /**
     * @var InventoryItemRepository
     */
    private $inventoryItemRepository;
    /**
     * @var InventoryRequestItemRepository
     */
    private $inventoryRequestItemRepository;

    public function __construct(
        InventoryRequestRepository $inventoryRequestRepository,
        EmployeeService $employeeService,
        InventoryService $inventoryService,
        InventoryItemCategoryService $inventoryItemCategoryService,
        InventoryLocationService $locationService,
        InventoryItemRepository $inventoryItemRepository,
        InventoryRequestItemRepository $inventoryRequestItemRepository,
        SectionRepository $sectionRepository
    ) {
        $this->inventoryRequestRepository = $inventoryRequestRepository;
        $this->employeeService = $employeeService;
        $this->sectionRepository = $sectionRepository;
        $this->locationService = $locationService;
        $this->inventoryService = $inventoryService;
        $this->inventoryItemCategoryService = $inventoryItemCategoryService;
        $this->setActionRepository($inventoryRequestRepository);
        $this->inventoryRequestItemRepository = $inventoryRequestItemRepository;
        $this->inventoryItemRepository = $inventoryItemRepository;
    }

    public function storeInitial(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['requester_id'] = Auth::user()->id;

            return $this->save($data);
        });
    }

    public function storeAndUpdateDetail(array $data, string $type, InventoryRequest $inventoryRequest)
    {
        return DB::transaction(function () use ($data, $type, $inventoryRequest) {
            $inventoryRequest->details()->delete();

            $inventoryItems = [];
            if (isset($data['category'])) {
                foreach ($data['category'] as $category) {
                    $inventoryRequestDetail = new InventoryRequestDetail([
                        'category_id' => $category['category_id'],
                        'quantity' => $category['quantity'],
                    ]);

                    if (!empty($category['items'])) {
                        $inventoryItems = array_merge($inventoryItems, $category['items']);
                    }

                    $inventoryRequest->details()->save($inventoryRequestDetail);
                }
            }

            if ($type == InventoryRequestType::REQUISITION) {
                if (isset($data['new-category'])) {
                    foreach ($data['new-category'] as $newCategory) {
                        // Create New Inventory Item Category
                        $newCategory['unique_id'] = $this->inventoryItemCategoryService->generateUniqueId();
                        $inventoryItemCategory = $this->inventoryItemCategoryService->save($newCategory);

                        // Insert Into Inventory Request Details
                        if ($inventoryItemCategory) {
                            $inventoryRequestDetail = new InventoryRequestDetail([
                                'category_id' => $inventoryItemCategory->id,
                                'quantity' => $newCategory['quantity'],
                            ]);

                            $inventoryRequest->details()->save($inventoryRequestDetail);
                        }
                    }
                }

                if (isset($data['bought-category'])) {
                    foreach ($data['bought-category'] as $boughtCategory) {
                        $inventoryRequestDetail = new InventoryRequestDetail([
                            'category_id' => $boughtCategory['category_id'],
                            'quantity' => $boughtCategory['quantity'],
                        ]);

                        $inventoryRequest->details()->save($inventoryRequestDetail);
                    }
                }
            }

            if ($inventoryRequest->status == 'new') {
                if ($inventoryRequest->type === InventoryRequestType::TRANSFER) {
                    $inventoryRequest->status = 'approved';
                    $inventoryRequest->save();
                    $this->saveInventoryItems($inventoryItems, $inventoryRequest->id);
                    $this->receive([
                        'inventory_request_id' => $inventoryRequest->id,
                        'remark' => 'Transfer Received',
                        'message' => null,
                        'recipients' => [],
                    ]);
                } else {
                    $inventoryRequest->applyTransition('pending');
                }
            }

            return $inventoryRequest;
        });
    }

    public function updateInitial(array $data, $inventoryRequest)
    {
        return DB::transaction(function () use ($data, $inventoryRequest) {
            return $this->update($inventoryRequest, $data);
        });
    }

    /**
     * @param $requestId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getInventoryRequestItems($requestId)
    {
        return $this->inventoryRequestItemRepository->findBy(['inventory_request_id' => $requestId], ['item']);
    }

    public function prepareInitialForm($type)
    {
        switch ($type) {
            case InventoryRequestType::REQUISITION:
                return $this->getInitialFormDataForRequisition();
                break;
            case InventoryRequestType::TRANSFER:
                return $this->getInitialFormDataForTransfer();
                break;
            case InventoryRequestType::SCRAP:
                return $this->getInitialFormDataForScrap();
                break;
            case InventoryRequestType::ABANDON:
                return $this->getInitialFormDataForAbandon();
                break;
            default:
                return [];
        }
    }

    private function isCurrentDepartmentNotEqualsToInventoryDepartment(): bool
    {
        return !(get_user_department()->department_code == DepartmentShortName::InventoryDivision && (auth()->user()->hasAnyRole('ROLE_INVENTORY_USER')));
    }

    private function getInitialFormDataForRequisition()
    {
        $departmentId = get_user_department()->id;
        $employees['options'] = $this->employeeService->getEmployeesForDropdown(
            null, null,
            [
                'department_id' => $departmentId,
                'is_divisional_director' => false
            ]
        );
        $employees['required'] = 1;

        $fromLocations = $this->locationService->getMainStoreLocation();
        $toLocations = $this->locationService->getLocationsForDropdown(
            null, null,
            [
                'department_id' => $departmentId,
                'is_default' => false
            ]
        );

        $flags['is_location_visible'] = $this->isCurrentDepartmentNotEqualsToInventoryDepartment();
        $flags['to_location_id'] = InventoryFixedLocation::MAIN_STORE;

        return [
            $employees,
            $fromLocations,
            $toLocations,
            $flags
        ];
    }

    private function getInitialFormDataForTransfer()
    {
        $departmentId = get_user_department()->id;
        $employees['options'] = array();
        $employees['required'] = 0;
        $fromLocations = $this->locationService->getLocationsForDropdown(
            null, null,
            [
                'department_id' => $departmentId,
                'is_default' => false
            ]
        );
        if (Auth::user()->hasRole('ROLE_INVENTORY_USER')) {
            $fromLocations = $this->locationService->getScrapLocation() + $fromLocations;
        }
        $toLocations = $this->locationService->getLocationsForDropdown(
            null, null,
            [
                'is_default' => false
            ]
        );

        $flags['is_location_visible'] = true;

        return [
            $employees,
            $fromLocations,
            $toLocations,
            $flags
        ];
    }

    private function getInitialFormDataForScrap()
    {
        $departmentId = get_user_department()->id;
        $employees['options'] = array();
        $employees['required'] = 0;
        $fromLocations = $this->locationService->getLocationsForDropdown(
            null, null,
            [
                'department_id' => $departmentId,
                'is_default' => false
            ]
        );
        $toLocations = $this->locationService->getScrapLocation();

        $flags['is_location_visible'] = true;

        return [
            $employees,
            $fromLocations,
            $toLocations,
            $flags
        ];
    }

    private function getInitialFormDataForAbandon()
    {
        $departmentId = get_user_department()->id;
        $employees['options'] = array();
        $employees['required'] = 0;
        $fromLocations = $this->locationService->getLocationsForDropdown(
            null, null,
            [
                'department_id' => $departmentId,
                'is_default' => false
            ]
        );
        $toLocations = $this->locationService->getAbandonLocation();

        $flags['is_location_visible'] = true;

        return [
            $employees,
            $fromLocations,
            $toLocations,
            $flags
        ];
    }

    public function prepareDetailForm($type, $data)
    {
        switch ($type) {
            case InventoryRequestType::REQUISITION:
                return $this->getDetailFormDataForRequisition($data);
                break;
            case InventoryRequestType::TRANSFER:
                return $this->getDetailFormDataForTransfer($data);
                break;
            case InventoryRequestType::SCRAP:
                return $this->getDetailFormDataForScrap($data);
                break;
            case InventoryRequestType::ABANDON:
                return $this->getDetailFormDataForAbandon($data);
                break;
            default:
                return [];
        }
    }

    private function getDetailFormDataForRequisition($data)
    {
        $categories['items'] = $this->inventoryService->getMainStoreInventories();
        $categories['bought'] = $this->inventoryItemCategoryService->getItemCategoryForDropdown(
            function ($inventoryItemCategory) {
                return $inventoryItemCategory->name . ' - [ ' . $inventoryItemCategory->unique_id . ' ]';
            }
            ,
            function ($inventoryItemCategory) {
                return $inventoryItemCategory->id;
            },
            [
                'is_active' => false
            ]
        );

        return [
            ['category', 'new-category', 'bought-category'],
            $categories,
            $data
        ];
    }

    private function getDetailFormDataForTransfer($data)
    {
        $categories['items'] = $this->inventoryService->getInventoryForDropdown(
            null, function ($inventory) {
            return $inventory->inventory_item_category_id;
        },
            [
                'location_id' => $data->from_location_id
            ],
            true
        );
        $categories['inventory_items'] = $this->inventoryItemRepository->getItemsByCategoriesAndLocation(
            array_keys($categories['items']),
            $data->from_location_id
        )->each(function ($item) {
            return $item->title_id = $item->title . ' - ' . $item->unique_id;
        })->groupBy('inventory_item_category_id');

        return [
            ['transfer-category'],
            $categories,
            $data
        ];
    }

    private function getDetailFormDataForScrap($data)
    {
        $categories['items'] = $this->inventoryService->getInventoryForDropdown(
            null, function ($inventory) {
            return $inventory->inventory_item_category_id;
        },
            [
                'location_id' => $data->from_location_id
            ]
        );

        return [
            ['category'],
            $categories,
            $data
        ];
    }

    private function getDetailFormDataForAbandon($data)
    {
        $categories['items'] = $this->inventoryService->getInventoryForDropdown(
            null, function ($inventory) {
            return $inventory->inventory_item_category_id;
        },
            [
                'location_id' => $data->from_location_id
            ]
        );

        return [
            ['category'],
            $categories,
            $data
        ];
    }

    public function traverseWorkflow($data = [])
    {
        return DB::transaction(function () use ($data) {
            if (method_exists($this, $data['transition']) && is_callable(InventoryRequestService::class,
                    $data['transition'])) {
                if ($data['transition'] == 'approve') {
                    $this->saveInventoryItems($data['inventory_item_ids'] ?? [], $data['inventory_request_id']);
                }
                return call_user_func_array(array($this, $data['transition']), ['data' => $data]);
            }
        });
    }

    public function saveInventoryItems($itemIds, int $inventoryRequestId)
    {
        foreach ($itemIds as $itemId) {
            $requestItemData = [
                'inventory_request_id' => $inventoryRequestId,
                'inventory_item_id' => $itemId,
            ];
            $this->inventoryRequestItemRepository->save($requestItemData);
        }
    }

    private function approve($data = [])
    {
        $inventory_request = $this->findOrFail($data['inventory_request_id']);

        return $inventory_request->applyTransition('approve', $this->recipientsForTransition($data),
            $this->detailsForTransition($data));
    }

    private function share($data = [])
    {
        $inventory_request = $this->findOrFail($data['inventory_request_id']);

        return $inventory_request->applyTransition('share', $this->recipientsForTransition($data),
            $this->detailsForTransition($data));
    }

    private function reject($data = [])
    {
        $inventory_request = $this->findOrFail($data['inventory_request_id']);

        return $inventory_request->applyTransition('reject', $this->recipientsForTransition($data),
            $this->detailsForTransition($data));
    }

    public function addInactiveItemsToMainStore(
        InventoryRequestDetail $inventoryRequestDetail,
        InventoryLocation $mainStoreLocation
    ) {
        if ($inventoryRequestDetail->category->is_active == false) {
            $inventoryRequestDetail->category->is_active = true;
            $inventoryRequestDetail->category->save();

            $this->inventoryService->incrementInventory(
                $mainStoreLocation->id,
                $inventoryRequestDetail->category_id,
                $inventoryRequestDetail->quantity,
                null,
                false
            );
        }
    }

    /**
     * Updates inventory items location while receive
     * @param InventoryRequest $inventoryRequest
     */
    public function updateInventoryRequestItemLocation(InventoryRequest $inventoryRequest)
    {
        $inventoryRequestItems = $inventoryRequest->approvedItems;
        foreach ($inventoryRequestItems as $requestItem) {
            $this->inventoryItemRepository->findOne($requestItem->inventory_item_id)
                ->update([
                    'inventory_location_id' => $inventoryRequest->to_location_id,
                    'status' => 'active'
                ]);
        }
    }

    private function receive($data = [])
    {

        $inventoryRequest = $this->findOrFail($data['inventory_request_id']);


        $inventoryDetails=$inventoryRequest->details;
        $locationId=$inventoryRequest->toLocation->section_id;

        $isReceived = $inventoryRequest->applyTransition('receive', $this->recipientsForTransition($data),
            $this->detailsForTransition($data));

        if ($isReceived) {

            // Updating Inventory Items Location to Request's To Location
            $this->updateInventoryRequestItemLocation($inventoryRequest);
            $inventoryRequest->details
                ->each(function ($inventoryRequestDetail, $index) use ($inventoryRequest) {
                    if ($inventoryRequest->type == InventoryRequestType::REQUISITION) {
                        // handle requisition for main store
                        if ($inventoryRequest->to_location_id == InventoryFixedLocation::MAIN_STORE) {
                            $mainStoreLocation = $this->locationService
                                ->findBy(['name' => InventoryFixedLocation::MAIN_STORE_NAME])
                                ->first();


                            if ($inventoryRequestDetail->category->is_active == false) {
                                $inventoryRequestDetail->category->is_active = true;
                                $inventoryRequestDetail->category->save();
                            }

                            $this->inventoryService->incrementInventory(
                                $mainStoreLocation->id,
                                $inventoryRequestDetail->category_id,
                                $inventoryRequestDetail->quantity,
                                null,
                                false
                            );
                        } else {
                            $mainStoreLocation = $this->locationService
                                ->findBy(['name' => InventoryFixedLocation::MAIN_STORE_NAME])
                                ->first();

                            $this->addInactiveItemsToMainStore($inventoryRequestDetail, $mainStoreLocation);

                            $toInventory = Inventory::firstOrCreate([
                                'location_id' => $inventoryRequest->to_location_id,
                                'inventory_item_category_id' => $inventoryRequestDetail->category_id
                            ], ['quantity' => 0]);

                            $this->inventoryService->decrementInventory(
                                $mainStoreLocation->id,
                                $inventoryRequestDetail->category_id,
                                $inventoryRequestDetail->quantity,
                                $toInventory->id,
                                false
                            );

                            $fromInventory = $this->inventoryService->findBy([
                                'location_id' => $mainStoreLocation->id,
                                'inventory_item_category_id' => $inventoryRequestDetail->category_id
                            ])->first();

                            $this->inventoryService->incrementInventory(
                                $inventoryRequest->to_location_id,
                                $inventoryRequestDetail->category_id,
                                $inventoryRequestDetail->quantity,
                                $fromInventory->id,
                                false
                            );
                        }
                    } else {
                        // inventory request for transfer, scrap and abandon
                        $toInventory = Inventory::firstOrCreate([
                            'location_id' => $inventoryRequest->to_location_id,
                            'inventory_item_category_id' => $inventoryRequestDetail->category_id
                        ], ['quantity' => 0]);

                        $this->inventoryService->decrementInventory(
                            $inventoryRequest->from_location_id,
                            $inventoryRequestDetail->category_id,
                            $inventoryRequestDetail->quantity,
                            $toInventory->id,
                            $this->isTransferTypeRequest($inventoryRequest)
                        );

                        $fromInventory = $this->inventoryService->findBy([
                            'location_id' => $inventoryRequest->from_location_id,
                            'inventory_item_category_id' => $inventoryRequestDetail->category_id
                        ])->first();

                        $this->inventoryService->incrementInventory(
                            $inventoryRequest->to_location_id,
                            $inventoryRequestDetail->category_id,
                            $inventoryRequestDetail->quantity,
                            $fromInventory->id,
                            $this->isTransferTypeRequest($inventoryRequest)
                        );
                    }
                });
            if(!empty($locationId)){
                $sectionInfo=$this->sectionRepository->findBy(['id'=>$locationId])->first();
                if(!empty($sectionInfo->section_code) && self::MEDICAL_REQUEST_SECTION==$sectionInfo->section_code){
                                    event(new MedicalRequisitionReceived($inventoryRequest->details,1));
                }
            }

        }

        return $isReceived;
    }

    private function recipientsForTransition($data = [])
    {
        if (!empty($data['recipients']) && is_array($data['recipients'])) {
            $recipients = collect();

            foreach ($data['recipients'] as $key => $recipient) {
                if (!is_null($recipient)) {
                    $recipients->push(User::findOrFail($recipient));
                }
            }

            return $recipients;
        }

        return collect();
    }

    private function detailsForTransition($data = [])
    {
        $details = [];

        if (array_key_exists('message', $data)) {
            $details['message'] = !empty($data['message']) ? $data['message'] : null;
        }

        if (array_key_exists('remark', $data)) {
            $details['remark'] = !empty($data['remark']) ? $data['remark'] : "";
        }

        return $details;
    }

    public function remarks(InventoryRequest $inventoryRequest)
    {
        return $inventoryRequest->stateMachine()->getObject()->stateHistory;
    }

    public function filterRequestByDepartment($departmentCode)
    {
        $inventoryRequests = $this->findAll(null, null, ['column' => 'created_at', 'direction' => 'desc']);

        if (get_user_designation()->short_name == DesignationShortName::DG) {
            return $inventoryRequests;
        }

        if ($departmentCode == DepartmentShortName::InventoryDivision) {
            return $inventoryRequests;
        } else {
            $filtered = $inventoryRequests->filter(function ($item) use ($departmentCode) {
                $reqDeptCode = $item->requester->employee->employeeDepartment->department_code;
                if ($reqDeptCode == $departmentCode) {
                    return true;
                }
            });
            return $filtered;
        }
    }

    /**
     * @param $inventoryRequest
     * @return bool
     */
    public function isTransferTypeRequest($inventoryRequest): bool
    {
        return $inventoryRequest->type == InventoryRequestType::TRANSFER;
    }

    public function dashboardActivities()
    {
        $inventoryRequests = InventoryRequest::all()
            ->filter(function ($inventoryRequest) {
                return ($inventoryRequest->isRecipient()
                    && $inventoryRequest->status != 'rejected');
            });

        return $inventoryRequests;
    }

    /**
     * Check if Requested Quantity is available
     * @param InventoryRequest $inventoryRequest
     * @param int $locationId
     * @return bool
     */

    public function checkForQuantityAvailability(InventoryRequest $inventoryRequest, int $locationId): bool
    {
        $isQuantityAvailable = true;

        $inventoryRequest->details
            ->filter(function ($inventoryRequestDetail) {
                return $inventoryRequestDetail->category->is_active;
            })
            ->each(function ($inventoryRequestDetail) use ($locationId, &$isQuantityAvailable, $inventoryRequest) {
                $itemInventory = $this->inventoryService->findBy([
                    'location_id' => $locationId,
                    'inventory_item_category_id' => $inventoryRequestDetail->category_id
                ])->first();

                $approvedQuantity = InventoryRequest::where('status', 'approved')
                    ->where('id', '!=', $inventoryRequest->id)
                    ->where('from_location_id', $locationId)
                    ->get()
                    ->sum(function ($invReq) use ($inventoryRequestDetail) {
                        return $invReq->details
                            ->where('category_id', $inventoryRequestDetail->inventory_category_id)
                            ->sum('quantity');
                    });

                if (($itemInventory->quantity - $approvedQuantity) < $inventoryRequestDetail->quantity) {
                    return $isQuantityAvailable = false;
                }
            });

        return $isQuantityAvailable;
    }


}
