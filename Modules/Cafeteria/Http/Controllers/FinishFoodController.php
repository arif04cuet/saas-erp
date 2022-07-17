<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Modules\Cafeteria\Services\CafeteriaInventoryService;
use Modules\Cafeteria\Services\FoodMenuService;
use Modules\Cafeteria\Services\RawMaterialService;

class FinishFoodController extends Controller
{
    const EMPTY_VALUE = 0;
    /**
     * @var $rawMaterialService
     * @var $foodMenuService
     * @var $cafeteriaInventoryService
     */
    private $rawMaterialService;
    private $foodMenuService;
    private $cafeteriaInventoryService;

    /**
     * @param RawMaterialService $rawMaterialServie
     * @param FoodMenuService $foodMenuService
     * @param CafeteriaInventoryService $cafeteriaInventoryService
     */

    public function __construct(
        RawMaterialService $rawMaterialService,
        FoodMenuService $foodMenuService,
        CafeteriaInventoryService $cafeteriaInventoryService
    ) {
        $this->rawMaterialService = $rawMaterialService;
        $this->foodMenuService = $foodMenuService;
        $this->cafeteriaInventoryService = $cafeteriaInventoryService;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $finishFoods = $this->rawMaterialService->findBy(['type' => 'finish-food', 'status' => 'active']);
        $dropdownKey = function ($query) {
            return $query->id;
        };
        $foodMenus = $this->foodMenuService->getFoodMenuForDropdown(
            null,
            $dropdownKey,
            null,
            false
        );
        return view('cafeteria::finish-food.index', compact('finishFoods', 'foodMenus'));
    }

    public function filterAsJson(Request $request)
    {
        $foodItems =  $this->foodMenuService->filter($request->all());

        return response()->json($foodItems);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $dropdownKey = function ($query) {
            return $query->id;
        };
        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown(
            null,
            $dropdownKey,
            ['type' => 'finish-food', 'status' => 'active'],
            true
        );
        return view('cafeteria::finish-food.create', compact('rawMaterials'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        foreach ($data['finish-food-entries'] as $value) {
            $item['reference_table'] = Config::get('constants.cafeteria.reference_table.finish-foods');
            $item['reference_table_id'] = self::EMPTY_VALUE;
            $item['status'] = Config::get('constants.cafeteria.status.added');
            $item['raw_material_id'] = $value['raw_material_id'];
            $item['quantity'] = $value['quantity'];

            $this->cafeteriaInventoryService->updateItemAmountInInventory($item);
        }

        return redirect()->route('finish-foods.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return redirect()->route('finish-foods.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('cafeteria::edit');
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
