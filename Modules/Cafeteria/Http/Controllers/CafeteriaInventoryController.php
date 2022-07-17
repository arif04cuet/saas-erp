<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cafeteria\Services\CafeteriaInventoryService;
use Modules\Cafeteria\Services\CafeteriaInventoryTransactionService;
use Modules\Cafeteria\Services\RawMaterialCategoryService;

class CafeteriaInventoryController extends Controller
{
    private $cafeteriaInventoryService;
    private $cafeteriaInventoryTransactionService;
    private $rawMaterialCategoryService;

    public function __construct(
        CafeteriaInventoryService $cafeteriaInventoryService,
        CafeteriaInventoryTransactionService $cafeteriaInventoryTransactionService,
        RawMaterialCategoryService $rawMaterialCategoryService
    ) {
        $this->cafeteriaInventoryService = $cafeteriaInventoryService;
        $this->cafeteriaInventoryTransactionService = $cafeteriaInventoryTransactionService;
        $this->rawMaterialCategoryService = $rawMaterialCategoryService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $collection = $this->cafeteriaInventoryService->findAll();
        $categories = $this->rawMaterialCategoryService->getRawMaterialCategoryForDropDown();

        return view('cafeteria::cafeteria-inventory.index', compact('collection', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cafeteria::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $itemDetails = $this->cafeteriaInventoryService->findOrFail($id);
        $transactions = $this->cafeteriaInventoryTransactionService
                                ->findBy(
                                    ['cafeteria_inventory_id' => $id],
                                    null,
                                    ['column' => 'id', 'direction' => 'desc']
                                );

        return view('cafeteria::cafeteria-inventory.show', compact('itemDetails', 'transactions'));
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
