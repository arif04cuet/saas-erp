<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\IMS\Entities\InventoryLocation;
use Modules\IMS\Entities\InventoryRequest;
use Modules\TMS\Services\TmsInventoryService;

class TmsInventoryController extends Controller
{
    /**
     * @var TmsInventoryService
     */
    private $tmsInventoryService;

    /**
     * TmsInventoryController constructor.
     * @param TmsInventoryService $tmsInventoryService
     */
    public function __construct(TmsInventoryService $tmsInventoryService)
    {
        $this->tmsInventoryService = $tmsInventoryService;
    }

    /*
    |--------------------------------------------------------------------------
    | Methods Related to TMS Inventory Requests
    |--------------------------------------------------------------------------
    */

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $inventoryRequests = $this->tmsInventoryService->getFilteredInventoryRequests();
        return view('tms::inventory.request.index', compact('inventoryRequests'));
    }

    /**
     * Show the specified resource.
     * @param InventoryRequest $inventoryRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(InventoryRequest $inventoryRequest)
    {
        return view('tms::inventory.request.show', compact('inventoryRequest'));
    }

    /*
    |--------------------------------------------------------------------------
    | Methods Related to TMS Store
    |--------------------------------------------------------------------------
    */

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function locations()
    {
        $inventoryLocations = $this->tmsInventoryService->getFilteredInventoryLocations();
        $departmentCode = $this->tmsInventoryService::TRAINING_DEPT_CODE;

        return view('tms::inventory.location.index', compact('inventoryLocations', 'departmentCode'));
    }

    /**
     * Show the specified resource in storage.
     * @param InventoryLocation $location
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLocation(InventoryLocation $location)
    {
        $itemLists = $location->inventories;
        return view('tms::inventory.location.show', compact('location', 'itemLists'));
    }
}
