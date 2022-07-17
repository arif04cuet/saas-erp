<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 10/22/2018
 * Time: 2:53 PM
 */

namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\Employee;

class EmployeeRepository extends AbstractBaseRepository
{
    public $modelName = Employee::class;


//	public function getEmployeeInformation( $id ) {
////		dd($data);
//		$test = $this->findOne( $id );
//		dd( $test );
//	}



    public function getEmployeeTitleNames()
    {
        return [
            'Mr.' => 'Mr.',
            'Ms.' => 'Ms.',
            'Mrs.' => 'Mrs.',
            'Miss.' => 'Miss.',
            'Dr.' => 'Dr.',
            'Engr.' => 'Engr.',
            'Dr.' => 'Dr.',
        ];
    }

    public function getSalaryScale()
    {
        return [
            'Grade 1' => 'Grade 1',
            'Grade 2' => 'Grade 2',
            'Grade 3' => 'Grade 3',
            'Grade 4' => 'Grade 4',
            'Grade 5' => 'Grade 5',
            'Grade 6' => 'Grade 6',
            'Grade 7' => 'Grade 7',
            'Grade 8' => 'Grade 8',
            'Grade 9' => 'Grade 9',
            'Grade 10' => 'Grade 10',
            'Grade 11' => 'Grade 11',
            'Grade 12' => 'Grade 12',
            'Grade 13' => 'Grade 13',
            'Grade 14' => 'Grade 14',
            'Grade 15' => 'Grade 15',
            'Grade 16' => 'Grade 16',
            'Grade 17' => 'Grade 17',
            'Grade 18' => 'Grade 18',
            'Grade 19' => 'Grade 19',
            'Grade 20' => 'Grade 20',
        ];
    }


    public function getDivisionalDirectors()
    {
        return $this->model->where('is_divisional_director', 1)->get();
    }

    public function getClassEmployeeByDepartments(int $departmentsId)
    {
        $employeeIds = $this->modelName::where('department_id', $departmentsId)->pluck('id');
        $employees = Employee::whereIn('id', $employeeIds)
            ->get()
            ->filter(function($employee) {
                if($employee->user) {
                    if($employee->user->id == auth()->user()->id) {
                        return false;
                    }
                }

                return true;

            })->mapWithKeys(function ($employee) {
                $value = [];
                $employee->first_name ?  $value[] = $employee->first_name : false;
                $employee->last_name ?  $value[] = $employee->last_name : false;
                $employee->designation ?  $value[] = $employee->designation->name : false;
                $employee->employeeDepartment ?  $value[] = $employee->employeeDepartment->department_code : false;
                $employee->employeeSection ?  $sectionCode = " - " . $employee->employeeSection->section_code : $sectionCode = null;
                $firstName=(!empty($employee->first_name)) ? $employee->first_name : null;
                $lastName=(!empty($employee->last_name)) ? $employee->last_name : null;
                $designationName=(!empty($employee->designation->name)) ? $employee->designation->name : null;
                $departmentCode=(!empty($employee->employeeDepartment->department_code)) ? $employee->employeeDepartment->department_code : null;
                $section=(!empty($employee->employeeSection->section_code)) ? $employee->employeeSection->section_code : null;
                return [$employee->id => $firstName . " " . $lastName . " - " . $designationName . " - " . $departmentCode . $section];

            })->toArray();
        return $employees;
    }

}
