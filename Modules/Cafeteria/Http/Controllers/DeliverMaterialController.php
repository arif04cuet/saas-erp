<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cafeteria\Services\DeliverMaterialService;
use Modules\Cafeteria\Services\RawMaterialService;

class DeliverMaterialController extends Controller
{

    /**
     * @var $rawMaterialService
     * @var $deliverMaterialService
     */

    private $rawMaterialService;
    private $deliverMaterialService;

    /**
     * @param RawMaterialService $rawMaterialService
     * @param DeliverMaterialService $deliverMaterialService
     */

    public function __construct(
        RawMaterialService $rawMaterialService,
        DeliverMaterialService $deliverMaterialService
    ) {
        $this->rawMaterialService = $rawMaterialService;
        $this->deliverMaterialService = $deliverMaterialService;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $materials = $this->deliverMaterialService->getDeliveryMaterialFilterData();

        return view('cafeteria::deliver-material.index', compact('materials'));
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
                    true);
        $units = [];
        $page = "create";
        
        return view('cafeteria::deliver-material.create', compact('rawMaterials', 'units', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->deliverMaterialService->saveDeliverMaterialData($request->all());

        return redirect()->route('deliver-materials.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $deliverItem = $this->deliverMaterialService->findOne($id);

        return view('cafeteria::deliver-material.show', compact('deliverItem'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $deliverItem = $this->deliverMaterialService->findOrFail($id);
        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown(
                null, 
                null, 
                ['type' => 'raw-item', 'status' => 'active'], 
                true);
        $units = [];
        $page = "edit";

        return view('cafeteria::deliver-material.create', compact('deliverItem','rawMaterials', 'units', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->deliverMaterialService->updateDeliverMaterialData($request->all(), $id);

        return redirect()->route('deliver-materials.index')->with('success', __('labels.update_success'));
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

    public function approvalForm($id)
    {
        $deliverItem = $this->deliverMaterialService->findOrFail($id);
        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown(
            null, 
            null, 
            ['type' => 'raw-item', 'status' => 'active'], 
            true);
        $units = [];

        return view('cafeteria::deliver-material.approval.create', compact('deliverItem', 'rawMaterials', 'units'));
    }

    public function approveDeliverList(Request $request, $id)
    {  
        $this->deliverMaterialService->approveDeliverMaterialData($request->all(), $id);

        return redirect()->route('deliver-materials.index')->with('success', __('labels.update_success'));
    }
}
