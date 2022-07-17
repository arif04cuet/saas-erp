<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Accounts\Entities\EmployeeAdvancePayment;
use Modules\Accounts\Services\EmployeeAdvancePaymentService;
use Modules\Accounts\Services\FiscalYearService;
use Modules\HRM\Services\EmployeeService;

class EmployeeAdvancePaymentController extends Controller
{
    /**
     * @var EmployeeAdvancePaymentService
     */
    private $employeeAdvancePaymentService;

    public function __construct(
        EmployeeAdvancePaymentService $employeeAdvancePaymentService
    ) {
        $this->employeeAdvancePaymentService = $employeeAdvancePaymentService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        $advancePayments = $this->employeeAdvancePaymentService->getEmployeeAdvancePaymentsSummary();
        return view('accounts::advance-payment.index', compact('advancePayments'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('accounts::advance-payment.create');
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
     * @param $employee_id
     * @return Factory|View
     */
    public function show($advancePaymnentId)
    {
        $advancePayments = $this->employeeAdvancePaymentService->getDataByEmployee($advancePaymnentId);
        return view('accounts::advance-payment.show', compact('advancePayments'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('accounts::edit');
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
