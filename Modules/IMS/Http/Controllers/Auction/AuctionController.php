<?php

namespace Modules\IMS\Http\Controllers\Auction;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\IMS\Constants\InventoryFixedLocation;
use Modules\IMS\Services\AuctionService;
use Illuminate\Support\Facades\Session;
use Modules\IMS\Entities\Auction;
use Modules\IMS\Services\InventoryService;

class AuctionController extends Controller
{

    private $auctionService;
    private $inventoryService;


    public function __construct(AuctionService $auctionService, InventoryService $inventoryService)
    {
        $this->auctionService = $auctionService;
        $this->inventoryService = $inventoryService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $auctions = $this->auctionService->findAll(null,null,['column'=>'created_at','direction'=>'desc']);
        return view('ims::auction.index', compact('auctions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $scrapCategories = $this->inventoryService->getAvailableScrapProducts(null,
            function ($inventory){
                return $inventory->inventory_item_category_id;
            },
            ['location_id' => InventoryFixedLocation::SCRAP_LOCATION],false );

        return view('ims::auction.create', compact('scrapCategories'));
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'auction_title' => 'required|max:100',
            'auction_date' => 'required',
        ]);

        $newRequest = $this->filterRequest($request);

        if ($this->auctionService->auctionStore($newRequest)) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('auctions.index');
    }

    /**
     * Show the specified resource.
     * @param Auction $auction
     * @return Response
     */
    public function show(Auction $auction)
    {
        return view('ims::auction.show',compact('auction'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Auction $auction
     * @return Response
     */
    public function edit(Auction $auction)
    {
        $scrapCategories = $this->inventoryService->getInventoryForDropdown(
            function ($inventory){
                return $inventory->inventoryItemCategory->name.'('.($inventory->quantity ? $inventory->quantity : 0).')';
            },
            function ($inventory){
                return $inventory->inventory_item_category_id;
            },
            ['location_id' => InventoryFixedLocation::SCRAP_LOCATION]
        );
        $auctionDetails=$auction->details;

        return view('ims::auction.edit',
            compact(
                'auction',
                'auctionDetails',
                'scrapCategories'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request,Auction $auction)
    {
         $newRequest=$this->filterRequest($request);
         if ($this->auctionService->auctionUpdate($auction,$newRequest)) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('auction.workflow.show', $auction->id);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function filterRequest(Request $request): array
    {
        $newRequest = array ();
        $newRequest['_token'] = $request['_token'];
        $newRequest['auction_title'] = $request['auction_title'];
        $newRequest['auction_date'] = $request['auction_date'];
        $newRequest['scrap_product'] = array ();
        foreach ($request->scrap_product as $obj) {
            if (isset($obj['category_id']) && isset($obj['quantity']) && $obj['category_id'] != "null") {

                array_push($newRequest['scrap_product'], $obj);
            }
        }
        return $newRequest;
    }
}
