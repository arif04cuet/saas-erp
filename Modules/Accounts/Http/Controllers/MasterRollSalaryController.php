<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Services\MasterRollEmployeeService;
use Modules\Accounts\Services\MasterRollSalaryService;

class MasterRollSalaryController extends Controller
{
    private $masterRollSalaryService;
    private $masterRollEmployeeService;

    public function __construct(
        MasterRollSalaryService $masterRollSalaryService,
        MasterRollEmployeeService $masterRollEmployeeService
    )
    {
        $this->masterRollSalaryService = $masterRollSalaryService;
        $this->masterRollEmployeeService = $masterRollEmployeeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $masterRollSalaries = $this->masterRollSalaryService->findAll();

        return view('accounts::payroll.master-roll.salary.index', compact('masterRollSalaries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $masterRollEmployees = $this->masterRollEmployeeService->findAll();
        $count = 0;
        $masterRollEmployees->each(function ($e) use (&$count) {
            if ($e->payment_per_day == 0) {
                $count++;
            }
        });
        if ($count) {
            Session::flash('error', 'Contract Value Not Checked For ' . $count . ' Employees');
        }
        return view('accounts::payroll.master-roll.salary.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if ($this->masterRollSalaryService->saveData($request->all())) {
            Session::flash('success', trans('labels.save_success'));
            return redirect()->route('master-roll.salary.index');
        } else {
            if (!Session::has('error'))
                Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('master-roll.salary.index');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('accounts::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('accounts::edit');
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
