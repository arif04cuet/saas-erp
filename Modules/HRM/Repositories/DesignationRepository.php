<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 10/30/2018
 * Time: 12:44 PM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\Designation;
use Modules\HRM\Entities\Employee;


class DesignationRepository extends AbstractBaseRepository
{
    protected $modelName = Designation::class;

    public function getDesignationsByShortCode($shortName)
    {
        $designations = $this->modelName::whereIn('short_name', $shortName)->get();
        return $designations;
    }

    public function getClassEmployeeByRank(int $rankId)
    {
        $designationIds = $this->modelName::where('rank_id', $rankId)->pluck('id');
        $employees = Employee::whereIn('designation_id', $designationIds)
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

                return [$employee->id => $employee->first_name . " " . $employee->last_name . " - " . $employee->designation->name . " - " . $employee->employeeDepartment->department_code . $sectionCode];

            })->toArray();
        return $employees;
    }

}