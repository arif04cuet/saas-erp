<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Http\Requests\StoreEmployeeSpouseChildrenRequest;
use Modules\HRM\Http\Requests\UpdateEmployeeSpouseChildrenRequest;
use Modules\HRM\Services\EmployeeSpouseChildrenService;

class EmployeeSpouseChildrenController extends Controller
{
    private $employeeSpouseChildrenService;

    public function __construct(
        EmployeeSpouseChildrenService $employeeSpouseChildrenService
    )
    {
        $this->employeeSpouseChildrenService = $employeeSpouseChildrenService;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreEmployeeSpouseChildrenRequest $request)
    {
        $response = $this->employeeSpouseChildrenService->store();
    }

    /**
     * @param UpdateEmployeeSpouseChildrenRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEmployeeSpouseChildrenRequest $request, $id)
    {
        $response = $this->employeeSpouseChildrenService->update($request->all(), $id);

        Session::flash('message', $response->getContent());

        $employee_id = !is_null($response->getId()) ? $response->getId() : $request->employee_id;

        return redirect()->route('employee.edit', ['employee' => $employee_id, '#education']);
    }
}
