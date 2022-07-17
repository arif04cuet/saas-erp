<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HRM\Services\EmployeeService;
use Modules\Cafeteria\Services\RawMaterialService;
use Modules\Cafeteria\Services\SalesService;
use Modules\TMS\Services\TrainingsService;

class SalesController extends Controller
{
    /**
     * @var $rawMaterialService;
     * @var $trainingService;
     * @var $employeeService;
     * @var $salesService;
     */
    private $rawMaterialService;
    private $employeeService;
    private $trainingsService;
    private $salesService;

    /**
     * @param RawMaterialService $rawMaterialService ;
     * @param EmployeeService $employeeService ;
     * @param TrainingsService $trainingsService
     * @param SalesService $salesService ;
     */

    public function __construct(
        RawMaterialService $rawMaterialService,
        EmployeeService $employeeService,
        TrainingsService $trainingsService,
        SalesService $salesService
    ) {
        $this->rawMaterialService = $rawMaterialService;
        $this->employeeService = $employeeService;
        $this->trainingsService = $trainingsService;
        $this->salesService = $salesService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $sales = $this->salesService->findAll(null, null, ['column' => 'id', 'direction' => 'DESC']);

        return view('cafeteria::sales.index', compact('sales'));
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
            ['type' => 'finish-food', 'status' => 'active'],
            true
        );
        $page = "create";
        return view('cafeteria::sales.create', compact('page', 'rawMaterials'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->salesService->storeSalesData($request->all(), 'sales');

        return redirect()->route('sales.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $sales = $this->salesService->findOne($id);

        return view('cafeteria::sales.show', compact('sales'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $sales = $this->salesService->findOrFail($id);
        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown(
            null,
            null,
            ['type' => 'finish-food', 'status' => 'active'],
            true
        );
        $page = "edit";

        return view('cafeteria::sales.create', compact('sales', 'rawMaterials', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->salesService->updateSalesData($request->all(), $id);

        return redirect()->route('sales.index')->with('success', __('labels.save_success'));
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

    public function getBillToData(Request $request)
    {
        if ($request->type == "training") {

            $trainings = $this->trainingsService->getTrainingsForDropdown();

            return response()->json($trainings);

        } else {

            $employees = $this->employeeService->getEmployeesForDropdown();

            return response()->json($employees);
        }
    }

    public function getEmployeeSalaryGrade($id)
    {
        $employee = $this->employeeService->findOne($id);

        $grade = $employee->getEmployeeSalaryGrade();

        return $grade;
    }
}
