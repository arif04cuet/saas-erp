<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HRM\Services\AppraisalService;
use Modules\HRM\Services\ComplaintInvitationService;
use Modules\HRM\Services\ComplaintService;
use Modules\HRM\Services\EmployeeService;
use Modules\HRM\Services\LeaveRequestService;

class HRMController extends Controller
{
    private $employeeService;
    private $leaveRequestService;
    private $complaintInvitationService;
    private $complaintService;
    private $appraisalService;

    public function __construct(
        EmployeeService $employeeServices,
        LeaveRequestService $leaveRequestService,
        ComplaintInvitationService $complaintInvitationService,
        ComplaintService $complaintService,
        AppraisalService $appraisalService
    )
    {
        $this->employeeService = $employeeServices;
        $this->leaveRequestService = $leaveRequestService;
        $this->complaintInvitationService = $complaintInvitationService;
        $this->complaintService = $complaintService;
        $this->appraisalService = $appraisalService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     * @return Response
     */
    public function index()
    {
        $leaveRequests = $this->leaveRequestService->dashboardActivities();
        $complaintInvitations = $this->complaintInvitationService->dashboardActivities();
        $complaints = $this->complaintService->dashboardActivities();
        $appraisals = $this->appraisalService->dashboardActivities();

        return view(
            'hrm::index',
            compact(
                'leaveRequests',
                'complaintInvitations',
                'complaints',
                'appraisals'
            )
        );

    }

    public function show()
    {
        // Test
        return $this->employeeService->getEmployeeListForBardReference();
    }
}
