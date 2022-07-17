<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\ComplaintInvitation;
use Modules\HRM\Http\Requests\ComplaintInvitationWorkflowRequest;
use Modules\HRM\Services\ComplaintInvitationService;
use Modules\HRM\Services\EmployeeService;

class ComplaintInvitationWorkflowController extends Controller
{
    private $employeeService;
    private $complaintInvitationService;

    /**
     * ComplaintInvitationWorkflowController constructor.
     * @param EmployeeService $employeeService
     * @param ComplaintInvitationService $complaintInvitationService
     */
    public function __construct(EmployeeService $employeeService, ComplaintInvitationService $complaintInvitationService)
    {
        $this->employeeService = $employeeService;
        $this->complaintInvitationService = $complaintInvitationService;
    }

    public function edit(ComplaintInvitation $complaintInvitation)
    {
        $employeeDropdown = $this->employeeService->findAll()
            ->filter(function ($employee) use ($complaintInvitation) {
                return !in_array($employee->id, [
                    $complaintInvitation->complainer_id,
                    $complaintInvitation->complainee->id,
                    $complaintInvitation->creator_id
                ]);
            })
            ->mapWithKeys($this->employeeService->empDefaultDropdown());

        $possibleTransitions = $complaintInvitation->stateMachine()->getPossibleTransitions();

        return view('hrm::complaint.invitation.workflow.edit', compact(
                'complaintInvitation',
                'employeeDropdown',
                'possibleTransitions'
            )
        );
    }

    public function update(ComplaintInvitationWorkflowRequest $request, ComplaintInvitation $complaintInvitation)
    {
        if ($this->complaintInvitationService->traverseWorkflow($request->all(), $complaintInvitation)) {
            Session::flash('success', trans('labels.update_success'));
            return redirect()->route('complaints.invitations.index');
        } else {
            Session::flash('error', trans('labels.update_fail'));
        }

        return redirect()->back();
    }
}
