<?php

namespace Modules\HRM\Http\Controllers;

use App\Services\UserService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\LeaveRequest;
use Modules\HRM\Http\Requests\EmployeeLeaveWorkflowCreateUpdateRequest;
use Modules\HRM\Services\LeaveRequestService;
use Modules\HRM\Services\LeaveService\LeaveCalculatorFactory;

class EmployeeLeaveWorkflowController extends Controller
{
    private $userService;
    private $leaveRequestService;

    public function __construct(
        UserService $userService,
        LeaveRequestService $leaveRequestService
    ) {
        $this->userService = $userService;
        $this->leaveRequestService = $leaveRequestService;
    }

    /**
     * @param EmployeeLeaveWorkflowCreateUpdateRequest $employeeLeaveWorkflowCreateUpdateRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EmployeeLeaveWorkflowCreateUpdateRequest $employeeLeaveWorkflowCreateUpdateRequest)
    {
        $isTraversed = $this->leaveRequestService->traverseWorkflow($employeeLeaveWorkflowCreateUpdateRequest->all());

        if ($isTraversed) {
            $message = trans('ims::workflow.event.messages.success');
            if (Session::has('success')) {
                $message = Session::get('success');
            }
            Session::flash('success', $message);
        } else {
            Session::flash('error', trans('ims::workflow.event.messages.error'));
        }

        return redirect()->route('hrm-dashboard');
    }

    /**
     * @param LeaveRequest $leaveRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(LeaveRequest $leaveRequest)
    {
        $users = $leaveRequest->getNextStatePossibleRecipients();

        $users = $users->filter(function ($userName, $userId) use ($leaveRequest) {
            return $leaveRequest->requester_id != $userId;
        });
        $users = $this->leaveRequestService->getRecipientsDropDownList($users);

        $possibleTransitions = $leaveRequest->getStateOwnerTransition();
        $possibleTransitions =  $this->leaveRequestService->checkIfCasualLeaveOrNot($possibleTransitions, $leaveRequest);

        $calculator = LeaveCalculatorFactory::makeCalculator($leaveRequest);

        $availableLeaveDays = $calculator->getAvailableLeaveDays();

        $canApprove = $calculator->isValidRequest();

        $leaveCalculationConfig = $calculator->getLeaveConfig();
        return view(
            'hrm::leave.workflow.form.leave-application-workflow',
            compact(
                'users',
                'possibleTransitions',
                'leaveRequest',
                'availableLeaveDays',
                'leaveCalculationConfig',
                'canApprove'
            )
        );
    }
}
