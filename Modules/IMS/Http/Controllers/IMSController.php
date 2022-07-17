<?php

namespace Modules\IMS\Http\Controllers;

use App\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\IMS\Entities\InventoryItemCategory;
use Modules\IMS\Services\AuctionService;
use Modules\IMS\Services\InventoryRequestService;
use Modules\IMS\Services\InventoryService;

class IMSController extends Controller
{
    private $inventoryRequestService;
    private $inventoryService;
    private $auctionService;

    public function __construct(InventoryRequestService $inventoryRequestService
        ,InventoryService $inventoryService
        ,AuctionService $auctionService
    )
    {
        $this->inventoryRequestService = $inventoryRequestService;
        $this->inventoryService = $inventoryService;
        $this->auctionService = $auctionService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $inventoryRequests = $this->inventoryRequestService->dashboardActivities();
        $auctions = $this->auctionService->dashboardActivities();
        $requestDetails = $this->inventoryService->requestDetails();
        $users = User::all();
        $categoryItems = InventoryItemCategory::all();

        return view(
            'ims::index',
            compact('inventoryRequests',
                'requestDetails',
                'users',
                'categoryItems',
                'auctions'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('ims::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('ims::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('ims::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
