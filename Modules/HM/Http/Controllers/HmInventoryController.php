<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\HM\Services\HmInventoryService;
use Modules\IMS\Entities\InventoryLocation;
use Modules\IMS\Entities\InventoryRequest;


class HmInventoryController extends Controller
{
    /**
     * @var HmInventoryService
     */
    private $hmInventoryService;

    /**
     * HmInventoryController constructor.
     * @param HmInventoryService $hmInventoryService
     */
    public function __construct(HmInventoryService $hmInventoryService)
    {
        $this->hmInventoryService = $hmInventoryService;
    }

    /*
    |--------------------------------------------------------------------------
    | Methods Related to HM Inventory Requests
    |--------------------------------------------------------------------------
    */

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $inventoryRequests = $this->hmInventoryService->getFilteredInventoryRequests();
        return view('hm::inventory.request.index', compact('inventoryRequests'));
    }

    /**
     * Show the specified resource.
     * @param InventoryRequest $inventoryRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(InventoryRequest $inventoryRequest)
    {
        return view('hm::inventory.request.show', compact('inventoryRequest'));
    }

    /*
    |--------------------------------------------------------------------------
    | Methods Related to HM Store
    |--------------------------------------------------------------------------
    */

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function locations()
    {
        $inventoryLocations = $this->hmInventoryService->getFilteredInventoryLocations();
        $departmentCode = $this->hmInventoryService::HOSTEL_DEPT_CODE;

        return view('hm::inventory.location.index', compact('inventoryLocations', 'departmentCode'));
    }

    /**
     * Show the specified resource in storage.
     * @param InventoryLocation $location
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLocation(InventoryLocation $location)
    {
        $itemLists = $location->inventories;
        return view('hm::inventory.location.show', compact('location', 'itemLists'));
    }
}
