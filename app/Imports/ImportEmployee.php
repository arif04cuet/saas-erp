<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Modules\HRM\Entities\Department;
use Modules\HRM\Entities\Designation;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Entities\EmployeePersonalInfo;
use Modules\HRM\Entities\EmployeeReligion;
use Modules\Accounts\Entities\MonthlyPensionContract;
use Modules\Accounts\Entities\PensionNominee;
use Illuminate\Support\Facades\DB;

class ImportEmployee implements ToModel, WithStartRow
{
    const EMPLOYEE_ID_COLUMN_NUMBER = 0;
    const FIRST_NAME_COLUMN_NUMBER = 1;
    const DEPARTMENT_NAME_COLUMN_NUMBER = 2;
    const DESIGNATION_COLUMN_NUMBER = 3;
    const GENDER_COLUMN_NUMBER = 4;
    const RELIGION_COLUMN_NUMBER = 5;
    const EMAIL_COLUMN_NUMBER = 6;
    const MOBILE_COLUMN_NUMBER = 7;
    const FATHER_NAME_COLUMN_NUMBER = 8;
    const HUSBAND_NAME_COLUMN_NUMBER = 9;
    const MOTHER_NAME_COLUMN_NUMBER = 10;
    const DATE_OF_BIRTH_COLUMN_NUMBER = 11;
    const JOINING_DATE_COLUMN_NUMBER = 12;
    const MARIATAL_STATUS_COLUMN_NUMBER = 13;
    const PPO_NO_COLUMN_NUMBER = 14;
    const PENSION_RECEIVER_COLUMN_NUMBER = 15;
    const INITIAL_BASIC_COLUMN_NUMBER = 16;
    const CURRENT_BASIC_COLUMN_NUMBER = 17;
    const INCREMENT_COLUMN_NUMBER = 18;
    const DISBURSEMENT_TYPE_COLUMN_NUMBER = 19;
    const ACCOUNT_NUMBER_COLUMN_NUMBER = 20;
    const NOMINEE_NAME_COLUMN_NUMBER = 21;
    const NOMINEE_BIRTH_DATE_COLUMN_NUMBER = 22;
    const NOMINEE_RELATION_COLUMN_NUMBER = 23;


    const  HEAD_ROWS =
    [
        self::EMPLOYEE_ID_COLUMN_NUMBER         => 'employee_id',
        self::FIRST_NAME_COLUMN_NUMBER          => 'first_name',
        self::DEPARTMENT_NAME_COLUMN_NUMBER     => 'Department',
        self::DESIGNATION_COLUMN_NUMBER         => 'Designation',
        self::GENDER_COLUMN_NUMBER              => 'Gender',
        self::RELIGION_COLUMN_NUMBER            => 'Religion',
        self::EMAIL_COLUMN_NUMBER               => 'Email',
        self::MOBILE_COLUMN_NUMBER              => 'Mobile',
        self::FATHER_NAME_COLUMN_NUMBER         => "Father/Husband's Name",
        self::HUSBAND_NAME_COLUMN_NUMBER        => "Husband's Name",
        self::MOTHER_NAME_COLUMN_NUMBER         => "Mother's Name",
        self::DATE_OF_BIRTH_COLUMN_NUMBER       => "Date of Birth (dd/mm/yyyy)",
        self::JOINING_DATE_COLUMN_NUMBER        => "Joining Date (dd/mm/yyyy)",
        self::MARIATAL_STATUS_COLUMN_NUMBER     => "Marital Status",
        self::PPO_NO_COLUMN_NUMBER              => "PPO No.",
        self::PENSION_RECEIVER_COLUMN_NUMBER    => "Pension Receiver",
        self::INITIAL_BASIC_COLUMN_NUMBER       => "Initial Basic",
        self::CURRENT_BASIC_COLUMN_NUMBER       => "Current Basic",
        self::INITIAL_BASIC_COLUMN_NUMBER       => "Current Basic",
        self::INCREMENT_COLUMN_NUMBER           => "Increment",
        self::DISBURSEMENT_TYPE_COLUMN_NUMBER   => "Disbursement Type (Bank/Cash)",
        self::ACCOUNT_NUMBER_COLUMN_NUMBER      => "Account No. (If Disbursement type is Bank)",
        self::NOMINEE_NAME_COLUMN_NUMBER        => "Nominee Name",
        self::NOMINEE_BIRTH_DATE_COLUMN_NUMBER  => "Nominee Birth Date (dd/mm/yyyy)",
        self::NOMINEE_RELATION_COLUMN_NUMBER   => "Relationship with Employee",

    ];

