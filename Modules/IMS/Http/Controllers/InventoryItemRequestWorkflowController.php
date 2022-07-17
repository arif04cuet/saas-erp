<?php

namespace Modules\IMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\IMS\Entities\InventoryItemRequest;
use Modules\IMS\Services\InventoryItemRequestWorkflowService;
use Modules\IMS\Services\InventoryService;
use Modules\VMS\Entities\Trip;

class InventoryItemRequestWorkflowController extends Controller
{
    private $service;
    private $inventoryService;

    public function __construct(
        InventoryItemRequestWorkflowService $inventoryItemRequestWorkflowService,
        InventoryService $inventoryService
    ) {
        $this->service = $inventoryItemRequestWorkflowService;
        $this->inventoryService = $inventoryService;
    }

    public function show(InventoryItemRequest $inventoryItemRequest)
    {
        $shouldShowApproveRejectButton = $this->service->shouldShowApproveRejectButton($inventoryItemRequest);
        return view('ims::inventory.item.workflow.show',
            compact('inventoryItemRequest', 'shouldShowApproveRejectButton'));
    }

    public function changeStatus(InventoryItemRequest $inventoryItemRequest, $status)
    {
        if ($this->service->changeStatus($inventoryItemRequest, $status)) {
            $successMessage = trans('labels.save_success');
            if (Session::has('success')) {
                $successMessage = Session::get('success');
            }
            // if finally approved, decrement the inventory
            if ($inventoryItemRequest->status == InventoryItemRequest::getStatus()['approved']) {
                $inventoryLocationId = $inventoryItemRequest->inventory_location_id;
                foreach ($inventoryItemRequest->details as $detail) {
                    $this->inventoryService->decrementInventory($inventoryLocationId,
                        $detail->inventory_item_category_id, $detail->quantity, null, false);
                }
            }
            return redirect()->route('inventory-item-request.index')->with('success', $successMessage);
        } else {
            $errorMessage = trans('labels.save_fail');
            if (Session::has('error')) {
                $errorMessage = Session::get('error');
            }
            return redirect()->route('inventory-item-request.index')->with('error', $errorMessage);
        }
    }

    /**
     * @param InventoryItemRequest $inventoryItemRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function startWorkflow(InventoryItemRequest $inventoryItemRequest): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->service->start($inventoryItemRequest);
            $successMessage = trans('labels.save_success');
            if (Session::has('success')) {
                $successMessage = Session::get('success');
            }
            return redirect()->route('inventory-item-request.index')->with('success', $successMessage);
        } catch (\Exception $exception) {
            $errorMessage = trans('labels.save_fail');
            if (Session::has('error')) {
                $errorMessage = Session::get('error');
            }
            return redirect()->route('inventory-item-request.index')->with('error', $errorMessage);
        }
    }


}
