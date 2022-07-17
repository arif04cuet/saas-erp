<?php

namespace Modules\HM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('hm::bill.index');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function searchCheckIn()
    {
        return view('hm::bill.search_check_in');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('hm::bill.create');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function payment()
    {
        return view('hm::bill.payment');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function paymentList()
    {
        return view('hm::bill.payment_list');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        return view('hm::bill.show');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function showPaymentsOfCheckIn()
    {
        return view('hm::bill.show_payments_of_check_in');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('hm::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
    
}
