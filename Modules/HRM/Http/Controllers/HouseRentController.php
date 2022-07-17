<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class HouseRentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('hrm::house-rent.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('hrm::create');
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
    public function show()
    {
        return view('hrm::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('hrm::edit');
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

    /**
     * Handle the application for house Rent
     */
    public function applyForHouse()
    {
        return "HRM - HouseController -> Apply For House Function - Show the form  ";

    }

    /**
     * Approve / Disapprove Application of House Rent
     */

    public function approveHouseRent()
    {
        return "HRM - HouseController -> Approve/Disapprove Application for House Rent  ";
    }

    /**
     * Show all Houses for employees
     * Employees can apply for rent from here
     */

    public function showHouse()
    {
        return view('hrm::house-rent.apply_for_house_rent');
    }

    /**
     * Show employee House Rent Application Form
     */
    public function showApplyForm()
    {
        return view('hrm::house-rent.form_house_rent_apply');

    }

    /**
     * Show employee House Rent Application Form
     */
    public function showAllApplications()
    {
        return view('hrm::house-rent.house_rent_applications');

    }


}
