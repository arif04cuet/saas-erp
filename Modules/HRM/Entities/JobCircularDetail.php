<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class JobCircularDetail extends Model
{
    protected $fillable = [
        'job_circular_id',
        'designation_id',
        'salary_grade',
        'vacancy_no',
        'max_age',
        'max_age_divisional_employee',
        'max_age_quota_employee',
        'educational_requirement',
        'experience_requirement',
        'job_responsibility',
        'common_qualification'
    ];

    public function jobCircular()
    {
        return $this->belongsTo(JobCircular::class, 'job_circular_id', 'id')
            ->withDefault();
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id')->withDefault();
    }
}
