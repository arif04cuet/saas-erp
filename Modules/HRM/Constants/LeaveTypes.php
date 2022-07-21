<?php

namespace Modules\HRM\Constants;


abstract class LeaveTypes
{
    // leave counts in days
    const CasualLeaveLimit = 20;
    const SpecialSickLeaveWeekLimit = 42;
    const SpecialSickLeaveMonthLimit = 90;
    // divisors
    const AverageSalaryEarnedLeaveDivisor = 11;
    const HalfAverageSalaryEarnedLeaveDivisor = 12;
    // names
    const EarnedLeave = "earned_leave";
    const AverageSalaryEarnedLeave = "average_salary_earned_leave";
    const HalfAverageSalaryEarnedLeave = "half_average_salary_earned_leave";
    const ExtraordinaryLeave = "extraordinary_leave";
    const StudyLeave = "study_leave";
    const QuarantineLeave = "quarantine_leave";
    const MaternityLeave = "maternity_leave";
    const NotDueLeave = "not_due_leave";
    const PostRetirementLeave = "post_retirement_leave";
    const CasualLeave = "casual_leave";
    const PublicAndGovtLeave = "public_and_govt_leave";
    const PublicLeave = "public_leave";
    const GovtLeave = "govt_leave";
    const OptionalLeave = "optional_leave";
    const RestAndRecreationLeave = "rest_and_recreation_leave";
    const SpecialDisabilityLeaveFullPay = "special_disability_leave_full_pay";
    const SpecialDisabilityLeaveHalfPay = "special_disability_leave_half_pay";
    const SpecialSickLeave = "special_sick_leave";
    const VacationDepartmentLeave = "vacation_dept_leave";
    const DepartmentLeave = "dept_leave";
    const HospitalLeaveFullPay = "hospital_leave_full_pay";
    const HospitalLeaveHalfPay = "hospital_leave_half_pay";
    const WithoutPayLeave = "without_pay_leave";
    const CompulsoryLeave = "compulsory_leave";
}
