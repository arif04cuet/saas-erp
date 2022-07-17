<?php

namespace Modules\HRM\Http\Controllers;

use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\Complaint;
use Modules\HRM\Entities\ComplaintInvitation;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Http\Requests\StoreComplaintRequest;
use Modules\HRM\Services\ComplaintService;
use Modules\HRM\Services\EmployeeService;

class ComplaintController extends Controller
{

    /**
     * @var ComplaintService
     */
    private $complaintService;
    /**
     * @var EmployeeService
     */
    private $employeeService;

    public function __construct(ComplaintService $complaintService, EmployeeService $employeeService)
    {
        /** @var ComplaintService $complaintService */
        $this->complaintService = $complaintService;
        /** @var EmployeeService $employeeService */
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $complaints = $this->complaintService->getVisibleComplaints();

        return view('hrm::complaint.index', compact('complaints'));
    }

    /**
     * @param ComplaintInvitation $complaintInvitation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(ComplaintInvitation $complaintInvitation)
    {
        $employees = $this->complaintService->getEmpSelectOptions();

        if (!is_null($complaintInvitation->status) && $complaintInvitation->status != 'approved') {
            abort(403);
        }

        $complainer_id = Auth::user()->id;
        return view(
            'hrm::complaint.create',
            compact(
                'employees',
                'complainer_id',
                'complaintInvitation'
            )
        );
    }

    /**
     * @param StoreComplaintRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreComplaintRequest $request)
    {
        $department_id = Employee::findOrFail($request->complainer_id)->department_id;
        $is_divisional_director = $this->employeeService->getDivisionalDirectorByDepartmentId($department_id);

        if (!empty($is_divisional_director)) {
            if ($this->complaintService->storeComplaint($request->all())) {
                Session::flash('success', trans('labels.save_success'));
                return redirect()->route('complaint.index');
            } else {
                Session::flash('error', trans('labels.save_fail'));
            }
        } else {
            Session::flash('error', trans('labels.no_divisional_director'));
        }
        return redirect()->back();
    }

    /**
     * @param Complaint $complaint
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Complaint $complaint)
    {
        return view('hrm::complaint.show', compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('hrm::edit');
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
