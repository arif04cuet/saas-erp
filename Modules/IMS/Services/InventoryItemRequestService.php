<?php

namespace Modules\IMS\Services;

use App\Traits\CrudTrait;
use App\Utilities\EnToBnNumberConverter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\IMS\Entities\AuctionDetail;
use Modules\IMS\Entities\InventoryItemRequest;
use Modules\IMS\Entities\InventoryItemRequestDetail;
use Modules\IMS\Entities\InventoryLocation;
use Modules\IMS\Repositories\InventoryItemRequestRepository;
use Modules\TMS\Entities\Training;
use MongoDB\Driver\Session;

class InventoryItemRequestService
{
    use CrudTrait;

    /**
     * @var InventoryService
     */
    private $inventoryService;
    /**
     * @var InventoryItemRequestWorkflowService
     */
    private $inventoryItemRequestWorkflowService;

    public function __construct(
        InventoryItemRequestRepository $inventoryItemRequestRepository,
        InventoryItemRequestWorkflowService $inventoryItemRequestWorkflowService,
        InventoryService $inventoryService
    ) {
        $this->setActionRepository($inventoryItemRequestRepository);
        $this->inventoryItemRequestWorkflowService = $inventoryItemRequestWorkflowService;
        $this->inventoryService = $inventoryService;
    }

    public function getPurposes()
    {
        return $this->actionRepository->getModel()::getPurpose();
    }

    public function getInventoryItemsByLocation(): array
    {
        $itemsByLocation = $this->inventoryService->findAll()->each(function ($item) {
            $item->name = $item->inventoryItemCategory->name . ' (' . $item->inventoryItemCategory->unit . ')' . ' (' . EnToBnNumberConverter::en2bn($item->quantity) . ')';
            return $item;
        })->groupBy('location_id');
        $data = [];
        foreach ($itemsByLocation as $key => $value) {
            $data[$key] = $value->pluck('name', 'id');
        }
        return $data;
    }

