<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\ComplaintInvitation;
use Modules\HRM\Http\Requests\StoreComplaintInvitationRequest;
use Modules\HRM\Services\ComplaintInvitationService;
use Modules\HRM\Services\EmployeeService;

class ComplaintInvitationController extends Controller
{
    private $employeeService;
    private $complaintInvitationService;

    /**
     * ComplaintInvitationController constructor.
     * @param ComplaintInvitationService $complaintInvitationService
     * @param EmployeeService $employeeService
     */
    public function __construct(ComplaintInvitationService $complaintInvitationService, EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
        $this->complaintInvitationService = $complaintInvitationService;
    }

    public function index()
    {
        $complaintInvitations = $this->complaintInvitationService->getVisibleComplaintInvitations();

        return view('hrm::complaint.invitation.index', compact('complaintInvitations'));
    }

    public function create()
    {
        $employees = $this->employeeService->findAll()
            ->filter(function ($employee) {
                return $employee->id != Auth::user()->employee->id;
            })
            ->mapWithKeys($this->employeeService->empDefaultDropdown());

        return view('hrm::complaint.invitation.create', compact('employees'));
    }

    public function store(StoreComplaintInvitationRequest $request)
    {
        if ($this->complaintInvitationService->store($request->all())) {
            Session::flash('success', trans('labels.save_success'));
            return redirect()->route('complaints.invitations.index');
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->back();
    }

    public function show(ComplaintInvitation $complaintInvitation)
    {
        return view('hrm::complaint.invitation.show', compact('complaintInvitation'));
    }
}
