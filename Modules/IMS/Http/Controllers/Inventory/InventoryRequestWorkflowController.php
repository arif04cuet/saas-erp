<?php

namespace Modules\IMS\Http\Controllers\Inventory;

use App\Entities\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\IMS\Constants\InventoryFixedLocation;
use Modules\IMS\Entities\InventoryRequest;
use Modules\IMS\Http\Requests\InventoryRequestWorkflowRequest;
use Modules\IMS\Repositories\InventoryItemRepository;
use Modules\IMS\Services\InventoryLocationService;
use Modules\IMS\Services\InventoryRequestService;

class InventoryRequestWorkflowController extends Controller
{
    private $userService;
    private $inventoryRequestService;
    private $inventoryLocationService;
    /**
     * @var InventoryItemRepository
     */
    private $inventoryItemRepository;

    /**
     * InventoryRequestWorkflowController constructor.
     * @param UserService $userService
     * @param InventoryRequestService $inventoryRequestService
     * @param InventoryLocationService $inventoryLocationService
     * @param InventoryItemRepository $inventoryItemRepository
     */
    public function __construct(
        UserService $userService,
        InventoryRequestService $inventoryRequestService,
        InventoryLocationService $inventoryLocationService,
        InventoryItemRepository $inventoryItemRepository
    ) {
        $this->userService = $userService;
        $this->inventoryRequestService = $inventoryRequestService;
        $this->inventoryLocationService = $inventoryLocationService;
        $this->inventoryItemRepository = $inventoryItemRepository;
    }

    /**
     * Show the specified resource.
     * @param InventoryRequest $inventoryRequest
     * @return Response
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    public function show(InventoryRequest $inventoryRequest)
    {
        // get to location
        $toLocation = $inventoryRequest->toLocation;
        $fromLocation = $inventoryRequest->fromLocation;
        $users = $inventoryRequest->getNextStatePossibleRecipients();
        $possibleTransitions = $inventoryRequest->getStateOwnerTransition();
        $requestDetails = $inventoryRequest->details ?? [];

        $requestDetailsActive = $requestDetails->filter(function ($detail) {
            return $detail->category->is_active;
        });
        $requestDetailsNew = $requestDetails->filter(function ($detail) {
            return !$detail->category->is_active;
        });
        $isQuantityAvailable = false;
        $itemViewOption = in_array('receive', $possibleTransitions) ? true : false;
        $inventoryItems = [];

        /*
        |--------------------------------------------------------------------------
        |     Quantity Validation
        |--------------------------------------------------------------------------
        |   - Quantity Validation is checked for every Request Except Transfer
        |   - In Requisition Request, from_location_id is null
        |   - Newly Added Products do not have any previous records.
        */
        if (in_array('approve', $possibleTransitions)) {
            if (!is_null($fromLocation)) {
                $isQuantityAvailable = $this->inventoryRequestService
                    ->checkForQuantityAvailability($inventoryRequest, $fromLocation->id);
            } else {
                $isQuantityAvailable = true;
            }
            /**
             * Fetching inventory items available in the from location for requested categories
             */
            $requestedCategories = $requestDetails->pluck('category_id')->toArray();
            $inventoryItems = $this->inventoryItemRepository
                ->getItemsByCategoriesAndLocation($requestedCategories, $fromLocation->id ?? null);
        }
        if ($itemViewOption) {
            $inventoryItems = $this->inventoryRequestService->getInventoryRequestItems($inventoryRequest->id);
        }

        return view('ims::inventory.request.workflow.show', compact(
                'inventoryRequest',
                'users',
                'possibleTransitions',
                'fromLocation',
                'toLocation',
                'isQuantityAvailable',
                'itemViewOption',
                'requestDetails',
                'requestDetailsActive',
                'requestDetailsNew',
                'inventoryItems'
            )
        );
    }

    public function update(InventoryRequestWorkflowRequest $inventoryRequestWorkflowRequest)
    {
        $isTraversed = $this->inventoryRequestService->traverseWorkflow($inventoryRequestWorkflowRequest->all());

        if ($isTraversed) {
            Session::flash('success', trans('ims::workflow.event.messages.success'));
        } else {
            Session::flash('error', trans('ims::workflow.event.messages.error'));
        }

        return redirect()->route('inventory');
    }

    /**
     * @param InventoryRequest $inventoryRequest
     * @return array
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    public function getCurrentSateRoles(InventoryRequest $inventoryRequest): array
    {
        return $inventoryRequest->stateMachine()->metadata(
            'state',
            $inventoryRequest->stateMachine()->getState(),
            "permissions.{$inventoryRequest->stateMachine()->getState()}.roles"
        );
    }

    /**
     * @param InventoryRequest $inventoryRequest
     * @return \Illuminate\Support\Collection
     */
    private function getWorkflowRecipientId(InventoryRequest $inventoryRequest)
    {
        $lastHistory = $inventoryRequest->stateHistory->last();

        $stateRecipient = DB::table('state_recipients')
            ->where('state_history_id', $lastHistory->id)
            ->first();

        return empty($stateRecipient) ? null : $stateRecipient->user_id;
    }

    /**
     * @param InventoryRequest $inventoryRequest
     * @param $userId
     * @return bool
     */
    private function hasPermissionToReceive($userId, InventoryRequest $inventoryRequest): bool
    {
        if ($inventoryRequest->status === 'approved' && $this->isReceiverOrRequester($userId, $inventoryRequest)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $userId
     * @param InventoryRequest $inventoryRequest
     * @return bool
     */
    private function isRecipient($userId, InventoryRequest $inventoryRequest): bool
    {
        $recipientId = $this->getWorkflowRecipientId($inventoryRequest);

        return $recipientId === $userId && $inventoryRequest->status !== 'approved';
    }

    /**
     * @param $userId
     * @param InventoryRequest $inventoryRequest
     * @return bool
     */
    private function isReceiverOrRequester($userId, InventoryRequest $inventoryRequest): bool
    {
        return $inventoryRequest->requester_id === $userId || $inventoryRequest->receiver_id === $userId;
    }


}
