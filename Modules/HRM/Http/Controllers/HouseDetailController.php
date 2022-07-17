<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HRM\Services\HouseDetailService;
use Modules\HRM\Services\HouseCategoryService;
use Modules\HRM\Http\Requests\HouseDetailRequest;
use Modules\HRM\Services\EmployeeService;
use Modules\HRM\Services\HouseHistoryService;

class HouseDetailController extends Controller
{

    /**
     * @var HouseDetailService
     */

    private $houseDetailService;

    /**
     * @var HouseCategoryService
     */

    private $houseCategoryService;

    /**
     * @var EmployeeService
     */

    private $employeeService;

    /**
     * @var HouseHistoryService
     */

    private $houseHistoryService;

    /**
     * @param HouseDetailService $houseDetailService
     * @param HouseCategoryService $houseCategoryService
     * @param EmployeeService $employeeService
     * @param HouseHistoryService $historyService
     */

    public function __construct(
        HouseDetailService $houseDetailService,
        HouseCategoryService $houseCategoryService,
        EmployeeService $employeeService,
        HouseHistoryService $historyService
    ) {
        $this->houseDetailService = $houseDetailService;
        $this->houseCategoryService = $houseCategoryService;
        $this->employeeService = $employeeService;
        $this->houseHistoryService = $historyService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $houses = $this->houseDetailService->findAll();
        $houseCategories = $this->houseCategoryService->getHouseCategoryForDropdown();
        return view('hrm::house-details.index', compact('houses', 'houseCategories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $houseCategories = $this->houseCategoryService->getHouseCategoryForDropdown();
        $employees = $this->employeeService->getEmployeesForDropdown();
        $page = "create";

        return view('hrm::house-details.create', compact('page', 'houseCategories', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(HouseDetailRequest $request)
    {
        if ($request->allocated_to) {
            $alreadyAllocated = $this->houseDetailService->findBy(['allocated_to' => $request->allocated_to])->first();
            if ($alreadyAllocated) {
                return redirect()->route('house-details.index')->with('error', __('hrm::house-details.already_allocated', ['house' => $alreadyAllocated->house_id]));
            }
        }

        $houseData = $this->houseDetailService->save($request->all());

        $this->houseHistoryService->storeHistory($houseData);

        return redirect()->route('house-details.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $house = $this->houseDetailService->findOrFail($id);

        return view('hrm::house-details.show', compact('house'));
    }

    public function history($id)
    {
        $house = $this->houseDetailService->findOrFail($id);

        return view('hrm::house-details.history', compact('house'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $houseCategories = $this->houseCategoryService->getHouseCategoryForDropdown();
        $employees = $this->employeeService->getEmployeesForDropdown();
        $house = $this->houseDetailService->findOrFail($id);

        $page = "edit";
        return view('hrm::house-details.create', compact('house', 'houseCategories', 'page', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(HouseDetailRequest $request, $id)
    {
        $houseData = $this->houseDetailService->findOrFail($id);

        if ($request->allocated_to) {
            $alreadyAllocated = $this->houseDetailService->findBy(['allocated_to' => $request->allocated_to])->first();
            if ($alreadyAllocated && $request->allocated_to != $houseData->allocated_to) {
                return redirect()->route('house-details.index')->with('error', __('hrm::house-details.already_allocated', ['house' => $alreadyAllocated->house_id]));
            }
        }

        $houseData->update($request->all());

        $this->houseHistoryService->storeHistory($houseData);

        return redirect()->route('house-details.index')->with('success', __('labels.update_success'));
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

    public function getHouseByType(Request $request)
    {
        $houses = $this->houseDetailService->findBy(['house_type' => $request->typeId]);

        return response()->json($houses);
    }
}
