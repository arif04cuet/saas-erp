<?php

namespace Modules\HRM\Entities;

use App\Entities\JobApplication;
use Illuminate\Database\Eloquent\Model;

class RecruitmentExamMark extends Model
{
    protected $fillable = [
        'job_circular_id', 
        'job_application_id',
        'preliminary',
        'written',
        'aptitude',
        'viva'
    ];

    public function jobApplicant()
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id', 'id');
    }
}
