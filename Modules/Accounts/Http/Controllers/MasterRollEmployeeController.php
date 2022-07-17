<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Modules\Accounts\Entities\MasterRollEmployee;
use Modules\Accounts\Entities\MasterRollSalary;
use Modules\Accounts\Services\MasterRollEmployeeService;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Services\EmployeeService;

class MasterRollEmployeeController extends Controller
{
    /**
     * @var MasterRollEmployeeService
     */
    private $masterRollEmployeeService;
    /**
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * MasterRollEmployeeController constructor.
     * @param MasterRollEmployeeService $masterRollEmployeeService
     * @param EmployeeService $employeeService
     */
    public function __construct(
        MasterRollEmployeeService $masterRollEmployeeService,
        EmployeeService $employeeService
    ) {
        $this->masterRollEmployeeService = $masterRollEmployeeService;
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        $employees = $this->employeeService->getMasterRollEmployees();
        return view('accounts::payroll.master-roll.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View
     */
    public function create()
    {
        return view('accounts::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if ($this->masterRollEmployeeService->saveData($request->all())) {
            Session::flash('success', trans('labels.save_success'));
            return redirect()->route('master-roll.employee.index');
        } else {
            if (!Session::has('error')) {
                Session::flash('error', trans('labels.save_fail'));
            }
            return redirect()->route('master-roll.employee.index');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Factory|View
     */
    public function show($id)
    {
        return view('accounts::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        return view('accounts::edit');
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }

    public function loadEmployee(Request $request)
    {
        $employeeIds = MasterRollSalary::all()
            ->where('period_from', '>=', $request->period_from)
            ->where('period_to', '>=', $request->period_to)
            ->pluck('employee_id');
        $employees = MasterRollEmployee::whereNotIn('employee_id', $employeeIds->toArray())->get();

        $employee = $employees->map(function ($e) {
            return $e->employee;
        })->each(function ($e) {
            return $e->payment_per_day = $e->masterRoll->payment_per_day ?? 0;
        });
        return $employee;
    }
}
