<?php


namespace Modules\TMS\Traits;


use App\Constants\DepartmentShortName;
use Illuminate\Http\Request;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\TrainingCourseAdministration;
use Modules\TMS\Entities\TrainingCourseResource;

trait MenuAccessTrait
{
    private $can = false;

    private $directorRoles = [
        'ROLE_DIRECTOR_GENERAL',
        'ROLE_DIRECTOR_ADMIN',
        'ROLE_DIRECTOR_TRAINING',
    ];

    private function isDirector($user)
    {
        if (!$this->can) {
            $this->can = $user->hasAnyRole($this->directorRoles) ? true : false;
        }
    }

    private function isTrainingDivisionEmployee($user)
    {
        if (!$this->can) {
            if (optional($user->employee)->employeeDepartment) {
                $this->can = optional($user->employee)->employeeDepartment->department_code == DepartmentShortName::TRAINING
                    ? true
                    : false;
            }
        }
    }

    private function isTrainingCourseAdministrator($user)
    {
        if (!$this->can) {
            if(optional($user->employee)) {
                $administrator = TrainingCourseAdministration::where('employee_id', $user->employee->id)
                    ->first();

                $this->can = $administrator ? true : false;
            }
        }
    }

    private function isTrainingCourseResource($user)
    {
        if (!$this->can) {
            if(optional($user->employee)) {
                $resource = TrainingCourseResource::where('reference_entity_id', $user->employee->id)
                    ->where('reference_entity', Employee::class)
                    ->first();

                $this->can = $resource ? true : false;
            }
        }
    }


    private function isMedicalOfficer($user)
    {
        if (!$this->can) {
            if ($user->employee) {
                $this->can = $user->employee->designation_id != 42 ? false : true ;
            }else{
                $this->can = false;
            }
        }
    }
}
