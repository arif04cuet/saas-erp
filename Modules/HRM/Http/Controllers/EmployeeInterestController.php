<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Services\AreaOfInterestService;
use Modules\HRM\Services\EmployeeInterestService;

class EmployeeInterestController extends Controller
{
    /**
     * @var $employeeInterestService
     */

    private $employeeInterestService;

    /**
     * @param EmployeeInterestService $employeeInterestService
     */

    public function __construct(EmployeeInterestService $employeeInterestService)
    {
        $this->employeeInterestService = $employeeInterestService;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('hrm::create');
    }

    public function store(Request $request)
    {
        if (is_null($request->employee_id)) {
            Session::flash('error', trans('hrm::employee.employee_id_validation'));
            return redirect('/hrm/employee/create/#general');
        }
        $interestInfo = $request->all();
        $response = $this->employeeInterestService->storeAreaOfInterest($interestInfo);
        Session::flash('message', $response->getContent());
        $employee_id = $response->getId() ? $response->getId() : $request->employee_id;

        return redirect('/hrm/employee/' . $employee_id . '/#general');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $interestInfo = $request->all();
        $response = $this->employeeInterestService->updateAreaOfInterest($interestInfo, $id);
        Session::flash('message', $response->getContent());
        $employee_id = $response->getId() ? $response->getId() : $request->employee_id;

        return redirect('/hrm/employee/' . $employee_id . '/#general');

    }
}
