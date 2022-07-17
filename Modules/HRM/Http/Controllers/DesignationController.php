<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Http\Requests\StoreUpdateDesignatonRequest;
use Modules\HRM\Services\DesignationService;

class DesignationController extends Controller
{
	protected $designationService;

	public function __construct(DesignationService $designationService)
	{
		$this->designationService = $designationService;
	}
	public function index()
	{
		$designationList = $this->designationService->getDesignationList();

		return view('hrm::designation.index', compact('designationList'));
	}


	public function create()
	{
		return view('hrm::designation.create');
	}


	public function store(StoreUpdateDesignatonRequest $request)
	{
		$response = $this->designationService->storeDesignation($request->all());
		Session::flash('message', $response->getContent());
		return redirect()->route('designation.index');
	}

	public function show($id)
	{
		$designation = $this->designationService->findOrFail($id);
		return view('hrm::designation.show', compact('designation'));
	}

	public function edit($id)
	{
		$designation = $this->designationService->findOrFail($id);

		return view('hrm::designation.edit', compact('designation'));
	}

	public function update(StoreUpdateDesignatonRequest $request, $id)
	{
		$response = $this->designationService->updateDepartment($request->all(), $id);
		Session::flash('message', $response->getContent());

		return redirect()->route('designation.index');
	}


	public function destroy($id)
	{
		$response = $this->designationService->deleteDepartment($id);
		Session::flash('message', $response->getContent());

		return redirect()->route('designation.index');
	}
}
