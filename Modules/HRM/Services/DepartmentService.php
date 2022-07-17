<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 10/28/2018
 * Time: 6:26 PM
 */

namespace Modules\HRM\Services;


use App\Entities\Role;
use App\Entities\User;
use App\Http\Responses\DataResponse;
use App\Repositories\RoleRepository;
use App\Traits\CrudTrait;
use Closure;
use Illuminate\Http\Response;
use Modules\HRM\Entities\Department;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Repositories\DepartmentRepository;
use Modules\HRM\Repositories\EmployeeDepartmentRepository;
use Modules\HRM\Repositories\EmployeeRepository;

class DepartmentService
{
    use  CrudTrait;

    protected $departmentRepository;
    private $employeeRepository;
    private $roleRepository;

    public function __construct(
        DepartmentRepository $departmentRepository,
        EmployeeRepository $employeeRepository,
        RoleRepository $roleRepository
    ) {
        $this->departmentRepository = $departmentRepository;
        $this->employeeRepository = $employeeRepository;
        $this->roleRepository = $roleRepository;
        $this->setActionRepository($this->departmentRepository);
    }

    public function storeDepartment($data)
    {
        $department = $this->save($data);
        $deptHead = $this->employeeRepository->findOne($data['department_head_id']);
        if (!is_null($deptHead)) {
            $deptHead->update(['is_divisional_director' => 1, 'department_id' => $department->id]);
            $this->assignRoleDepartmentHeadToUser($deptHead);
        }
        return new DataResponse($department, $department->id, trans('labels.save_success'));
    }

    public function updateDepartment($data, $id)
    {
        $department = $this->findOrFail($id);
        $status = $department->update($data);
        //Resetting and Reassigning Department Head
        Employee::where(['department_id' => $id])->update(['is_divisional_director' => 0]);
        $newDepartmentHead = $this->employeeRepository->findOrFail($data['department_head_id']);
        $newDepartmentHead->update(['is_divisional_director' => 1, 'department_id' => $id]);
        $this->modifyDepartmentHeadUser($department, $newDepartmentHead);
        if ($status) {
            return new DataResponse($department, $department->id, trans('labels.update_success'));
        }
    }

//	getDepartmentList providing the list of department by collection
    public function getDepartmentList()
    {
        return $this->departmentRepository->findAll();

    }

//	getDepartments providing department list with array for employee creation
    public function getDepartments()
    {
        return $this->departmentRepository->findAll()->pluck('name', 'id')->toArray();
    }

    public function getDepartmentById($id)
    {
        return $this->departmentRepository->findOrFail($id);
    }

    public function deleteDepartment($id)
    {
        $department = $this->findOrFail($id);
        $status = $department->delete();
        if ($status) {
            return new Response(trans('labels.delete_success'));
        }
    }

    public function getDepartmentsForDropdown(Closure $implementedValue = null, Closure $implementedKey = null)
    {
        $departments = $this->departmentRepository->findAll();

        $departmentOptions = [];

        foreach ($departments as $department) {
            $departmentId = $implementedKey ? $implementedKey($department) : $department->id;

            $implementedValue = $implementedValue ?: function ($department) {
                return optional($department)->name;
            };

            $departmentOptions[$departmentId] = $implementedValue($department);
        }

        return $departmentOptions;
    }

    public function getDepartmentByCode($departmentCode)
    {
        return $this->actionRepository->getDepartmentByCode($departmentCode);
    }

    /**
     * @param Employee $employee
     * @return mixed
     */
    private function assignRoleDepartmentHeadToUser(Employee $employee)
    {
        $deptHeadUser = $employee->user;
        $roleDepartmentHead = $this->getDepartmentHeadRole();
        if (!is_null($deptHeadUser) && !is_null($roleDepartmentHead)) {
            // assign role department head to deptHeadUser
            return $deptHeadUser->roles()->attach([$roleDepartmentHead->id]);
        }
    }

    private function modifyDepartmentHeadUser(Department $department, Employee $employee)
    {
        // for the employee of this department, find out if anyone has role_department_head role
        // if true, detach that, and reattach for new employee
        $deptEmployees = $this->employeeRepository->findBy(['department_id' => $department->id], ['user']);
        $departmentHeadRole = $this->getDepartmentHeadRole();
        $deptEmployees->each(function ($employee) use ($departmentHeadRole) {
            $user = $employee->user;
            if (!is_null($user) && $user->hasRole($departmentHeadRole->name)) {
                $user->roles()->detach($departmentHeadRole->id);
            }
        });
        $this->assignRoleDepartmentHeadToUser($employee);
    }


    private function getDepartmentHeadRole()
    {
        return $this->roleRepository->findBy(['name' => Department::getDepartmentHeadRoleName()])->first();
    }
}
