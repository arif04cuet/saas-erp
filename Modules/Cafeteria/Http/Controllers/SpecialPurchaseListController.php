<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cafeteria\Services\RawMaterialService;
use Modules\Cafeteria\Services\SpecialGroupService;
use Modules\Cafeteria\Services\SpecialPurchaseListService;

class SpecialPurchaseListController extends Controller
{
    /**
     * @var $rawMaterialsService;
     * @var $specialGroupService;
     * @var $specialPurchaseListService;
     */

     private $rawMaterialService;
     private $specialGroupService;
     private $specialPurchaseListService;

     /**
      * @param RawMaterialService $rawMaterialService;
      * @param SpecialGroupService $specialGroupService;
      * @param SpecialPurchaseListService $specialPurchaseListService;
      */

      public function __construct(
          RawMaterialService $rawMaterialService,
          SpecialGroupService $specialGroupService,
          SpecialPurchaseListService $specialPurchaseListService
      ) {
          $this->rawMaterialService = $rawMaterialService;
          $this->specialGroupService = $specialGroupService;
          $this->specialPurchaseListService = $specialPurchaseListService;
      }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $purchaseLists = $this->specialPurchaseListService->findAll(null, null, ['column' => 'id', 'direction' => 'DESC']);

        return view('cafeteria::special-purchase-list.index', compact('purchaseLists'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown(null, null, ['type' => 'raw-item', 'status' => 'active'], true);
        $groups = $this->specialGroupService->getSpecialGroupsForDropdown(null, null, null, true);
        $page = "create";
        return view('cafeteria::special-purchase-list.create', compact('page', 'rawMaterials', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->specialPurchaseListService->storeSpecialPurchaseList($request->all());

        return redirect()->route('special-purchase-lists.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $list = $this->specialPurchaseListService->findOne($id);

        return view('cafeteria::special-purchase-list.show', compact('list'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $list = $this->specialPurchaseListService->findOrFail($id);
        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown(null, null, ['type' => 'raw-item', 'status' => 'active'], true);
        $groups = $this->specialGroupService->getSpecialGroupsForDropdown(null, null, null, true);
        $page = "edit";
        return view('cafeteria::special-purchase-list.create', compact('list', 'rawMaterials', 'groups', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->specialPurchaseListService->updateSpecialPurchaseList($request->all(), $id);

        return redirect()->route('special-purchase-lists.index')->with('success', __('labels.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->specialPurchaseListService->findOrFail($id)->delete();

        return redirect()->route('special-purchase-lists.index')->with('success', __('labels.delete_success'));
    }
}
