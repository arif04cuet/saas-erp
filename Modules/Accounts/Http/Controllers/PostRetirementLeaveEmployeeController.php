<?php
namespace Modules\Accounts\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\EmployeeLumpSum;
use Modules\Accounts\Entities\PostRetirementLeaveEmployee;
use Modules\Accounts\Services\PostRetirementLeaveEmployeeService;
use Modules\HRM\Services\EmployeeService;

class PostRetirementLeaveEmployeeController extends Controller
{

    private $employeeService;
    private $service;

    public function __construct(
        EmployeeService $employeeService,
        PostRetirementLeaveEmployeeService $postRetirementLeaveEmployeeService
    ) {
        $this->employeeService = $employeeService;
        $this->service = $postRetirementLeaveEmployeeService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $employees = $this->service->getPRLEmployee();
        return view('accounts::prl.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $employees = $this->service->getRetiredEmployeesForDropdown();
        return view('accounts::prl.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // set the status flag
        if (isset($request->disbursed)) {
            unset($request['disbursed']);
            $request['status'] = PostRetirementLeaveEmployee::status[1];
        } else {
            $request['status'] = PostRetirementLeaveEmployee::status[0];
        }
        $postRetirementLeaveEmployee = PostRetirementLeaveEmployee::updateOrCreate(
            ['employee_id' => $request->employee_id],
            $request->all());
        if ($postRetirementLeaveEmployee) {
            Session::flash('success', trans('labels.save_success'));
            return redirect()->route('prl.index');
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        return view('accounts::show');
    }

    /**
     * Return  the specified resource in JSon.
     *
     * @param  int  $id
     *
     * @return Model
     */
    public function jsonShow($id)
    {
        return $this->service->findBy(['employee_id' => $id])->first();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        return view('accounts::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int      $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function markAsDisbursed($id)
    {
        $prlEmployee = $this->service->findOne($id);
        if ($prlEmployee->update(['status' => PostRetirementLeaveEmployee::status[1]])) {
            return redirect()->route('prl.index')->with('success', trans('labels.update_success'));
        } else {
            return redirect()->route('prl.index')->with('success', trans('labels.update_success'));
        }
    }
}
