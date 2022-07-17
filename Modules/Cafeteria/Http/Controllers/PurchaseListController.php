<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cafeteria\Services\PurchaseListService;
use Modules\Cafeteria\Services\RawMaterialService;

class PurchaseListController extends Controller
{
    private $purchaseListService;
    private $rawMaterialService;

    public function __construct(
        PurchaseListService $purchaseListService,
        RawMaterialService $rawMaterialService
    ) {
        $this->purchaseListService = $purchaseListService;
        $this->rawMaterialService = $rawMaterialService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $purchaseItems = $this->purchaseListService->getPurchaseListFilterData();

        return view('cafeteria::purchase-list.index', compact('purchaseItems'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown(
            null,
            null,
            ['type' => 'raw-item', 'status' => 'active'],
            true
        );
        $units = [];
        $page = "create";

        return view('cafeteria::purchase-list.create', compact('page', 'rawMaterials', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
       $this->purchaseListService->savePurchaseList($request->all());
       
       return redirect()->route('purchase-lists.index')->with('success', __('labels.save_success'));  
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $purchaseList = $this->purchaseListService->findOne($id);

        return view('cafeteria::purchase-list.show', compact('purchaseList'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $purchaseItem = $this->purchaseListService->findOne($id);

        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown(
            null,
            null,
            ['type' => 'raw-item', 'status' => 'active'],
            true
        );
        $units = [];
        $page = "edit";

        return view('cafeteria::purchase-list.create', compact('purchaseItem', 'page', 'rawMaterials', 'units'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->purchaseListService->updatePurchaseList($request->all(), $id);

       return redirect()->route('purchase-lists.index')->with('success', __('labels.update_success'));  
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->purchaseListService->delete($id);
        
        return redirect()->route('purchase-lists.index')->with('success', __('labels.delete_success'));     
    }


    public function approvalForm($id)
    {
        $purchaseItem = $this->purchaseListService->findOne($id);

        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown(
            null,
            null,
            ['type' => 'raw-item', 'status' => 'active'],
            true
        );

        return view('cafeteria::purchase-list.approval.create', compact('purchaseItem', 'rawMaterials'));
    }

    public function approvePurchaseList(Request $request, $id)
    {
       $this->purchaseListService->approvePurchaseList($request->all(), $id);

       return redirect()->route('purchase-lists.index')->with('success', __('labels.update_success'));
    }
}
