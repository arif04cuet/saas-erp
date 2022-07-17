<?php

namespace Modules\HRM\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EmployeePersonalInfo extends Model
{
    protected $table = "employee_personal_info";
    protected $fillable = [
        "father_name",
        "mother_name",
        "title",
        "date_of_birth",
        "job_joining_date",
        "house_eligibility_date",
        "current_position_joining_date",
        "current_position_expire_date",
        "salary_scale",
        "total_salary",
        "marital_status",
        "number_of_children",
        "employee_id",
        "husband_name",
        "nid_number",
        "is_dead",
        "date_of_death",
    ];

    public function getDateOfDeathAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('j F, Y') : null;
    }
}
