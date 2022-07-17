<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cafeteria\Services\RawMaterialService;
use Modules\Cafeteria\Http\Requests\RawMaterialRequest;
use Modules\Cafeteria\Services\CafeteriaInventoryService;
use Modules\Cafeteria\Services\RawMaterialCategoryService;
use Modules\Cafeteria\Services\UnitService;

class RawMaterialController extends Controller
{
    private $rawMaterialService;
    private $unitService;
    private $cafeteriaInventoryService;
    private $rawMaterialCategoryService;

    public function __construct(
        RawMaterialService $rawMaterialService,
        UnitService $unitService,
        CafeteriaInventoryService $cafeteriaInventoryService,
        RawMaterialCategoryService $rawMaterialCategoryService
    ) {
        $this->rawMaterialService = $rawMaterialService;
        $this->unitService = $unitService;
        $this->cafeteriaInventoryService = $cafeteriaInventoryService;
        $this->rawMaterialCategoryService = $rawMaterialCategoryService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $materials = $this->rawMaterialService->findAll();

        return view('cafeteria::raw-material.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $units = $this->unitService->getUnitsForDropdown(
            null,
            null,
            null,
            true
        );
        $category = $this->rawMaterialCategoryService->getRawMaterialCategoryForDropDown(
            null,
            null,
            null,
            true
        );
        $page = "create";

        return view('cafeteria::raw-material.create', compact('page', 'units', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(RawMaterialRequest $request)
    {
        $this->rawMaterialService->saveRawMaterial($request->all());

        return redirect()->route('raw-materials.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('cafeteria::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $rawMaterial = $this->rawMaterialService->findOrFail($id);
        $units = $this->unitService->getUnitsForDropdown(
            null,
            null,
            null,
            true
        );
        $category = $this->rawMaterialCategoryService->getRawMaterialCategoryForDropDown(
            null,
            null,
            null,
            true
        );
        $page = "edit";

        return view('cafeteria::raw-material.create', compact('rawMaterial', 'page', 'units', 'category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(RawMaterialRequest $request, $id)
    {
        $this->rawMaterialService->updateRawMaterial($request->all(), $id);

        return redirect()->route('raw-materials.index')->with('success', __('labels.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->rawMaterialService->findOrFail($id)->delete();

        return redirect()->route('raw-materials.index')->with('success', __('labels.delete_success'));
    }

    public function changeMaterialStatus(Request $request, $id)
    {
        $this->rawMaterialService->findOrFail($id)->update(['status' => $request->status]);

        return redirect()->route('raw-materials.index')->with('success', __('labels.update_success'));
    }
    
    public function getUnitByMaterial($id)
    {
        $material = $this->rawMaterialService->findOne($id);
        $product = $this->cafeteriaInventoryService->findBy(['raw_material_id' => $id])->first();

        if(app()->isLocale('en')) {
            $material->unit_name = $material->unit->en_name;
        } else {
            $material->unit_name = $material->unit->bn_name; 
        }

        $material->unitPrices;

        $material->available_amount = $product->available_amount;
        
        return response()->json($material);
    }
}
