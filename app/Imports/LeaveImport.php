<?php

namespace App\Imports;

use Carbon\Carbon;
use Modules\HRM\Entities\LeaveRequest;
use Modules\HRM\Entities\LeaveType;
use Modules\HRM\Entities\LeaveTypePurpose;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Traits\CrudTrait;
use Modules\HRM\Entities\Employee;

class LeaveImport implements ToModel, WithHeadingRow
{
    use CrudTrait;

    const EMPLOYEE_ID_COLUMN_NUMBER = 0;
    const LEAVE_TYPE_COLUMN_NUMBER = 1;
    const LEAVE_TYPE_PURPOSE_COLUMN_NUMBER = 2;
    const DURATION_COLUMN_NUMBER = 3;

    const  HEAD_ROWS =
    [
        self::EMPLOYEE_ID_COLUMN_NUMBER         => 'employee_id_old_employee_id',
        self::LEAVE_TYPE_COLUMN_NUMBER          => 'leave_type',
        self::LEAVE_TYPE_PURPOSE_COLUMN_NUMBER     => 'leave_type_purpose',
        self::DURATION_COLUMN_NUMBER         => 'duration',


    ];

    public function model(array $row)
    {
        $test = $this->createConsumedLeave($row);
    }
    private function createConsumedLeave(array $data)
    {

        $leaveType = LeaveType::where('name', $data['leave_type'])->first();
        $leaveTypePurpose = LeaveTypePurpose::where('name', $data['leave_type_purpose'])->first();

        $userName = $data['employee_id_old_employee_id'];
        $employee = Employee::where('employee_id',  $userName)->first();
        $employeeId = $employee['id'];
        $leaveTypeId =  $leaveType['id'];
        $leaveTypePurposeId = (!empty($leaveTypePurpose)) ? $leaveTypePurpose->id : null;
        $duration = $data['duration'];
        $today = Carbon::now();
        $leaveRequest = [
            'requester_id'                                              => $employeeId,
            'leave_type_id'                                             => $leaveTypeId,
            'leave_type_purpose_id'                                     => $leaveTypePurposeId,
            'duration'                                                  => $duration,
            'start_date'                                                => $today,
            'end_date'                                                  => $today,
            'remark'                                                    => "N/A",
            'reason'                                                    => "N/A",
            'status'                                                    => "approved",
        ];
        LeaveRequest::Create($leaveRequest);
    }
    public function startRow(): int
    {
        return 2;
    }
}
