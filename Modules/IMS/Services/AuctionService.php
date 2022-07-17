<?php

/**
 * Created By- Imran Hossain - 25-05-2019
 */

namespace Modules\IMS\Services;

use App\Entities\User;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Auth;
use Modules\IMS\Constants\InventoryFixedLocation;
use Modules\IMS\Constants\InventoryRequestType;
use Modules\IMS\Entities\AuctionDetail;
use Modules\IMS\Entities\Auction;
use Modules\IMS\Entities\Inventory;
use Modules\IMS\Entities\InventoryRequest;
use Modules\IMS\Repositories\AuctionItemRepository;
use Modules\IMS\Repositories\AuctionRepository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuctionService
{

    use CrudTrait;

    private $auctionRepository;
    private $inventoryService;
    /**
     * @var AuctionItemRepository
     */
    private $auctionItemRepository;

    /**
     * AuctionService constructor.
     * @param AuctionRepository $auctionRepository
     * @param InventoryService $inventoryService
     * @param AuctionItemRepository $auctionItemRepository
     */
    public function __construct(
        AuctionRepository $auctionRepository,
        InventoryService $inventoryService,
        AuctionItemRepository $auctionItemRepository
    ) {
        $this->auctionRepository = $auctionRepository;
        $this->inventoryService = $inventoryService;
        $this->setActionRepository($this->auctionRepository);
        $this->auctionItemRepository = $auctionItemRepository;
    }

    /**
     * Store Auction Data and Auction Detail Data
     * @param array $data
     * @return mixed
     */
    public function auctionStore(array $data)
    {
        return DB::transaction(function () use ($data) {
            $auctionArray['title'] = $data['auction_title'];
            $auctionArray['status'] = 'new';
            $auctionArray['requester_id'] = Auth::user()->id;
            $auctionArray['date'] = Carbon::createFromFormat('d/m/Y', $data['auction_date']);
            $auction = $this->save($auctionArray);


            $auction->applyTransition('pending');
            // convert to model and save it in the db using save many
            if (isset($data['scrap_product'])) {
                $collectionOfAuctionDetails = collect($data['scrap_product']);
                $auctionDetails = $collectionOfAuctionDetails->map(function ($auctionDetail) use ($auction) {
                    $auctionDetail['auction_id'] = $auction->id;
                    return new AuctionDetail($auctionDetail);
                });
                return $auction->details()->saveMany($auctionDetails);
            } else {
                return $auction;
            }
        });
    }

    /**
     * Update Auction Data and Auction Detail Data
     * @param Auction $auction
     * @param array $data
     * @return mixed
     */
    public function auctionUpdate(Auction $auction, array $data)
    {
        return DB::transaction(function () use ($auction, $data) {
            $auctionArray['title'] = $data['auction_title'];
            $auctionArray['date'] = Carbon::createFromFormat('d/m/Y', $data['auction_date']);
            $this->update($auction, $auctionArray);

            // $auction->update($auctionArray);
            if (isset($data['scrap_product'])) {
                $collectionOfAuctionDetails = collect($data['scrap_product']);
                // convert to model and update it
                $newCollectionOfAuctionDetails = $collectionOfAuctionDetails
                    ->map(function ($auctionDetail) use ($auction) {
                        $auction->details()->UpdateOrCreate(
                            [
                                'id' => $auctionDetail['id'],
                            ],
                            [
                                'auction_id' => $auction->id,
                                'category_id' => $auctionDetail['category_id'],
                                'quantity' => $auctionDetail['quantity']
                            ]
                        );
                    });
                return $newCollectionOfAuctionDetails;
            }
        });
    }


    public function getAvailableInventoryItemCategoriesOfAuction(Auction $auction)
    {
        return $auction->details->filter(function ($auctionDetail) {
            if ($auctionDetail->quantity > 0) {
                return $auctionDetail;
            }
        })->map(function ($auctionDetail) {
            return $auctionDetail->inventoryItemCategory;
        });
    }

    /**
     * Check if Requested Quantity is available
     * @param Auction $auction
     * @param int $locationId
     * @return bool
     */

    public function checkForQuantityAvailability(Auction $auction, int $locationId): bool
    {
        $isQuantityAvailable = true;

        $auction->details
            ->filter(function ($auctionDetail) {
                return $auctionDetail->inventoryItemCategory->is_active;
            })
            ->each(function ($auctionDetail) use ($locationId, &$isQuantityAvailable, $auction) {
                $itemInventory = $this->inventoryService->findBy([
                    'location_id' => $locationId,
                    'inventory_item_category_id' => $auctionDetail->category_id
                ])->first();

                $approvedQuantity = Auction::where('status', 'approved')
                    ->where('id', '!=', $auction->id)
                    ->get()
                    ->sum(function ($auction) use ($auctionDetail) {
                        return $auction->details
                            ->where('category_id', $auctionDetail->category_id)
                            ->sum('quantity');
                    });
                if (($itemInventory->quantity - $approvedQuantity) < $auctionDetail->quantity || !$itemInventory->quantity) {
                    return $isQuantityAvailable = false;
                }
            });
        return $isQuantityAvailable;
    }

    /*
    |--------------------------------------------------------------------------
    |     Auction Workflow Related Functions Are Listed Below
    |--------------------------------------------------------------------------
    |   - dashboardActivities()-> To show dashboard Information
    |   - traverseWorkflow()-> To traverse in graph
    |   - approve, share, reject, receive States are used to traverse
    |   - RecipientForTransition, DetailForTransition
    */

    public function dashboardActivities()
    {
        $auctions = Auction::all()
            ->filter(function ($auction) {
                return $auction->isRecipient();
            });

        return $auctions;
    }

    public function getAuctionItems($auctionId)
    {
        return $this->auctionItemRepository->findBy(['auction_id' => $auctionId], ['item']);
    }

    public function traverseWorkflow($data = [])
    {
        return DB::transaction(function () use ($data) {
            if (method_exists($this, $data['transition']) && is_callable(AuctionService::class, $data['transition'])) {
                return call_user_func_array(array($this, $data['transition']), ['data' => $data]);
            }
        });
    }

    /**
     * Saves inventory items that are selected while approving an auction request
     * @param $itemIds
     * @param int $auctionId
     */
    public function saveAuctionItems($itemIds, int $auctionId)
    {
        foreach ($itemIds as $itemId) {
            $requestItemData = [
                'auction_id' => $auctionId,
                'inventory_item_id' => $itemId,
                'created_at' => Carbon::parse()->format('Y-m-d H:i:s')
            ];
            $this->auctionItemRepository->save($requestItemData);
        }
    }

    private function approve($data = [])
    {
        $auction = $this->findOrFail($data['auction_id']);
        $this->saveAuctionItems($data['inventory_item_ids'] ?? [], $data['auction_id']);

        return $auction->applyTransition('approve', $this->recipientsForTransition($data),
            $this->detailsForTransition($data));
    }

    private function share($data = [])
    {
        $auction = $this->findOrFail($data['auction_id']);

        return $auction->applyTransition('share', $this->recipientsForTransition($data),
            $this->detailsForTransition($data));
    }

    private function reject($data = [])
    {
        $auction = $this->findOrFail($data['auction_id']);

        return $auction->applyTransition('reject', $this->recipientsForTransition($data),
            $this->detailsForTransition($data));
    }

    private function receive($data = [])
    {
        $auction = $this->findOrFail($data['auction_id']);

        $isReceived = $auction->applyTransition('receive', $this->recipientsForTransition($data),
            $this->detailsForTransition($data));


        if ($isReceived) {
            $auction->details
                ->each(function ($auctionDetail, $index) use ($auction) {
                    // reduce from the Scrap Location
                    $isDecreased = $this->inventoryService->decrementInventory(
                        InventoryFixedLocation::SCRAP_LOCATION,
                        $auctionDetail->category_id,
                        $auctionDetail->quantity,
                        null,
                        false
                    );
                });
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

    /*
       |--------------------------------------------------------------------------|
       |                    Auction Workflow Function Ends Here                   |
       |--------------------------------------------------------------------------|
   */


}
