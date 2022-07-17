<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cafeteria\Services\UnitService;
use Modules\Cafeteria\Http\Requests\UnitRequest;

class UnitController extends Controller
{

    private $unitService;

    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $units = $this->unitService->findAll();
        return view('cafeteria::unit.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $page = "create";
        return view('cafeteria::unit.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(UnitRequest $request)
    {
        $this->unitService->save($request->all());

        return redirect()->route('units.index')->with('success', __('labels.save_success'));  

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
        $unit = $this->unitService->findOrFail($id);
        $page = "edit";

        return view('cafeteria::unit.create', compact('unit', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UnitRequest $request, $id)
    {
        $this->unitService->findOrFail($id)->update($request->all());

        return redirect()->route('units.index')->with('success', __('labels.update_success'));  
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->unitService->findOrFail($id)->delete();

        return redirect()->route('units.index')->with('success', __('labels.delete_success'));  
    }
}