    /**
     * this function use for model data entry
     *
     * @param array $row
     * @return void
     */
    public function model(array $row)
    {
        // run only on valid value
        if (isset($row[self::FIRST_NAME_COLUMN_NUMBER], $row[self::EMPLOYEE_ID_COLUMN_NUMBER])) {
            DB::transaction(function () use ($row) {
                $employee = $this->getEmployee($row);
                if (isset($employee) && !is_null($employee)) {
                    $this->createPersonalInfo($row, $employee);
                    $this->createMonthlyPensionContract($row, $employee);
                    $this->createNomineeInfo($row, $employee);
                }
            });
        }
    }

    /**
     *  this function use for employee checking
     *
     * @param array $data
     * @param boolean $createIfNotFound
     * @return void
     */
    private function getEmployee(array $data, $createIfNotFound = false)
    {
        $employeeId = $data[self::EMPLOYEE_ID_COLUMN_NUMBER];
        $employee = Employee::where('employee_id', $employeeId)->first();
        if (is_null($employee)) {
            return $this->createEmployee($data);
        } else {
            return $this->createEmployee($data);
        }
    }
    /**
     *  this function use for create employee
     *
     * @param array $data
     * @return void
     */
    private function createEmployee(array $data)
    {
        $fullName = explode(" ", $data[self::FIRST_NAME_COLUMN_NUMBER]);
        $firstName = $data[self::FIRST_NAME_COLUMN_NUMBER];
        $lastName = '';
        $employeeId = trim($data[self::EMPLOYEE_ID_COLUMN_NUMBER]);
        $email = (!empty($data[self::EMAIL_COLUMN_NUMBER])) ? $data[self::EMAIL_COLUMN_NUMBER] : $employeeId . '@gmail.com';
        $gender = strtolower((!empty($data[self::GENDER_COLUMN_NUMBER])) ? $data[self::GENDER_COLUMN_NUMBER] : 'Male');
        $department = strtoupper($data[self::DEPARTMENT_NAME_COLUMN_NUMBER]);
        $designation = strtoupper($data[self::DESIGNATION_COLUMN_NUMBER]);
        $mobileNo = trim($data[self::MOBILE_COLUMN_NUMBER]);
        $religion = trim($data[self::RELIGION_COLUMN_NUMBER]);

        $departmentInfo = Department::where('department_code', $department)->first();
        $departmentId = (!empty($departmentInfo)) ? $departmentInfo->id : 9;

        $designationInfo = Designation::where('name', $designation)->first();
        $designationId = (!empty($designationInfo)) ? $designationInfo->id : 2;

        $religionInfo = EmployeeReligion::where('bengali_title', $religion)->OrWhere('english_title', $religion)->first();
        $religion = (!empty($religionInfo)) ? $religionInfo->id : 1;

        $employee = Employee::updateOrCreate(['employee_id'  => $employeeId], [
            'first_name'                                     => $firstName,
            'last_name'                                      => $lastName,
            'employee_id'                                    => $employeeId,
            'email'                                          => $email,
            'gender'                                         => $gender,
            'department_id'                                  => $departmentId,
            'designation_id'                                 => $designationId,
            'mobile_one'                                     => $mobileNo,
            'religion_id'                                    => $religion,
        ]);
        return $employee;
    }
    /**
     *  this function use for personal information update
     *
     * @param array $data
     * @param [type] $employee
     * @return void
     */
    private function createPersonalInfo(array $data, $employee)
    {
        $employeeId     = $employee->id;
        $fatherName     = $data[self::FATHER_NAME_COLUMN_NUMBER];
        $husbandName     = $data[self::HUSBAND_NAME_COLUMN_NUMBER];
        $motherName     = $data[self::MOTHER_NAME_COLUMN_NUMBER];
        $dateOfBirth    = trim($data[self::DATE_OF_BIRTH_COLUMN_NUMBER]);
        $jobJoiningDate = trim($data[self::JOINING_DATE_COLUMN_NUMBER]);
        $maritalStatus  = (!empty($data[self::MARIATAL_STATUS_COLUMN_NUMBER])) ? $data[self::MARIATAL_STATUS_COLUMN_NUMBER] : 'single';
        // $nid_number     = $data[self::PPO_NO_COLUMN_NUMBER];
        $dateOfBirth = Carbon::createFromFormat('d/m/Y', $dateOfBirth)->format('Y-m-d H:i:s');
        $jobJoiningDate = Carbon::createFromFormat('d/m/Y', $jobJoiningDate)->format('Y-m-d H:i:s');
        $employee = EmployeePersonalInfo::updateOrCreate(['employee_id'  => $employeeId], [
            'father_name'                                    => $fatherName,
            'mother_name'                                    => $motherName,
            'date_of_birth'                                  => $dateOfBirth,
            'job_joining_date'                               => $jobJoiningDate,
            'marital_status'                                 => $maritalStatus,
            'husband_name'                                   => $husbandName
        ]);
        return $employee;
    }
    /**
     *  this function use for monthly pension contract
     *
     * @param array $data
     * @param [type] $employee
     * @return void
     */
    private function createMonthlyPensionContract(array $data, $employee)
    {

        $employeeId     = $employee->id;
        $ppo_number     = $data[self::PPO_NO_COLUMN_NUMBER];
        $receiver       = $data[self::PENSION_RECEIVER_COLUMN_NUMBER];
        $initialBasic   = $data[self::INITIAL_BASIC_COLUMN_NUMBER];
        $currentBasic   = $data[self::CURRENT_BASIC_COLUMN_NUMBER];
        $increment   = $data[self::INCREMENT_COLUMN_NUMBER];
        $disbursement_type = $data[self::DISBURSEMENT_TYPE_COLUMN_NUMBER];
        $bank_account_information = $data[self::ACCOUNT_NUMBER_COLUMN_NUMBER];
        $employee = MonthlyPensionContract::updateOrCreate(['employee_id'  => $employeeId], [
            'ppo_number'                                    => $ppo_number,
            'employee_id'                                   => $employeeId,
            'receiver'                                      => $receiver,
            'initial_basic'                                 => $initialBasic,
            'current_basic'                                 => $currentBasic,
            'increment'                                     => $increment,
            'disbursement_type'                             => $disbursement_type,
            'bank_account_information'                      => $bank_account_information,
        ]);
        return $employee;
    }
    /**
     * this function use for nominee information update
     *
     * @param array $data
     * @param [type] $employee
     * @return void
     */
    private function createNomineeInfo(array $data, $employee)
    {
        $employeeId         = $employee->id;
        $nomineeNames        = explode(',',  $data[self::NOMINEE_NAME_COLUMN_NUMBER]);
        $nomineeDateOfBirths = explode(',', trim($data[self::NOMINEE_BIRTH_DATE_COLUMN_NUMBER]));
        $nomineeRelations       = explode(',', $data[self::NOMINEE_RELATION_COLUMN_NUMBER]);
        $allNominees = PensionNominee::where('employee_id', $employeeId)->get();

        foreach ($nomineeNames as $key => $name) {
            $birthD = isset($nomineeDateOfBirths[$key]) && !empty($nomineeDateOfBirths[$key]) ? trim($nomineeDateOfBirths[$key]) : '11/11/1900';
            $dateOfBirth = Carbon::createFromFormat('d/m/Y', $birthD)->format('Y-m-d H:i:s');
            $emId = isset($allNominees[$key]) ? $allNominees[$key]->id : PHP_INT_MAX;

            PensionNominee::updateOrCreate(['id'  => $emId], [
                'name'                  => isset($nomineeNames[$key]) && !empty($nomineeNames[$key]) ? trim($nomineeNames[$key]) : 'N/A',
                'bangla_name'           => isset($nomineeNames[$key])  && !empty($nomineeNames[$key]) ? trim($nomineeNames[$key]) : 'N/A',
                'employee_id'           => $employeeId,
                'birth_date'            => $dateOfBirth,
                'relation'              => isset($nomineeRelations[$key])  && !empty($nomineeRelations[$key]) ? trim($nomineeRelations[$key]) : 'N/A'
            ]);
        }

        return true;
    }

    // private function createNomineeInfo(array $data, $employee){
    //     $employeeId         = $employee->id;
    //     $nomineeName        = $data[self::NOMINEE_NAME_COLUMN_NUMBER];
    //     $nomineeDateOfBirth = trim($data[self::NOMINEE_BIRTH_DATE_COLUMN_NUMBER]);
    //     $dateOfBirth= Carbon::createFromFormat('d/m/Y', $nomineeDateOfBirth)->format('Y-m-d H:i:s');
    //     $nomineeRelation       = $data[self::NOMINEE_RELATION_COLUMN_NUMBER];
    //     $nominee= PensionNominee::updateOrCreate(['employee_id'  => $employeeId], [
    //         'name'                  => $nomineeName,
    //         'bangla_name'           => $nomineeName,
    //         'employee_id'           => $employeeId,
    //         'birth_date'            => $dateOfBirth,
    //         'relation'              => $nomineeRelation
    //     ]);
    // return $nominee;

    // }

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function startRow(): int
    {
        return 3;
    }
}
