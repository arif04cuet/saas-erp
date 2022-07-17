<?php

namespace Modules\IMS\Http\Controllers\Auction;

use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\IMS\Constants\InventoryFixedLocation;
use Modules\IMS\Entities\InventoryLocation;
use Modules\IMS\Http\Requests\InventoryRequestWorkflowRequest;
use Modules\IMS\Repositories\InventoryItemRepository;
use Modules\IMS\Services\AuctionService;
use Modules\IMS\Entities\Auction;

class AuctionWorkflowController extends Controller
{

    private $userService;
    private $auctionService;
    /**
     * @var InventoryItemRepository
     */
    private $inventoryItemRepository;

    /**
     * InventoryRequestWorkflowController constructor.
     * @param UserService $userService
     * @param AuctionService $auctionService
     * @param InventoryItemRepository $inventoryItemRepository
     */
    public function __construct(
        UserService $userService,
        AuctionService $auctionService,
        InventoryItemRepository $inventoryItemRepository
    ) {
        $this->userService = $userService;
        $this->auctionService = $auctionService;
        $this->inventoryItemRepository = $inventoryItemRepository;
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Auction $auction)
    {
        $users = $auction->getNextStatePossibleRecipients();
        $possibleTransitions = $auction->getStateOwnerTransition();
        $fromLocation = InventoryLocation::find(InventoryFixedLocation::SCRAP_LOCATION);
        $auctionDetails = $auction->details ?? [];
        $inventoryItems = [];
        $itemViewOption = in_array('receive', $possibleTransitions) ? true : false;
        /*
       |--------------------------------------------------------------------------
       |     Quantity Validation
       |--------------------------------------------------------------------------
       |   - Quantity Validation is checked for every Request Except Transfer
       |   - In Requisition Request, from_location_id is null
       |   - Newly Added Products do not have any previous records.
       */
        $isQuantityAvailable = false;
        if (in_array('approve', $possibleTransitions)) {
            $isQuantityAvailable = $this->auctionService->checkForQuantityAvailability($auction, $fromLocation->id);

            /**
             * Fetching inventory items available in the scrap location for requested categories
             */
            $requestedCategories = count($auctionDetails) ? $auctionDetails->pluck('category_id')->toArray() : [];
            $inventoryItems = $this->inventoryItemRepository->getItemsByCategoriesAndLocation(
                $requestedCategories,
                $fromLocation->id
            );
        }

        if ($itemViewOption) {
            $inventoryItems = $this->auctionService->getAuctionItems($auction->id);
        }

        return view('ims::auction.workflow.show', compact(
            'auction',
            'auctionDetails',
            'users',
            'possibleTransitions',
            'isQuantityAvailable',
            'fromLocation',
            'inventoryItems',
            'itemViewOption'
        ));
    }

    //todo:: create auctionWorkflowRequest
    public function update(InventoryRequestWorkflowRequest $auctionWorkflowRequest)
    {
        $isTraversed = $this->auctionService->traverseWorkflow($auctionWorkflowRequest->all());

        if ($isTraversed) {
            Session::flash('success', trans('ims::workflow.event.messages.success'));
        } else {
            Session::flash('error', trans('ims::workflow.event.messages.error'));
        }

        return redirect()->route('auctions.index');
    }


}
