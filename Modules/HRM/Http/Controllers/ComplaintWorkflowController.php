<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\Complaint;
use Modules\HRM\Services\EmployeeService;

class ComplaintWorkflowController extends Controller
{

    /**
     * @var EmployeeService
     */
    private $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        /** @var EmployeeService $employeeService */
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('hrm::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('hrm::create');
    }



    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    /*public function show(Complaint $complaint)
    {
        $employeeDropdown = $this->employeeService->findAll()
            ->filter(function ($employee) use ($complaint) {
                return $employee->id != Auth::user()->employee->id AND $employee->employeeDepartment->department_code == 'ADMIN';
            })
            ->mapWithKeys(function ($employee) {
                return [$employee->id => $employee->getName(). " - " . $employee->getDesignation()];
            });

        $possibleTransitions = $complaint->stateMachine()->getPossibleTransitions();
        return view('hrm::complaint.workflow.show', compact('complaint', 'employeeDropdown' ,'possibleTransitions'));
    }*/

    /**
     * @param Complaint $complaint
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    public function edit(Complaint $complaint)
    {
        $employeeDropdown = $this->employeeService->findAll()
            ->filter(function ($employee) use ($complaint) {
                return $employee->id != Auth::user()->employee->id AND $employee->employeeDepartment->department_code == 'ADMIN';
            })
            ->mapWithKeys($this->employeeService->empDefaultDropdown());

        $possibleTransitions = $complaint->stateMachine()->getPossibleTransitions();

        $canApproveOrReject = $this->canApproveOrReject();

        return view('hrm::complaint.workflow.edit', compact(
                'complaint',
                'employeeDropdown',
                'possibleTransitions',
                'canApproveOrReject'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Complaint $complaint
     * @return Response
     */
    public function update(Request $request, Complaint $complaint)
    {
        return DB::transaction(function () use ($complaint, $request) {

            if ($complaint->apply($request->input('transition'))) {
                $complaint->save();
                Session::flash('success', trans('labels.save_success'));
            } else {
                Session::flash('error', trans('labels.save_fail'));
            }

            return redirect()->route('hrm-dashboard');

        });
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

    /**
     * @return bool
     */
    public function canApproveOrReject(): bool
    {
        if (Auth::user()->employee->designation->short_name != \App\Constants\DesignationShortName::DA
            && !Auth::user()->employee->is_divisional_director == true) {
            return true;
        } else {
            return false;
        }
    }
}
