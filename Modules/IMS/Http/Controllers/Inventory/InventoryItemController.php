<?php

namespace Modules\IMS\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\IMS\Http\Requests\InventoryItemCreateAndUpdateRequest;
use Modules\IMS\Services\InventoryItemCategoryService;
use Modules\IMS\Services\InventoryItemService;

class InventoryItemController extends Controller
{
    /**
     * @var InventoryItemService
     */
    private $inventoryItemService;

    /**
     * InventoryItemController constructor.
     * @param InventoryItemService $inventoryItemService
     */
    public function __construct(InventoryItemService $inventoryItemService)
    {
        $this->inventoryItemService = $inventoryItemService;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $items = $this->inventoryItemService->findAll(
            null,
            ['category', 'location'],
            ['column' => 'inventory_item_category_id', 'direction' => 'asc']
        );
        return view('ims::inventory.item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create($categoryId)
    {
        $inventoryItemCategory = $this->inventoryItemService->getInventoryItemCategory($categoryId);
        if ($inventoryItemCategory->type != config('constants.inventory_asset_types.fixed asset')) {
            return redirect()->back()->with('error', 'Items can be added only for fixed assets');
        }
        $inventoryLocations = $this->inventoryItemService->getLocationsForDropdown();

        return view('ims::inventory.item.create', compact('inventoryItemCategory', 'inventoryLocations'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->inventoryItemService->store($request->all())) {
            return redirect()->route('inventory-items.index')->with('success', __('labels.save_success'));
        }
        return redirect()->back()->with('error', __('labels.save_fail'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $item = $this->inventoryItemService->findOne($id);
        return view('ims::inventory.item.show', compact('item'));
    }

    /**
     * Edit a specified resource
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->inventoryItemService->findOne($id);
        if ($item->status == 'active') {
            return redirect()->route('inventory-items.index')->with('error', 'Active items can not be edited');
        }
        return view('ims::inventory.item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function update(InventoryItemCreateAndUpdateRequest $request, $id)
    {
        if ($this->inventoryItemService->updateItem($request->all(), $id)) {
            return redirect()->route('inventory-items.show', $id)->with('success', __('labels.update_success'));
        } else {
            return redirect()->back()-with('error', __('labels.update_fail') );
        }
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
