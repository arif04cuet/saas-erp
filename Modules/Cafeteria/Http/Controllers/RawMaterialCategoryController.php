<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cafeteria\Services\RawMaterialCategoryService;

class RawMaterialCategoryController extends Controller
{
    /**
     * @var $rawMaterialCategoryService
     */

    private $rawMaterialCategoryService;

    /**
     * @param RawMaterialCategoryService $rawMaterialCategoryService 
     */

    public function __construct(RawMaterialCategoryService $rawMaterialCategoryService)
    {
        $this->rawMaterialCategoryService = $rawMaterialCategoryService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categories = $this->rawMaterialCategoryService->findAll(
            null, 
            null, 
            ['column' => 'id', 'direction' => 'desc']);

        return view('cafeteria::raw-material-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = "create";
        return view('cafeteria::raw-material-category.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->rawMaterialCategoryService->save($request->all());

        return redirect()->route('raw-material-categories.index')
                        ->with('success', __('labels.save_success'));
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
        $category = $this->rawMaterialCategoryService->findOrFail($id);
        $page = "edit";

        return view('cafeteria::raw-material-category.create', compact('category', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->rawMaterialCategoryService->findOrFail($id)->update($request->all());

        return redirect()->route('raw-material-categories.index')
                        ->with('success', __('labels.update_success'));
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
