<?php

namespace Modules\HRM\Entities;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;
use Modules\Accounts\Entities\EmployeeContract;
use Modules\Accounts\Entities\GpfLoan;
use Modules\Accounts\Entities\EmployeeSalaryOutstanding;
use Modules\Accounts\Entities\GpfRecord;
use Modules\Accounts\Entities\MasterRoll;
use Modules\Accounts\Entities\MasterRollEmployee;
use Modules\Accounts\Entities\PostRetirementLeaveEmployee;
use Modules\TMS\Entities\TrainingCourseResource;
use Modules\VMS\Entities\VmsBillSectorAssign;
use Modules\VMS\Entities\VmsBillSectorSubmission;
use App\Traits\DoptorAbleTrait;

class Employee extends Model
{
    use DoptorAbleTrait;

    protected $table = "employees";
    protected $fillable = [
        'first_name',
        'first_name_bn',
        'last_name',
        'last_name_bn',
        'photo',
        'email',
        'gender',
        'department_id',
        'designation_id',
        'employee_id',
        'is_divisional_director',
        'status',
        'tel_office',
        'tel_home',
        'mobile_one',
        'mobile_two',
        'other_duties',
        'section_id',
        'is_retired',
        'religion_id',
    ];

    public static function getEmployeeStatus()
    {
        return config('constants.employee_available_status');
    }

    public function employeePersonalInfo()
    {
        return $this->hasOne(EmployeePersonalInfo::class);
    }

    public function employeeEducationInfo()
    {
        return $this->hasMany(EmployeeEducation::class);
    }

    public function employeeTrainingInfo()
    {
        return $this->hasMany(EmployeeTraining::class);
    }

    public function employeeNationalCourse()
    {
        return $this->hasMany(EmployeeTraining::class)->where('region', 'national')->count();
    }

    public function employeeForeignCourse()
    {
        return $this->hasMany(EmployeeTraining::class)->where('region', 'foreign')->count();
    }

    public function employeeCourseCategory()
    {
        return $this->hasMany(EmployeeTraining::class)->pluck('category');
    }


    public function employeePublicationInfo()
    {
        return $this->hasMany(EmployeePublication::class);
    }

    public function employeeSpouseChildrenInfo()
    {
        return $this->hasMany(EmployeeSpouseChildrenInfo::class);
    }

    public function employeeResearchInfo()
    {
        return $this->hasMany(EmployeeResearchInfo::class);
    }

    public function employeeInterestInfo()
    {
        return $this->hasMany(EmployeeInterest::class);
    }

    public function employeeDepartment()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function employeeSection()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

    public function user()
    {
        // return $this->hasOne(User::class);
        return $this->hasOne(User::class,'id','employee_id');
    }

    public function getName()
    {
        $firstName = $this->getFilteredName($this->first_name);
        $lastName = $this->getFilteredName($this->last_name);
        return $firstName . ' ' . $lastName;
    }

    public function getDesignation()
    {
        return $this->designation ? $this->designation->getName() : trans('labels_not_found');
    }

    public function getDepartment()
    {
        return $this->employeeDepartment->department_code;
    }

    public function getEmployeeSalaryGrade()
    {
        return optional($this->employeeContract)->salary_grade;
    }

    public function getEmployeeSalaryIncrement()
    {
        return optional($this->employeeContract)->increment;
    }

    public function getContact()
    {
        if ($this->tel_office) {
            return $this->tel_office;
        } elseif ($this->tel_home) {
            return $this->tel_home;
        } elseif ($this->mobile_one) {
            return $this->mobile_one;
        } elseif ($this->mobile_two) {
            return $this->mobile_two;
        } else {
            return null;
        }
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function religion()
    {
        return $this->belongsTo(EmployeeReligion::class, 'religion_id', 'id');
    }

    public function getFirstNameAttribute($value)
    {
        return $this->getFilteredName($value);
    }

    public function getLastNameAttribute($value)
    {
        return $this->getFilteredName($value);
    }

    private function getFilteredName($value)
    {
        $locale = $this->getLocale();
        $pattern = $this->getPattern();
        $replacement = $this->getReplacement();
        $name = preg_replace($pattern, $replacement, $value);
        if ($locale == "bengali") {
            $name = rtrim($name, ")");
        }
        return !empty($name) ? trim($name) : $value;
    }

    private function getPattern()
    {
        $locale = $this->getLocale();
        return $locale == "bengali" ? '/^[^\(]*\(/i' : '/\(.*$/i';
    }

    private function getReplacement()
    {
        return "";
    }

    private function getLocale()
    {
        return trans('hrm::employee.name.locale');
    }

    public function employeeContract()
    {
        return $this->hasOne(EmployeeContract::class, 'employee_id', 'id');
    }

    public function masterRoll()
    {
        return $this->hasOne(MasterRollEmployee::class, 'employee_id', 'id');
    }

    public function salaryOutstandings()
    {
        return $this->hasMany(EmployeeSalaryOutstanding::class, 'employee_id', 'id');
    }

    public function gpfLoans()
    {
        return $this->hasMany(GpfLoan::class);
    }

    public function gpfRecord()
    {
        return $this->hasOne(GpfRecord::class, 'employee_id', 'id');
    }

    public function postRetirementLeaveEmployee()
    {
        return $this->hasOne(PostRetirementLeaveEmployee::class, 'employee_id', 'id');
    }

    public function vmsBillSectorSubmissions()
    {
        return $this->hasMany(VmsBillSectorSubmission::class, 'employee_id', 'id');
    }

    public function vmsBillSectorAssigns()
    {
        return $this->hasMany(VmsBillSectorAssign::class, 'employee_id', 'id');
    }
}
