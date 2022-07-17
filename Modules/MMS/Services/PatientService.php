<?php

namespace Modules\MMS\Services;

use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use App\Entities\Role;
use App\Services\UserService;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use App\Utilities\DropDownDataFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Services\CalendarEventService;
use Modules\MMS\Repositories\PatientRepository;
use Modules\HRM\Repositories\DesignationRepository;
use Modules\HRM\Repositories\EmployeeRepository;
use Modules\HRM\Entities\Employee;
use Modules\HRM\Entities\Designation;
use DB;

class PatientService
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
     * @var $patientRepository
     */

    private $patientRepository;

    /**
     * EmployeeService constructor.
     *
     * @param EmployeeRepository $employeeRepository
     * @param UserService $userService
     * @param CalendarEventService $calendarEventService
     * @param DesignationRepository $designationRepository
     * @param PatientRepository $patientRepository
     */
    public function __construct(
        EmployeeRepository $employeeRepository,
        UserService $userService,
        CalendarEventService $calendarEventService,
        DesignationRepository $designationRepository,
        PatientRepository $patientRepository
    )
    {
        $this->employeeRepository = $employeeRepository;
        $this->userService = $userService;
        $this->calendarEventService = $calendarEventService;
        $this->designationRepository = $designationRepository;
        $this->patientRepository = $patientRepository;
        $this->setActionRepository($this->patientRepository);
    }


    /**
     * @param Closure $implementedValue Anonymous Implementation of Value
     * @param Closure $implementedKey Anonymous Implementation Key index
     * @param array|null $query
     * @param bool $isEmptyOption
     * @return array
     */
    public function getRelativeForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    )
    {
        $relative = $query ? $this->patientRepository->findBy($query) : $this->patientRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $relative,
            $implementedKey ?: function ($relative) {
                return $relative->patient_id;
            },
            $implementedValue ?: function ($relative) {
                return $relative->name;
            },
            $isEmptyOption
        );
    }


    /**
     * @param Closure|null $implementedValue
     * @param Closure|null $implementedKey
     * @param array|null $query
     * @param false $isEmptyOption
     * @return array
     */
    public function getEmployeesForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    )
    {
        $departments = DB::table('employees')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->groupBy('department_id')->get();
        $result = array();
        foreach ($departments as $depId) {
            $emInfo = $this->employeeRepository->getClassEmployeeByDepartments($depId->department_id);
            $result[] = ['id' => $depId->employee_id, 'name' => $depId->name, 'data' => $emInfo];

        }
        return $result;

    }

    /**
     * @param Closure|null $implementedValue
     * @param Closure|null $implementedKey
     * @param array|null $query
     * @param false $isEmptyOption
     * @return array
     */
    public function getPatientForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    )
    {
        $patients = $this->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $patients,
            $implementedKey ?: function ($patients) {
                return $patients->patient_id;
            },
            $implementedValue ?: function ($patients) {
                return $patients->name . ' - ' . $patients->mobile_no;
            },
            $isEmptyOption
        );

    }

    /**
     * @param $data
     * @return array|bool
     */
    public function store($data)
    {
        $save = $this->save($data);
        if ($save) {
            Session::flash('success', trans('mms::patient.patient_registration'));
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return false;
        }
        return $this->sendNotification($save);
    }


    public function sendNotification($patientData)
    {
        $notificationTypeName = 'MMS_PATIENT_REGISTRATION';
        $notificationType = NotificationType::firstOrNew(['name' => \App\Constants\NotificationType::getConstant($notificationTypeName)]);
        if (!isset($notificationType->id)) {
            $notificationType->name = \App\Constants\NotificationType::getConstant($notificationTypeName);
            $notificationType->save();
        }
        $roles = Role::where('name', 'ROLE_DOCTOR')->first();
        if (!empty($roles)) {
            foreach ($roles->users as $role) {
                $baseUrl = route('prescriptions.create').'?id=' . $patientData->patient_id;
                Notification::create([
                    'type_id' => $notificationType->id,
                    'ref_table_id' => $patientData->id,
                    'from_user_id' => Auth::id(),
                    'to_user_id' => $role->id,
                    'message' => trans('mms::patient.doctor_notification') . $patientData->name,
                    'item_url' => $baseUrl
                ]);
            }
            return true;
        }
        return false;
    }

}

