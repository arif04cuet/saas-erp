<?php

/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 6/24/19
 * Time: 5:30 PM
 */

namespace Modules\HRM\Services;

use App\Constants\DepartmentShortName;
use App\Constants\DesignationShortName;
use App\Entities\User;
use App\Services\RoleService;
use App\Services\UserService;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Services\PayscaleService;
use Modules\Accounts\Services\PostRetirementLeaveEmployeeService;
use Modules\HRM\Entities\LeaveType;
use Modules\HRM\Repositories\LeaveTypeRepository;
use function foo\func;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Constants\LeaveTypes;
use Modules\HRM\Entities\LeaveRequest;
use Modules\HRM\Entities\LeaveRequestAttachment;
use Modules\HRM\Repositories\LeaveRequestRepository;
use Modules\HRM\Services\LeaveService\LeaveCalculatorFactory;

class LeaveRequestService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var LeaveRequestRepository
     */
    private $leaveRequestRepository;
    /**
     * @var EmployeeService
     */
    private $employeeService;

    private $leaveTypeRepository;
    /**
     * @var PostRetirementLeaveEmployeeService
     */
    private $prlEmployeeService;
    /**
     * @var PayscaleService
     */
    private $payscaleService;
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * LeaveRequestService constructor.
     *
     * @param LeaveRequestRepository $leaveRequestRepository
     * @param EmployeeService $employeeService
     * @param PostRetirementLeaveEmployeeService $postRetirementLeaveEmployeeService
     * @param LeaveTypeRepository $leaveTypeRepository
     * @param PayscaleService $payscaleService
     * @param UserService $userService
     */
    public function __construct(
        LeaveRequestRepository $leaveRequestRepository,
        EmployeeService $employeeService,
        PostRetirementLeaveEmployeeService $postRetirementLeaveEmployeeService,
        LeaveTypeRepository $leaveTypeRepository,
        PayscaleService $payscaleService,
        RoleService $roleService,
        UserService $userService
    ) {
        $this->leaveRequestRepository = $leaveRequestRepository;
        $this->setActionRepository($leaveRequestRepository);
        $this->employeeService = $employeeService;
        $this->prlEmployeeService = $postRetirementLeaveEmployeeService;
        $this->leaveTypeRepository = $leaveTypeRepository;
        $this->payscaleService = $payscaleService;
        $this->roleService = $roleService;
        $this->userService = $userService;
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['requester_id'] = Auth::id();
            $data['start_date'] = Carbon::createFromFormat('d-m-Y', $data['start_date']);
            $data['end_date'] = Carbon::parse($data['start_date'])->addDays($data['duration'])->subDays(1);
            $data['status'] = "new";
            $leaveRequest = $this->save($data);
            $this->checkIfRoleExist();
            $this->saveLeaveRequestAttachments($data, $leaveRequest);
            $leaveRequest->applyTransition('pending');
            $calculator = LeaveCalculatorFactory::makeCalculator($leaveRequest);
            if ($calculator->isValidRequest()) {
                return $leaveRequest;
            } else {
                DB::rollBack();
                return false;
            }
        });
    }

    public function updateLeaveRequest(LeaveRequest $leaveRequest, array $data)
    {
        $this->checkIfRoleExist();
        $leaveRequest->start_date = Carbon::createFromFormat('d/m/Y', $data['start_date']);
        $leaveRequest->end_date = Carbon::createFromFormat('d/m/Y', $data['end_date']);
        $leaveRequest->duration = $leaveRequest->start_date->diffInDays($leaveRequest->end_date) + 1;
        return $leaveRequest->save();
    }

    public function traverseWorkflow($data = [])
    {
        return DB::transaction(function () use ($data) {
            if (
                method_exists($this, $data['transition']) && is_callable(
                    LeaveRequestService::class,
                    $data['transition']
                )
            ) {
                return call_user_func_array(array($this, $data['transition']), ['data' => $data]);
            }
        });
    }

    private function approve($data = [])
    {
        $leaveRequest = $this->findOrFail($data['leave_request_id']);
        $calculator = LeaveCalculatorFactory::makeCalculator($leaveRequest);
        if ($calculator->isValidRequest()) {
            // if the leave is PRL, then create a PRL-Employee data
            if ($leaveRequest->type->name == LeaveTypes::PostRetirementLeave) {
                $this->createPRLEmployeeFromLeaveRequest($leaveRequest);
            }
            $data['recipients'][0] = $leaveRequest->requester_id;
            return $leaveRequest->applyTransition(
                'approve',
                $this->recipientsForTransition($data),
                $this->detailsForTransition($data)
            );
        } else {
            return false;
        }
    }

    private function share($data = [])
    {
        $leaveRequest = $this->findOrFail($data['leave_request_id']);
        return $leaveRequest->applyTransition(
            'share',
            $this->recipientsForTransition($data),
            $this->detailsForTransition($data)
        );
    }

    private function reject($data = [])
    {
        $leaveRequest = $this->findOrFail($data['leave_request_id']);
        $data['recipients'][0] = $leaveRequest->requester_id;
        return $leaveRequest->applyTransition(
            'reject',
            $this->recipientsForTransition($data),
            $this->detailsForTransition($data)
        );
    }

    private function recipientsForTransition($data = [])
    {
        if (!empty($data['recipients']) && is_array($data['recipients'])) {
            $recipients = collect();
            foreach ($data['recipients'] as $key => $recipient) {
                if (!is_null($recipient)) {
                    $recipients->push(User::findOrFail($recipient));
                }
            }
            return $recipients;
        }
        return collect();
    }

    private function detailsForTransition($data = [])
    {
        $details = [];
        if (array_key_exists('message', $data)) {
            $details['message'] = !empty($data['message']) ? $data['message'] : null;
        }
        if (array_key_exists('remark', $data)) {
            $details['remark'] = !empty($data['remark']) ? $data['remark'] : "";
        }
        return $details;
    }

    public function dashboardActivities()
    {
        $leaveRequests = LeaveRequest::all()
            ->filter(function ($leaveRequest) {
                return $leaveRequest->isRecipient();
            })
            ->filter(function ($leaveRequest) {
                return !in_array($leaveRequest->status, ['approved', 'rejected']);
            });
        return $leaveRequests;
    }

    public function remarks(LeaveRequest $leaveRequest)
    {
        return $leaveRequest->stateMachine()->getObject()->stateHistory;
    }

    public function filterRequestByDepartment($departmentCode)
    {
        $leaveRequests = $this->findAll();
        if (get_user_designation()->short_name == DesignationShortName::DG) {
            return $leaveRequests;
        }
        if ($departmentCode == DepartmentShortName::InventoryDivision) {
            return $leaveRequests;
        } else {
            $filtered = $leaveRequests->filter(function ($item) use ($departmentCode) {
                $reqDeptCode = $item->requester->employee->employeeDepartment->department_code;
                if ($reqDeptCode == $departmentCode) {
                    return true;
                }
            });
            return $filtered;
        }
    }

    /**
     * @param array $data
     * @param         $leaveRequest
     */
    private function saveLeaveRequestAttachments(array $data, $leaveRequest): void
    {
        if (!empty($data['attachments'])) {
            $leaveRequestAttachments = collect($data['attachments'])->map(function ($attachment) use ($leaveRequest) {
                $filePath = $this->upload(
                    $attachment,
                    'leave-attachments/' . Auth::user()->username . '/' . $leaveRequest->start_date->format('d-m-Y')
                );
                $fileName = $attachment->getClientOriginalName();
                return new LeaveRequestAttachment([
                    'attachment' => $filePath,
                    'file_name' => $fileName
                ]);
            });
            $leaveRequest->attachments()->saveMany($leaveRequestAttachments);
        }
    }

    /**
     * @param $leaveRequest
     *
     * @return bool
     * @throws \Exception
     */
    private function checkPaidLeave($leaveRequest): bool
    {
        $employee = $this->getEmployeeOfLeaveRequest($leaveRequest);
        $leaveStartDate = Carbon::parse($leaveRequest->start_date)->subDay(1);
        $attendance = $this->employeeService->getEmployeeAttendance($employee, $leaveStartDate);
        $paidLeaveCount = intval(ceil(bcdiv($attendance, LeaveTypes::AverageSalaryEarnedLeaveDivisor, 2)));
        $spentPaidLeave = $this->getSpentEarnedLeaves($leaveRequest->requester_id, $leaveRequest->leave_type_id);
        return $leaveRequest->duration <= (bcsub($paidLeaveCount, $spentPaidLeave));
    }


    public function getAvailableLeaveInformation($leaveRequest): array
    {
        $paidLeave = array();
        $employee = $this->getEmployeeOfLeaveRequest($leaveRequest);
        $leaveStartDate = Carbon::parse($leaveRequest->start_date)->subDay(1);
        $attendance = $this->employeeService->getEmployeeAttendance($employee, $leaveStartDate);
        $paidLeaveCount = intval(ceil(bcdiv($attendance, LeaveTypes::AverageSalaryEarnedLeaveDivisor, 2)));
        $spentPaidLeave = $this->getSpentEarnedLeaves($leaveRequest->requester_id, $leaveRequest->leave_type_id);
        $availablePaidLeave = bcsub($paidLeaveCount, $spentPaidLeave);
        array_push($paidLeave, $attendance, $availablePaidLeave, $spentPaidLeave);
        return $paidLeave;
    }

    /**
     * @param $leaveRequest
     *
     * @return mixed
     */
    private function getEmployeeOfLeaveRequest(LeaveRequest $leaveRequest)
    {
        return Arr::get($leaveRequest, 'requester.employee');
    }

    /**
     * @param int $requesterId
     * @param int $leaveTypeId
     *
     * @return
     */
    public function getSpentEarnedLeaves(int $requesterId, int $leaveTypeId)
    {
        return $this->actionRepository->getModel()
            ->where('status', 'approved')
            ->where('requester_id', $requesterId)
            ->where('leave_type_id', $leaveTypeId)
            ->sum('duration');
    }

    /**
     * @param int $leaveTypeId
     * @param int $requesterId
     *
     * @return int
     */
    public function getYearlySpentLeaves(int $leaveTypeId, int $requesterId): int
    {
        $fiscalYearStart = Carbon::createFromFormat('d/m', '1/7');
        $fiscalYearEnd = Carbon::instance($fiscalYearStart)
            ->addYear()
            ->subDay();
        return $this->actionRepository->getModel()
            ->where('status', 'approved')
            ->where('requester_id', $requesterId)
            ->where('leave_type_id', $leaveTypeId)
            ->whereDate('start_date', '>=', $fiscalYearStart)
            ->whereDate('end_date', '<=', $fiscalYearEnd)
            ->sum('duration');
    }

    public function getRecipientsDropDownList($users)
    {

        $recipients = collect();
        foreach ($users as $key => $user) {
            if (User::where('id', $key)->get()->first()) {
                $recipients->push(User::find($key));
            }
        }
        $recipients = $recipients->filter(function ($user) {
            return (($user->employee) && (get_user_department($user)->id) && (get_user_designation($user)->id));
        })->mapWithKeys(function ($user) {
            return [
                $user->id => $user->employee->getName()
                    . ' - '
                    . get_user_designation($user)->name
                    . ' - '
                    . get_user_department($user)->name
            ];
        });
        return $recipients;
    }


    /**
     * @return int
     */
    public function availablePRLLeave()
    {
        $user = Auth::user();
        $totalEarnedLeave = $this->availableEarnedLeave($user);
        return $totalEarnedLeave <= bcmul(12, 30, 1)
            ? $totalEarnedLeave : bcmul(12, 30, 1);
    }

    /**
     *  Total Earned Leave of Authenticated user
     *
     * @param User $user
     *
     * @return int
     */
    public function availableEarnedLeave(User $user)
    {
        $types = $this->leaveTypeRepository->findIn(
            'name',
            [
                LeaveTypes::AverageSalaryEarnedLeave,
                LeaveTypes::HalfAverageSalaryEarnedLeave
            ]
        );
        $availableLeaves = 0;
        $types->each(function ($type) use (&$availableLeaves, $user) {

            $spentLeave = $this->getSpentEarnedLeaves($user->id, $type->id);
            $attendance = $this->employeeService->getEmployeeAttendance($user->employee, Carbon::today());
            $earnedLeaveCount = bcdiv($attendance, $type->name == LeaveTypes::AverageSalaryEarnedLeave ? 11 : 12, 2);
            $earnedLeaveCount = round($earnedLeaveCount, 2, PHP_ROUND_HALF_UP);
            $availableLeaves += bcdiv(($earnedLeaveCount - $spentLeave),
                $type->name == LeaveTypes::AverageSalaryEarnedLeave ? 1 : 2,
                2
            );
        });
        $availableLeaves = intval(round($availableLeaves, 2, PHP_ROUND_HALF_UP));
        return $availableLeaves;
    }

    /**
     * @param LeaveRequest $leaveRequest
     */
    private function createPRLEmployeeFromLeaveRequest(LeaveRequest $leaveRequest): void
    {
        try {
            $prlEmployeeData = array();
            $userId = $leaveRequest->requester_id;
            $prlEmployeeUser = $this->userService->findOne($userId);
            if (is_null($prlEmployeeUser)) {
                throw new \Exception('User Not Found');
            }
            $prlEmployee = $prlEmployeeUser->employee;
            $contract = optional($prlEmployee)->employeeContract;
            if (is_null($contract)) {
                throw new \Exception('Employee Contract Not Found');
            }
            $duration = $this->availableEarnedLeave($prlEmployee->user);
            $this->prlEmployeeService->createPrlEmployee(
                $prlEmployee,
                $leaveRequest->start_date,
                $duration
            );
        } catch (\Exception $e) {
            Log::error('PRL Employee Data Creation Failed:-->  ' . $e->getMessage() . ' ' . $e->getTraceAsString());
        }
    }

    public function checkLeaveApplication($userID, $startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate)->format('Y-m-d');
        $endDate = Carbon::parse($endDate)->format('Y-m-d');

        return $this->leaveRequestRepository->checkLeaveAlreadyExists($userID, $startDate, $endDate);
    }

    public function getConsumedLeave($typeId, $requesterId = null, $start = 0, $end = null)
    {
        return $this->leaveRequestRepository->getConsumedLeaveByType($typeId, $requesterId, $start, $end);
    }

    public function getEmployeeExtraLeaveByType($typeId, $requesterId = null)
    {
        return $this->leaveRequestRepository->getEmployeeExtraLeaveByType($typeId, $requesterId);
    }

    public function getExtraLeaveByPurpose($typeId, $requesterId = null)
    {
        return $this->leaveRequestRepository->getExtraLeaveByPurpose($typeId, $requesterId);
    }

    public function getConsumedLeaveByPurpose($typeId, $requesterId = null, $start = 0, $end = null)
    {
        return $this->leaveRequestRepository->getConsumedLeaveByPurpose($typeId, $requesterId, $start, $end);
    }

    /**
     * @param $id
     * @return bool
     */
    public function cancel($id)
    {
        $request = $this->findOne($id);
        if ($request && $request->status == 'approved') {
            $request->update(['status' => 'pending']);
            $request->applyTransition('reject');
            return true;
        }
        return false;
    }

    public function checkIfRoleExist()
    {
        $workflowRoles = LeaveRequest::getWorkflowRoleNames();
        foreach ($workflowRoles as $role) {
            $this->roleService->firstOrCreate($role);
        }
    }

    public function canUserApplyForLeave(): bool
    {
        $leave = $this->leaveRequestRepository->getUserLastLeave();

        return !($leave && $leave->end_date > Carbon::now()->format('Y-m-d'));
    }

    public function updateEmployeeLeave(array $data)
    {
        $data['start_date'] = Carbon::now()->subDays(2);
        $data['end_date'] = Carbon::now()->subDays(2);
        $data['reason'] = $data['status'] == 'added' ? 'Added From HR' : 'Deduct From HR';

        return $this->save($data);
    }

    public function deductFromMotherType($leaveTypes, $leaveBalances = [])
    {
        foreach ($leaveTypes as $leaveType) {
            if ($leaveType->mother_type_id) {
                $motherTypeId = $leaveType->mother_type_id;
                $typeId = $leaveType->id;
                $consumedLeave = $this->getConsumedLeaveForLeaveBalance($typeId, $leaveBalances);
                $leaveBalances = $this->deductBalanceForLeave($motherTypeId, $consumedLeave, $leaveBalances);
            }
        }
        $leaveBalances =  $this->mergeFullAndHalfPayBalance($leaveBalances);
        return $leaveBalances;
    }

    public function getConsumedLeaveForLeaveBalance($typeId, $leaveBalances = [])
    {
        foreach ($leaveBalances as $leaveBalance) {
            if ($leaveBalance['type_id'] == $typeId)
                return  $leaveBalance['balance'][0];
        }
    }

    public function deductBalanceForLeave($motherTypeId, $consumedLeave, $leaveBalances = [])
    {
        $index = 0;
        foreach ($leaveBalances as $leaveBalance) {
            if ($leaveBalance['type_id'] == $motherTypeId) {
                $leaveBalances[$index]['consumed_leave'] +=  $consumedLeave;
                $leaveBalances[$index]['balance'][0] +=  $consumedLeave;
                $leaveBalances[$index]['balance'][1] -= $consumedLeave;
            }
            $index++;
        }
        return $leaveBalances;
    }

    public function mergeFullAndHalfPayBalance($leaveBalances)
    {
        $hospitalLeaveFullPay = 0;
        $hospitalLeaveHalfPay = 0;
        foreach ($leaveBalances as $leaveBalance) {
            if ($leaveBalance['leave_type_name'] == LeaveTypes::HospitalLeaveFullPay) {
                $hospitalLeaveFullPay = $leaveBalance['balance'][0];
            } elseif ($leaveBalance['leave_type_name'] == LeaveTypes::HospitalLeaveHalfPay) {
                $hospitalLeaveHalfPay = $leaveBalance['balance'][0];
            }
        }

        $index = 0;
        foreach ($leaveBalances as $leaveBalance) {
            if ($leaveBalance['leave_type_name'] == LeaveTypes::HospitalLeaveFullPay) {
                $leaveBalances[$index]['balance'][1] -=  $hospitalLeaveHalfPay;
            } elseif ($leaveBalance['leave_type_name'] == LeaveTypes::HospitalLeaveHalfPay) {
                $leaveBalances[$index]['balance'][1] -=  $hospitalLeaveFullPay;
            }
            $index++;
        }
        return $leaveBalances;
    }

    public function checkMultipleEarnedLeaveOrNot($leaveType)
    {
        if ($leaveType->name == 'hospital_leave_full_pay') {
            $leaveType  = $this->leaveTypeRepository->findIn('name', [LeaveTypes::HospitalLeaveHalfPay]);
            return  $leaveType[0]->id;
        } elseif ($leaveType->name == 'hospital_leave_half_pay') {
            $leaveType  = $this->leaveTypeRepository->findIn('name', [LeaveTypes::HospitalLeaveFullPay]);
            return  $leaveType[0]->id;
        }
    }

    public function checkIfCasualLeaveOrNot($possibleTransitions, $leaveRequest)
    {
        $leaveTypeName = $this->leaveTypeRepository->findOrFail($leaveRequest->leave_type_id)->name;
        if (
            $leaveTypeName ==  LeaveTypes::CasualLeave &&
            auth()->user()->hasAnyRole('ROLE_HRM_SECTION_OFFICER') &&
            $leaveRequest->status == 'shared'
        ) {
            array_push($possibleTransitions, 'approve');
        }
        $possibleTransitions = array_unique($possibleTransitions);
        return $possibleTransitions;
    }
}
