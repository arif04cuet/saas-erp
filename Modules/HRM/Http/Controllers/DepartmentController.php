<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Http\Requests\StoreDepartmentRequest;
use Modules\HRM\Services\DepartmentService;
use Modules\HRM\Services\EmployeeService;

class DepartmentController extends Controller {

	protected $departmentService;
	private $employeeService;

	public function __construct(DepartmentService $departmentService, EmployeeService $employeeService ) {
	    $this->employeeService = $employeeService;
		$this->departmentService = $departmentService;
	}

	public function index() {
		$departmentList = $this->departmentService->getDepartmentList();

		return view( 'hrm::department.index', compact( 'departmentList' ) );
	}


	public function create() {
        $employees = $this->employeeService->getEmployeesForDropdown();
		return view( 'hrm::department.create', compact('employees') );
	}


	public function store( StoreDepartmentRequest $request ) {
		$response = $this->departmentService->storeDepartment( $request->all() );
		Session::flash( 'message', $response->getContent() );

		return redirect()->route( 'department.index' );

	}


	public function show( $id ) {
		$department = $this->departmentService->getDepartmentById( $id );
        $departmentHead = $this->employeeService->getDivisionalDirectorByDepartmentId($id);

		return view( 'hrm::department.show', compact( 'department', 'departmentHead' ) );
	}


	public function edit( $id ) {
		$department = $this->departmentService->getDepartmentById( $id );
        $employees = $this->employeeService->getEmployeesForDropdown();
        $departmentHead = $this->employeeService->getDivisionalDirectorByDepartmentId($id);
        $departmentHeadId = (!is_null($departmentHead))? $departmentHead->id : null;
		return view( 'hrm::department.edit', compact( 'department', 'employees', 'departmentHeadId') );

	}


	public function update( StoreDepartmentRequest $request, $id ) {
		$response = $this->departmentService->updateDepartment( $request->all(), $id );
		Session::flash( 'message', $response->getContent() );

		return redirect()->route( 'department.edit', $response->getId() );
	}

	public function destroy($id) {
		$response = $this->departmentService->deleteDepartment($id);
		Session::flash( 'message', $response->getContent() );

		return redirect()->route( 'department.index' );

	}
}
