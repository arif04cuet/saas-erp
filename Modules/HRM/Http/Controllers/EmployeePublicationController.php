<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Http\Requests\StoreEmployeePublicationRequest;
use Modules\HRM\Http\Requests\UpdateEmployeePublicationRequest;
use Modules\HRM\Services\EmployeePublicationService;

class EmployeePublicationController extends Controller
{
    private $employeePublicationService;

    public function __construct(EmployeePublicationService $employeePublicationService)
    {
        $this->employeePublicationService = $employeePublicationService;
    }

    public function store(StoreEmployeePublicationRequest $request)
    {
        $publications = $request->publication;
        $response = $this->employeePublicationService->storePublicationInfo($publications);
        Session::flash('message', $response->getContent());
        return redirect()->route('employee.create', ['employee' => $response->getId(), '#research']);

    }

    public function update(UpdateEmployeePublicationRequest $request, $id)
    {
        $publications = $request->publication;

        $response = $this->employeePublicationService->updatePublicationInfo($publications, $id);
        Session::flash('message', $response->getContent());
        $employee_id = $response->getId();

        return redirect('/hrm/employee/' . $employee_id . '/#publication');
    }
}
