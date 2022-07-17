<?php

namespace Modules\IMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\IMS\Services\InventoryItemService;
use Modules\IMS\Services\ItemAppreciationDepreciationRecordService;

class ItemAppreciationDepreciationRecordController extends Controller
{
    /**
     * @var InventoryItemService
     */
    private $inventoryItemService;
    /**
     * @var ItemAppreciationDepreciationRecordService
     */
    private $appreciationDepreciationRecordService;

    /**
     * ItemAppreciationDepreciationRecordController constructor.
     * @param ItemAppreciationDepreciationRecordService $appreciationDepreciationRecordService
     * @param InventoryItemService $inventoryItemService
     */
    public function __construct(
        ItemAppreciationDepreciationRecordService $appreciationDepreciationRecordService,
        InventoryItemService $inventoryItemService
    ) {
        $this->inventoryItemService = $inventoryItemService;
        $this->appreciationDepreciationRecordService = $appreciationDepreciationRecordService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('ims::index');
    }

    /**
     * Show the form for creating a new resource.
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id = null)
    {
        $items = $this->inventoryItemService->getItemsForDropDown(true);
        return view('ims::asset-management.appreciation-depreciation.create', compact('items', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->appreciationDepreciationRecordService->store($request->all())) {
            return redirect()->route('asset-managements.show', $request->inventory_item_id)
                ->with('success', __('labels.save_success'));
        }
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('ims::show');
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
