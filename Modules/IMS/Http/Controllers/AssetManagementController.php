<?php

namespace Modules\IMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\IMS\Services\InventoryItemService;

class AssetManagementController extends Controller
{
    /**
     * @var InventoryItemService
     */
    private $inventoryItemService;

    /**
     * AssetManagementController constructor.
     * @param InventoryItemService $inventoryItemService
     */
    public function __construct(InventoryItemService $inventoryItemService)
    {
        $this->inventoryItemService = $inventoryItemService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $assets = $this->inventoryItemService->findAll(
            null,
            ['category'],
            ['column' => 'inventory_item_category_id', 'direction' => 'desc']
        );
        return view('ims::asset-management.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('ims::asset-management.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Session::flash('message', 'Demo! Data Not Saved');

        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $item = $this->inventoryItemService->findOne($id);
        return view('ims::asset-management.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('ims::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
