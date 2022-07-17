<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class JobApplicantEducation extends Model
{
    protected $table = 'job_applicant_educations';
    protected $fillable = ['job_application_id', 'level', 'exam_name', 'subject', 'institute_name', 'roll', 'course_duration', 'passing_year' , 'board_or_university', 'grade'];

    public function jobApplications()
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id', 'id');
    }
}
