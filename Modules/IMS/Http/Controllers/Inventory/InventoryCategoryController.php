<?php

namespace Modules\IMS\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\IMS\Entities\InventoryItemCategory;
use Modules\IMS\Http\Requests\CreateInventoryItemCategoryRequest;
use Modules\IMS\Http\Requests\UpdateInventoryItemCategoryRequest;
use Modules\IMS\Services\InventoryCategoryGroupService;
use Modules\IMS\Services\InventoryItemCategoryService;

class InventoryCategoryController extends Controller
{

    /**
     * @var InventoryItemCategoryService
     */
    private $inventoryItemCategoryService;
    private $inventoryGroupService;

    public function __construct(
        InventoryItemCategoryService $inventoryItemCategoryService,
        InventoryCategoryGroupService $inventoryCategoryGroupService
    ) {
        /** @var InventoryItemCategoryService $inventoryItemCategoryService */
        $this->inventoryItemCategoryService = $inventoryItemCategoryService;
        $this->inventoryGroupService = $inventoryCategoryGroupService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categories = $this->inventoryItemCategoryService->findAll(
            null,
            null,
            ['column' => 'created_at', 'direction' => 'desc']
        );
        return view('ims::inventory.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $language = 'name_' . Config::get('app.locale');
        $groups = $this->inventoryGroupService->findAll()->pluck($language, 'id');
        return view('ims::inventory.category.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CreateInventoryItemCategoryRequest $request)
    {
        $this->inventoryItemCategoryService->store($request->all());
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('inventory-item-category.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $inventoryItemCategory = $this->inventoryItemCategoryService->findOne($id, ['items']);
        return view('ims::inventory.category.show', compact('inventoryItemCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(InventoryItemCategory $inventoryItemCategory)
    {
        $language = 'name_' . Config::get('app.locale');
        $groups = $this->inventoryGroupService->findAll()->pluck($language, 'id');
        return view('ims::inventory.category.edit', compact('inventoryItemCategory', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param InventoryItemCategory $inventoryItemCategory
     * @return Response
     */
    public function update(CreateInventoryItemCategoryRequest $request, InventoryItemCategory $inventoryItemCategory)
    {
        $this->inventoryItemCategoryService->updateInventoryItemCategory($inventoryItemCategory, $request->all());
        Session::flash('success', trans('labels.save_success'));
        return redirect()->route('inventory-item-category.index');
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

    public function departmentalItemCategory()
    {
        $departmentalCategories = $this->inventoryItemCategoryService->getDepartmentalItemCategories();
        return view('ims::inventory.category.departmental', compact('departmentalCategories'));
    }

    public function groupByCategories($id)
    {
        $categories = $this->inventoryItemCategoryService->findBy(['group_id' => $id]);
        
        return response()->json($categories);
    }
    
    /**
     * CateUnique Check
     * @param Request $request
     * @return bool
     */
    public function uniqueCheck(Request $request)
    {
        $rules = ['new-category.*.name' => 'unique:inventory_item_categories,name'];

        return Validator::make($request->all(), $rules)->passes() ? "true" : "false";
    }

    public function addPrice(Request $request)
    {
        if ($this->inventoryItemCategoryService->addCategoryPrice($request->except('_token'))) {
            Session::flash('success', trans('labels.save_success'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('inventory.show', $request->inventory_item_category_id);
    }
}
