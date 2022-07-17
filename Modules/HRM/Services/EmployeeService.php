<?php

/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 10/22/2018
 * Time: 2:58 PM
 */

namespace Modules\HRM\Services;

use App\Http\Responses\DataResponse;
use App\Services\UserService;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use App\Utilities\DropDownDataFormatter;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Entities\LeaveRequest;
use Modules\HRM\Repositories\DesignationRepository;
use Modules\HRM\Repositories\EmployeeRepository;

class EmployeeService
{
    use CrudTrait;
    use FileTrait;

    private $employeeRepository;
    private $userService;
    private $calendarEventService;
    /**
     * @var DesignationRepository
     */
    private $designationRepository;

    /**
     * EmployeeService constructor.
     *
     * @param EmployeeRepository $employeeRepository
     * @param UserService $userService
     * @param CalendarEventService $calendarEventService
     * @param DesignationRepository $designationRepository
     */
    public function __construct(
        EmployeeRepository $employeeRepository,
        UserService $userService,
        CalendarEventService $calendarEventService,
        DesignationRepository $designationRepository
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->userService = $userService;
        $this->setActionRepository($this->employeeRepository);
        $this->calendarEventService = $calendarEventService;
        $this->designationRepository = $designationRepository;
    }

    public function storeGeneralInfo($data = [])
    {
        if (isset($data['photo'])) {
            $path = $this->upload($data['photo'], 'employee-profile');
            $data['photo'] = basename($path);
        }
        if (!isset($data['religion_id'])) {
            $data['religion_id'] = null;
        }
        $generalInfo = $this->employeeRepository->save($data);
        $this->userService->store([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'username' => $data['employee_id'],
            'employee_id' => $generalInfo->id,
            'email' => $data['email'],
            'mobile' => $data['mobile_one'],
            'reference_table_id' => $generalInfo->id,
            'user_type' => config('user.types.EMPLOYEE'),
            'password' => config('user.defaultPassword')
        ]);
        return new DataResponse(
            $generalInfo,
            $generalInfo['id'],
            trans('labels.General information added successfully')
        );
    }

    public function updateGeneralInfo($data, $id)
    {
        if (isset($data['photo'])) {
            $path = $this->upload($data['photo'], 'employee-profile');
            $data['photo'] = basename($path);
        }
        $data['is_retired'] = $data['is_retired'] ?? 0;
        if (!isset($data['religion_id'])) {
            $data['religion_id'] = null;
        }
        $generalInfo = $this->findOrFail($id);
        $status = $generalInfo->update($data);
        if ($status) {
            return new DataResponse(
                $generalInfo,
                $generalInfo['id'],
                trans('labels.General information updated successfully')
            );
        } else {
            return new DataResponse($generalInfo, $generalInfo['id'], trans('labels.Something going wrong !'), 500);
        }
    }

    public function getEmployeeList()
    {
        return $this->employeeRepository->findAll()->sortBy(function ($employee) {
            return optional($employee->designation)->hierarchy_level ?? 1000;
        });
    }

    public function getEmployeeTitles()
    {
        return $this->employeeRepository->getEmployeeTitleNames();
    }

    public function getEmployeeSalaryScale()
    {
        return $this->employeeRepository->getSalaryScale();
    }

