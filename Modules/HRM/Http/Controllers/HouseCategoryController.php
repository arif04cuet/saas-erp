<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HRM\Services\HouseCategoryService;
use Modules\HRM\Http\Requests\HouseCategoryRequest;

class HouseCategoryController extends Controller
{
    /**
     * @var $houseCategoryService
     */

    private $houseCategoryService;

    /**
     * @param HouseCategoryService $houseCategoryService
     */
    

    public function __construct(HouseCategoryService $houseCategoryService)
    {
        $this->houseCategoryService = $houseCategoryService;   
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categories = $this->houseCategoryService->findAll();

        return view('hrm::house-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = "create";

        return view('hrm::house-category.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(HouseCategoryRequest $request)
    {
        $this->houseCategoryService->save($request->all());

        return redirect()->route('house-categories.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('hrm::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->houseCategoryService->findOrFail($id);
        $page = "edit";

        return view('hrm::house-category.create', compact('page', 'category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(HouseCategoryRequest $request, $id)
    {
        $this->houseCategoryService->findOrFail($id)->update($request->all());

        return redirect()->route('house-categories.index')->with('success', __('labels.update_success'));
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
