<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HRM\Services\DesignationService;
use Modules\HRM\Services\HouseCategoryService;
use Modules\HRM\Services\HouseCircularService;
use Modules\HRM\Http\Requests\HouseCircularRequest;

class HouseCircularController extends Controller
{
    /**
     * @var $houseCategoryService
     */

    private $houseCategoryService;

    /**
     * @var $designationService
     */

    private $designationService;

    /**
     * @var $houseCircularService
     */

    private $houseCircularService;

    /**
     * @param HouseCategoryService $houseCategoryService
     * @param DesignationService $designationService
     * @param HouseCircularService $houseCircularService
     */

    public function __construct(
        HouseCategoryService $houseCategoryService,
        DesignationService $designationService,
        HouseCircularService $houseCircularService
    ) {
        $this->houseCategoryService = $houseCategoryService;
        $this->designationService = $designationService;
        $this->houseCircularService = $houseCircularService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $circulars = $this->houseCircularService->findAllCircular();
        
        return view('hrm::house-circular.index', compact('circulars'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = $this->houseCategoryService->getHouseCategoryForDropdown(null, null, null, true);
        $designations = $this->designationService->getDesignationsForDropdown();
        $page = "create";
        
        return view('hrm::house-circular.create', compact('page', 'categories', 'designations'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(HouseCircularRequest $request)
    {
        $this->houseCircularService->storeHouseCircular($request->all());

        return redirect()->route('house-circulars.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $circular = $this->houseCircularService->findOrFail($id);

        return view('hrm::house-circular.show', compact('circular'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $circular = $this->houseCircularService->findOrFail($id);
        $categories = $this->houseCategoryService->getHouseCategoryForDropdown(null, null, null, true);
        $designations = $this->designationService->getDesignationsForDropdown();
        $page = "edit";

        return view('hrm::house-circular.create', compact('circular', 'categories', 'designations', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(HouseCircularRequest $request, $id)
    {
        $this->houseCircularService->updateHouseCircular($request->all(), $id);

        return redirect()->route('house-circulars.index')->with('success', __('labels.update_success'));
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