    /**
     * <h3>Employee Dropdown</h3>
     * <p>Custom Implementation of concatenation</p>
     *
     * @param Closure $implementedValue Anonymous Implementation of Value
     * @param Closure $implementedKey Anonymous Implementation Key index
     * @param array|null $query
     * @param bool $isEmptyOption
     *
     * @return array
     */
    public function getEmployeesForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $employees = $query ? $this->employeeRepository->findBy($query) : $this->employeeRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $employees,
            $implementedKey,
            $implementedValue ?: function ($employee) {
                return $employee->employee_id . ' - ' . $employee->first_name . ' ' . $employee->last_name . ' - ' . $employee->mobile_one;
            },
            $isEmptyOption
        );
    }

    public function getAllEmployeesByDepartmentId($departmentId)
    {
        $employees = $this->employeeRepository->findBy(['department_id' => $departmentId])
            ->mapWithKeys(function ($employee) {
                return [$employee->id => $employee->getName() . ' ' . $employee->getDesignation()];
            })->toArray();
        return $employees;
    }

    public function getDivisionalDirectorByDepartmentId($departmentId)
    {
        $divisionalDirector = $this->employeeRepository->findBy([
            'department_id' => $departmentId,
            'is_divisional_director' => true
        ])->first();
        return $divisionalDirector;
    }

    /**
     * @param Employee $employee
     *
     * @return Carbon
     * @throws Exception
     */
    public function getEmployeeJoiningDate(Employee $employee): Carbon
    {
        $joiningDate = Arr::get($employee, 'employeePersonalInfo.job_joining_date');
        if (is_null($joiningDate)) {
            throw new Exception('Employee joining date cannot be null');
        }
        return Carbon::parse($joiningDate);
    }

    /**
     * @param Employee $employee
     * @param Carbon $lastWorkingDay
     *
     * @return int
     * @throws Exception
     */
    public function getEmployeeAttendance(Employee $employee, Carbon $lastWorkingDay): int
    {
        $attendance = $this->getOnlyAttendance($employee, $lastWorkingDay);
        $spentLeaves = LeaveRequest::where('requester_id', $employee->user->id)
            ->where('status', 'approved')
            ->sum('duration');
        return intval(bcsub($attendance, $spentLeaves));
    }

    public function getAttendanceWithLeave(Employee $employee, Carbon $lastWorkingDay)
    {
        return $this->getOnlyAttendance($employee, $lastWorkingDay);
    }

    public function getOnlyAttendance(Employee $employee, Carbon $lastWorkingDay)
    {
        $joiningDate = $this->getEmployeeJoiningDate($employee);
        $attendance = $joiningDate->diffInDaysFiltered(function (Carbon $date) {
            return !$date->isWeekend();
        }, $lastWorkingDay);
        $holidays = $this->calendarEventService->getEventDaysCount($joiningDate, $lastWorkingDay);
        $attendance = intval(bcsub($attendance, $holidays));

        return $attendance;
    }


    public function getEmployeesAsReporters()
    {
        return $this->employeeRepository->findAll()
            ->filter(function ($employee) {
                return $employee->id != Auth::user()->employee->id;
            })
            ->mapWithKeys(function ($employee) {
                return [$employee->id => $employee->getName()];
            });
    }

    public function getAvailableMedicalOfficers($class = "first")
    {
        $designationId = $this->designationRepository->findAll()->where('short_name', 'MO')->first()->id;
        $medicalOfficer = $this->employeeRepository->findAll()->where('designation_id', $designationId)->first();
        return $medicalOfficer;
    }

    public function getAvailableSigners($class = "fourth")
    {
        $signers = collect();
        switch ($class) {
            case 'first':
                $signers = $this->employeeRepository->findAll();
                break;
            case 'second':
                $signers = $this->employeeRepository->findAll()
                    ->filter(function ($employee) {
                        return $this->checkSignerValidity($employee, 3);
                    });
                break;
            case 'third':
                $signers = $this->employeeRepository->findAll()
                    ->filter(function ($employee) {
                        return $this->checkSignerValidity($employee, 3);
                    });
                break;
            case 'fourth':
                $signers = $this->employeeRepository->findAll()
                    ->filter(function ($employee) {
                        return $this->checkSignerValidity($employee, 4);
                    });
                break;
            default:
                $signers = $this->employeeRepository->findAll();
        }
        return $signers->mapWithKeys(function ($signer) {
            return [$signer->id => "{$signer->first_name} {$signer->last_name} - {$signer->designation->name}"];
        })->toArray();
    }

    private function checkSignerValidity($employee, $rank)
    {
        if ($employee->designation) {
            if ($employee->user) {
                if ($employee->user->id == auth()->user()->id) {
                    return false;
                }
            }
            return $employee->designation->rank_id < $rank;
        }
        return false;
    }

    /**
     * @return Closure
     */
    public function empDefaultDropdown(): Closure
    {
        return function ($employee) {
            $employeeName = $employee->getName();
            $employeeDesignationName = optional($employee->designation)->getName() ?? trans('labels.not_found');
            $employeeDepartmentName = optional($employee->employeeDepartment)->name ?? trans('labels.not_found');

            return [
                // $employee->id => "{$employeeName} - {$employeeDesignationName} - {$employeeDepartmentName}"
                $employee->id => "{$employeeName}"
            ];
        };
    }

    /**
     * get employee salary structure
     *
     * @param Employee $employee
     *
     * @return mixed
     */
    public function getEmployeeSalaryStructure(Employee $employee)
    {
        return optional($employee->employeeContract)->salaryStructure;
    }

    /**
     * get employee contract
     *
     * @param Employee $employee
     *
     * @return mixed|null
     */
    public function getEmployeeContract(Employee $employee)
    {
        return $employee->employeeContract ? $employee->employeeContract : null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMasterRollEmployees()
    {
        $masterRoll = Config::get('constants.employee_available_status.master roll');
        return $this->findBy(['status' => $masterRoll]);
    }

    public function ignoreMasterRollEmployees(Collection $employees)
    {
        $employees = $employees->filter(function ($e) {
            return is_null($e->masterRoll);
        });
        return $employees;
    }

    /**
     * If employee Joining date available, return in days/years
     * Else - pass O days
     *
     * @param        $employee
     * @param bool $years
     *
     * @return int
     * @throws Exception
     */
    public function getEmployeeServicePeriod($employee, $years = false)
    {
        $personalEmployee = $employee->employeePersonalInfo;
        // call only if personal information is availabe
        // getJoiningDate throws an exception otherwise
        if ($personalEmployee) {
            $now = $this->getEmployeeJoiningDate($employee);
        } else {
            $now = Carbon::now();
        }
        $end = Carbon::now();
        if ($years) {
            return $now->diffInYears($end);
        } else {
            // return in days
            return $now->diffInDays($end);
        }
    }

    /**
     * If the flag is false, return collection of employees who does not have designation
     * If its true, return collection of employees who have designation
     * @param Collection $employees
     * @param false $flag
     * @return Collection
     */
    public function filterEmployeeByDesignation(Collection $employees, $flag = true)
    {

        return $employees->filter(function ($e) use ($flag) {
            if ($flag) {
                return $e->designation;
            }
            return !$e->designation;
        });
    }

    /**
     * Get Employee sorted by their service period length
     * This function returns them in desc order
     *
     * @param $employees
     *
     * @return mixed
     */
    public function getEmployeeSortedByServicePeriod($employees)
    {
        $employees = $employees->each(function ($e) {
            $e->service_period = $this->getEmployeeServicePeriod($e);
            return $e;
        })->sortByDesc(function ($e) {
            return (int)$e->service_period;
        })->values();
        return $employees;
    }


    public function getEmployeeSortedByDesignation(Collection $employees)
    {
        return $employees->each(function ($e) {
            $e->designation_name = $e->designation->name;
            $e->designation_level = $e->designation->hierarchy_level;
        })->sortBy(function ($e) {
            return (int)$e->designation->hierarchy_level;
        })->values();
    }


    /**
     * This method adds 'employee_name' attr. to a payslip
     * You can access like: $payslips->employee_name
     *
     * @param $employees
     *
     * @return mixed
     */
    public function addEmployeeNameToCollection(Collection $employees)
    {
        return $employees->each(function ($e) {
            return $e->employee_name = $e->getName();
        });
    }

    /**
     * This method adds 'employee_level' attr. to a payslip
     * You can access like: $payslips->employee_level
     *
     * @param $employees
     *
     * @return mixed
     */
    public function addEmployeeLevelToCollection(Collection $employees)
    {
        return $employees->each(function ($e) {
            return $e->employee_level = $e->designation->hierarchy_level;
        });
    }

    /**
     * This method returns employees sorted by
     * their designation and service period
     *
     * @param $employees
     *
     * @return Collection
     */
    public function getEmployeesSortedByDesignationAndServicePeriod(
        Collection $employees
    ): Collection {
        $employees = $this->filterEmployeeByDesignation($employees, true);
        $employees = $this->addEmployeeLevelToCollection($employees);
        $employees = $this->getEmployeeSortedByDesignation($employees);
        $designationLevels = $employees->pluck('employee_level')->unique();
        $sortedemployees = collect();
        foreach ($designationLevels as $designationLevel) {
            $hayStack = $employees;
            $newCollection = $hayStack->filter(function ($e) use ($designationLevel) {
                $e->employee_level == $designationLevel;
                return $e->employee_level == $designationLevel;
            });
            $newCollection = $this->getEmployeeSortedByServicePeriod($newCollection);
            $sortedemployees = $sortedemployees->merge($newCollection);
        }
        return $sortedemployees;
    }
}
