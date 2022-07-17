<?php

namespace Modules\Cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Cafeteria\Services\CafeteriaFoodOrderService;
use Modules\Cafeteria\Services\RawMaterialService;
use Modules\HRM\Services\EmployeeService;
use Modules\TMS\Services\TrainingsService;

class CafeteriaFoodOrderController extends Controller
{

    private $rawMaterialService;
    private $employeeService;
    private $trainingsService;
    private $cafeteriaFoodOrderService;

    public function __construct(
        RawMaterialService $rawMaterialService,
        EmployeeService $employeeService,
        TrainingsService $trainingsService,
        CafeteriaFoodOrderService $cafeteriaFoodOrderService
    )
    {
        $this->rawMaterialService = $rawMaterialService;
        $this->employeeService = $employeeService;
        $this->trainingsService = $trainingsService;
        $this->cafeteriaFoodOrderService = $cafeteriaFoodOrderService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $foodOrders = $this->cafeteriaFoodOrderService->getFilterFoodOrderData();

        return view('cafeteria::food-order.index', compact('foodOrders'));
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

        return view('cafeteria::food-order.create', compact('rawMaterials', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->cafeteriaFoodOrderService->storeOrdersData($request->all());

        return redirect()->route('food-orders.index')->with('success', __('labels.save_success'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $foodOrders = $this->cafeteriaFoodOrderService->findOne($id);

       // return $foodOrders->foodOrderItems;

        return view('cafeteria::food-order.show', compact('foodOrders'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $foodOrderItem = $this->cafeteriaFoodOrderService->findOne($id);

        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown(
            null,
            null,
            ['type' => 'finish-food', 'status' => 'active'],
            true
        );
        $units = [];
        $page = "edit";

        return view('cafeteria::food-order.create', compact('foodOrderItem', 'page', 'rawMaterials', 'units'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->cafeteriaFoodOrderService->updateOrderList($request->all(), $id);

        return redirect()->route('food-orders.index')->with('success', __('labels.save_success'));

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

    public function approvalForm($id)
    {
        $foodOrderItem = $this->cafeteriaFoodOrderService->findOne($id);

        $rawMaterials = $this->rawMaterialService->getRawMaterialsForDropdown(
            null,
            null,
            ['type' => 'finish-food', 'status' => 'active'],
            true
        );

        $page = "approval";

        return view('cafeteria::food-order.approval.create', compact(
            'foodOrderItem',
            'rawMaterials',
            'page'
        ));
    }

    public function approvePurchaseList(Request $request, $id)
    {
        $this->cafeteriaFoodOrderService->approveOrderList($request->all(), $id);

        return redirect()->route('food-orders.index')->with('success', __('labels.update_success'));
    }

}
