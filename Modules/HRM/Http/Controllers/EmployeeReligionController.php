<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\EmployeeReligion;
use Modules\HRM\Http\Requests\StoreEmployeeReligionRequest;
use Modules\HRM\Services\EmployeeReligionService;

class EmployeeReligionController extends Controller
{
    private $service;

    public function __construct(
        EmployeeReligionService $employeeReligionService
    )
    {
        $this->service = $employeeReligionService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $religions = $this->service->religions();

        return view(
            'hrm::religion.index',
            compact(
                'religions'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('hrm::religion.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreEmployeeReligionRequest $request)
    {
        if($this->service->store($request->all())) {
            Session::flash('success', trans('labels.save_success'));
            return redirect()->route('employees.religions.index');
        }else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->back();
        }

    }

    /**
     * @param EmployeeReligion $religion
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(EmployeeReligion $religion)
    {
        return view(
            'hrm::religion.show',
            compact('religion')
        );
    }

    /**
     * @param EmployeeReligion $religion
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(EmployeeReligion $religion)
    {
        return view(
            'hrm::religion.edit',
            compact('religion')
        );
    }

    /**
     * @param StoreEmployeeReligionRequest $request
     * @param EmployeeReligion $religion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreEmployeeReligionRequest $request, EmployeeReligion $religion)
    {
        if($this->service->update($religion, $request->all())) {
            Session::flash('success', trans('labels.update_success'));
            return redirect()->route('employees.religions.index');
        }else {
            Session::flash('error', trans('labels.update_fail'));
            return redirect()->back();
        }
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
