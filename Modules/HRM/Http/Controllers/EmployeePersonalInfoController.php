<?php

namespace Modules\HRM\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Http\Requests\StoreEmployeePersonalInfoRequest;
use Modules\HRM\Http\Requests\UpdateEmployeePersonalRequest;
use Modules\HRM\Services\EmployeePersonalInfoService;

class EmployeePersonalInfoController extends Controller
{
	private $employeePersonalInfoService;

	public function __construct(EmployeePersonalInfoService $employeePersonalInfoService)
	{
		$this->employeePersonalInfoService = $employeePersonalInfoService;
	}

	public function store(StoreEmployeePersonalInfoRequest $request)
	{
		$response = $this->employeePersonalInfoService->storePersonalInfo($request->all());
		Session::flash('message', $response->getContent());

		return redirect()->route('employee.create', ['employee' => $response->getId(), '#spouse-children']);
	}

	public function update(UpdateEmployeePersonalRequest $request, $id)
	{
		$response = $this->employeePersonalInfoService->updatePersonalInfo($request->all(), $id);
		Session::flash('message', $response->getContent());
		$employee_id = $response->getId();

		return redirect()->route('employee.edit', ['employee' => $response->getId(), '#spouse-children']);
	}
}
