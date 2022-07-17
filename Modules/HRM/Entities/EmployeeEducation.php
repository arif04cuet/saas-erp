<?php

    namespace Modules\HRM\Entities;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class EmployeeEducation extends Model
    {
        use SoftDeletes;
        protected $table = "employee_educations";
        protected $fillable = [
            "academic_institute_id",
            "academic_department_id",
            "academic_degree_id",
            "passing_year",
            "medium",
            "duration",
            "result",
            "achievement",
            "employee_id",
        ];


        public function institutes()
        {
            return $this->belongsTo(AcademicInstitute::class, 'academic_institute_id', 'id');
        }

        public function academicDepartment()
        {
            return $this->belongsTo(AcademicDepartment::class, 'academic_department_id', 'id');
        }

        public function academicDegree()
        {
            return $this->belongsTo(AcademicDegree::class, 'academic_degree_id', 'id');
        }


    }
