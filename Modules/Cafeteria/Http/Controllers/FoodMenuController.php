<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cafeteria\Services\FoodMenuService;
use Modules\Cafeteria\Services\RawMaterialService;

class FoodMenuController extends Controller
{
    private $rawMaterialService;
    private $foodMenuService;

    public function __construct(
        RawMaterialService $rawMaterialService,
        FoodMenuService $foodMenuService
    ) {
        $this->rawMaterialService = $rawMaterialService;
        $this->foodMenuService = $foodMenuService;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $foodMenus = $this->foodMenuService->findAll();
        return view('cafeteria::food-menu.index', compact('foodMenus'));
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
        $finishFoods = $this->rawMaterialService->getRawMaterialsForDropdown(
            null,
            $dropdownKey,
            ['type' => 'finish-food', 'status' => 'active'],
            false
        );
        $page = "create";
         return view('cafeteria::food-menu.create', compact('page', 'finishFoods'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->foodMenuService->saveFoodMenu($request->all());

        return redirect()->route('food-menus.index')->with('success', __('labels.save_success'));
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
        $foodMenu = $this->foodMenuService->findOrFail($id);
        $dropdownKey = function ($query) {
            return $query->id;
        };
        $finishFoods = $this->rawMaterialService->getRawMaterialsForDropdown(
            null,
            $dropdownKey,
            ['type' => 'finish-food', 'status' => 'active'],
            false
        );
        $page = "edit";
        return view('cafeteria::food-menu.create', compact('page', 'foodMenu', 'finishFoods'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->foodMenuService->updateFoodMenu($request->all(), $id);

        return redirect()->route('food-menus.index')->with('success', __('labels.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->foodMenuService->findOrFail($id)->delete();

        return redirect()->route('food-menus.index')->with('success', __('labels.delete_success'));
    }
}