    public function getItemsForDropdown(): array
    {
        $implementValue = function ($inventory) {
            return $inventory->inventoryItemCategory->name . ' (' . $inventory->inventoryItemCategory->unit . ')' . ' (' . EnToBnNumberConverter::en2bn($inventory->quantity) . ')';
        };
        return $this->inventoryService->getInventoryForDropdown($implementValue, null, null, null);
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $this->checkForStoreAdmin($data);
            $inventoryItemRequestData = $this->getItemRequestArray($data);
            $inventoryItemRequest = $this->save($inventoryItemRequestData);
            if (isset($data['inventory-items'])) {
                $collectionOfInventoryItemRequestDetails = collect($data['inventory-items'])->map(function ($item) use (
                    $inventoryItemRequest
                ) {
                    $item['inventory_item_request_id'] = $inventoryItemRequest->id;
                    return new InventoryItemRequestDetail($item);
                });
                $inventoryItemRequest->details()->saveMany($collectionOfInventoryItemRequestDetails);
            }
            $this->inventoryItemRequestWorkflowService->start($inventoryItemRequest);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Inventory Item Request Workflow Error: ' . $exception->getMessage()) . ' Trace: ' . $exception->getTraceAsString();
            return false;
        }
    }

    public function setOldSessionValues(InventoryItemRequest $inventoryItemRequest)
    {

        // set general inputs
        session(['_old_input.inventory_location_id' => $inventoryItemRequest->inventory_location_id]);
        session(['_old_input.title' => $inventoryItemRequest->title]);
        session(['_old_input.purpose' => $inventoryItemRequest->purpose]);
        session(['_old_input.reason' => $inventoryItemRequest->reason]);
        $oldResponses = [];
        foreach ($inventoryItemRequest->details as $inventoryItemRequestDetail) {
            $data = [];
            $data['inventory_item_category_id'] = $inventoryItemRequestDetail->inventory_item_category_id;
            $data['quantity'] = $inventoryItemRequestDetail->quantity;
            $oldResponses[] = $data;
        }
        session(['_old_input.inventory-items' => $oldResponses]);
    }

    public function clearOldSessionValues()
    {
        // set general inputs
        if (session()->has('_old_input.inventory_location_id')) {
            session()->forget('_old_input.inventory_location_id');
        }
        if (session()->has('_old_input.title')) {
            session()->forget('_old_input.title');
        }
        if (session()->has('_old_input.purpose')) {
            session()->forget('_old_input.purpose');
        }
        if (session()->has('_old_input.reason')) {
            session()->forget('_old_input.reason');
        }
        if (session()->has('_old_input.inventory-items')) {
            session()->forget('_old_input.inventory-items');
        }
    }

    public function updateData(array $data, InventoryItemRequest $inventoryItemRequest)
    {
        try {
            DB::beginTransaction();
            $this->checkForStoreAdmin($data);
            $inventoryItemRequestData = $this->getItemRequestArray($data);
            $inventoryItemRequest = $this->update($inventoryItemRequest, $inventoryItemRequestData);
            $inventoryItemRequest->details()->delete();

            if (isset($data['inventory-items'])) {
                $collectionOfInventoryItemRequestDetails = collect($data['inventory-items'])->map(function ($item) use (
                    $inventoryItemRequest
                ) {
                    $item['inventory_item_request_id'] = $inventoryItemRequest->id;
                    return new InventoryItemRequestDetail($item);
                });
                $inventoryItemRequest->details()->saveMany($collectionOfInventoryItemRequestDetails);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Inventory Item Request Workflow Error: ' . $exception->getMessage()) . ' Trace: ' . $exception->getTraceAsString();
            return false;
        }

    }

    /**
     * |------------------------------------------------------------------------------------------------------------------
     * |                                              Private Method
     * |-----------------------------------------------------------------------------------------------------------------
     * |
     */

    /**
     * @param array $data
     * @throws \Exception
     */
    private function checkForStoreAdmin(array $data)
    {
        if (!isset($data['inventory_location_id'])) {
            throw  new \Exception(trans('ims::inventory.item.item_request.flash_messages.store_admin_error',
                ['store' => 'Not Found']));
        }
        $store = InventoryLocation::find($data['inventory_location_id']);
        if (is_null($store->adminEmployee)) {
            throw  new \Exception(trans('ims::inventory.item.item_request.flash_messages.store_admin_error',
                ['store' => $store->name]));
        }
        // store admin found, now check if the admin has ROLE_INVENTORY_STORE_ADMIN role
        $storeAdminUser = optional($store->adminEmployee)->user ?? null;
        $superAdmin = config('ims.constants.item.request.workflow.super_admin');
        if (is_null($store->adminEmployee)) {
            throw  new \Exception('Store Admin : ' . $store->adminEmployee->getName() . ' : Does Not Have A User Profile!');
        }
        if (!$storeAdminUser->hasRole($superAdmin)) {
            if (is_null($store->adminEmployee)) {
                throw  new \Exception('Store Admin: ' . $store->adminEmployee->getName() . 'Does Not Have ROLE_INVENTORY_STORE_ADMIN rorle!');
            }
        }
    }

    /**
     * @param array $data
     * @return array
     */
    private function getItemRequestArray(array $data): array
    {
        $uid = $this->getUniqueCode();
        $requesterId = auth()->user()->id;
        $purpose = safeArrayValue($data, 'purpose');
        $referenceValues = $this->getReferenceValues($data, $purpose);
        return [
            'requester_id' => $requesterId,
            'inventory_location_id' => safeArrayValue($data, 'inventory_location_id'),
            'title' => safeArrayValue($data, 'title'),
            'reason' => safeArrayValue($data, 'reason'),
            'uid' => $uid,
            'purpose' => $purpose,
            'reference_entity' => $referenceValues['reference_entity'],
            'reference_entity_id' => $referenceValues['reference_entity_id']
        ];
    }

    /**
     * @return string
     */
    private function getUniqueCode(): string
    {
        return md5(microtime(true) . mt_Rand());
    }

    /**
     * @param array $data
     * @param $purpose
     * @return array|null[]
     */
    private function getReferenceValues(array $data, $purpose): array
    {
        switch ($purpose) {
            case 'training':
                return [
                    'reference_entity' => Training::class,
                    'reference_entity_id' => $data['reference_entity_id']
                ];
            default:
                return [
                    'reference_entity' => null,
                    'reference_entity_id' => null
                ];
        }
    }

    public function getStatusCssArray()
    {
        return [
            'approved' => 'success',
            'rejected' => 'error',
            'pending' => 'warning',
            'draft' => 'warning',
            'new' => 'warning'
        ];


    }

}

