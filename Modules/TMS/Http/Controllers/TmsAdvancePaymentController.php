<?php

namespace Modules\TMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\TMS\Services\TmsAdvancePaymentService;

class TmsAdvancePaymentController extends Controller
{

    /**
     * @var TmsAdvancePaymentService
     */
    private $tmsAdvancePaymentService;

    public function __construct(TmsAdvancePaymentService $tmsAdvancePaymentService)
    {
        $this->tmsAdvancePaymentService = $tmsAdvancePaymentService;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $tmsAdvancePayments = $this->tmsAdvancePaymentService->getEmployeeAdvancePaymentsSummary();
        return view('tms::accounts.advance-payment.index', compact('tmsAdvancePayments'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('tms::accounts.advance-payment.create');
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
     * @return Factory|Application|View
     */
    public function show($id)
    {
        $tmsAdvancePayments = $this->tmsAdvancePaymentService->getDataByEmployee($id);
        return view('tms::accounts.advance-payment.show', compact('tmsAdvancePayments'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('tms::edit');
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
