<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HRM\Constants\LeaveTypes;
use Modules\HRM\Services\EmployeeService;
use Modules\HRM\Services\LeaveCalculationService;
use Modules\HRM\Services\LeaveRequestService;
use Modules\HRM\Services\LeaveTypeService;

class LeaveBalanceController extends Controller
{
    /**
     * @var LeaveCalculationService
     */
    private $leaveCalculationService;
    /**
     * @var EmployeeService
     */
    private $employeeService;
    /**
     * @var LeaveTypeService
     */
    private $leaveTypeService;

    /**
     * @var LeaveRequestService
     */
    private $leaveRequestService;

    /**
     * LeaveBalanceController constructor.
     * @param LeaveCalculationService $leaveCalculationService
     * @param LeaveTypeService $leaveTypeService
     * @param EmployeeService $employeeService
     * @param LeaveRequestService $leaveRequestService
     */
    public function __construct(
        LeaveCalculationService $leaveCalculationService,
        LeaveTypeService $leaveTypeService,
        EmployeeService $employeeService,
        LeaveRequestService $leaveRequestService
    ) {
        $this->leaveCalculationService = $leaveCalculationService;
        $this->employeeService = $employeeService;
        $this->leaveTypeService = $leaveTypeService;
        $this->leaveRequestService = $leaveRequestService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (Auth::user()->can('hrm-user-access')) {
            $employees = $this->employeeService->findAll()->sortBy(function ($item) {
                return $item->designation ? $item->designation->hierarchy_level : 100;
            });
        } else {
            $employees = $this->employeeService->findBy(['id' => optional(Auth::user()->employee)->id ?? 0]);
        }

        $balances = [];
        $casualLeaveTypeId = $this->leaveTypeService->findBy(['name' => LeaveTypes::CasualLeave])->first();

        foreach ($employees as $employee) {
            $joiningDate = optional($employee->employeePersonalInfo)->job_joining_date ?? null;
            if (!is_null($joiningDate)) {
                $casualLeaveBalance = $this->leaveCalculationService->getLeaveBalanceByType(
                    $casualLeaveTypeId->id,
                    $employee->id
                );
            } else {
                continue;
            }

            $balances[] = [
                'employeeId' => $employee->id,
                'name' => $employee->getName(),
                'designation' => optional($employee->designation)->getName() ?? "-",
                'joiningDate' => $joiningDate,
                'casualLeaveBalance' => $casualLeaveBalance ?? ""
            ];
        }
        //dd($balances);
        return view('hrm::leave.balance.index', compact('balances'));
    }

    /**
     * Show the specified resource.
     * @param $employeeId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($employeeId)
    {
        $employee = $this->employeeService->findOne($employeeId);
        $leaveTypes = $this->leaveTypeService->findAll()->filter(function ($item) {
            return $item->is_parent;
        });

        $leaveTypes = $this->leaveTypeService->findAll()->filter($this->leaveTypeService->ignoreMaternityLeaveForMale());
        $leaveBalances = [];
        foreach ($leaveTypes as $leaveType) {
            $calculateConsumed = $this->leaveRequestService->getConsumedLeave($leaveType->id, $employeeId);
            $calculateExtraLeave = $this->leaveRequestService->getEmployeeExtraLeaveByType($leaveType->id, $employeeId);
            $balance = $this->leaveCalculationService->getLeaveBalanceByType($leaveType->id, $employee->user->id);
            $leaveBalances[] = [
                'type_id' => $leaveType->id,
                'leave_type_name' => $leaveType->name,
                'balance' => $balance,
                'amount' => $leaveType->amount,
                'consumed_leave' => $calculateConsumed,
                'extra_leave' => $calculateExtraLeave
            ];
        }


        $leaveBalances =  $this->leaveRequestService->deductFromMotherType($leaveTypes, $leaveBalances);
        return view('hrm::leave.balance.show', compact('employee', 'leaveBalances'));
    }
}
