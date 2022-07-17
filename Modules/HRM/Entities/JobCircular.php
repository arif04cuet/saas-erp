<?php

namespace Modules\HRM\Entities;

use App\Entities\JobApplication;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class JobCircular extends Model
{
    protected $fillable = [
        'title',
        'unique_id',
        'job_nature',
        'job_location',
        'salary',
        'application_deadline',
        'other_requirements',
        'system_shortlist',
        'reference_number',
    ];

    public function jobCircularDetails()
    {
        return $this->hasMany(JobCircularDetail::class, 'job_circular_id', 'id');
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'circular_no', 'id');
    }

    public function qualificationRule()
    {
        return $this->hasOne(JobCircularQualificationRule::class, 'job_circular_id', 'id');
    }

    public function shortlistedJobApplications()
    {
        return $this->hasMany(JobApplication::class, 'circular_no', 'id')
            ->where('status', '=', 'short_listed');
    }

    public function jobApplicantsResult()
    {
        $query = $this->hasMany(RecruitmentExamMark::class, 'job_circular_id', 'id')
            ->select('*',
                DB::raw('IFNULL(preliminary, 0) + IFNULL(written, 0)
                                + IFNULL(aptitude, 0) + IFNULL(viva, 0) as total_marks'))
            ->orderBy('total_marks', 'desc');

        if ($this->hasPreliminaryExam()) {
            $query = $query->where('preliminary', '>=', $this->recruitmentExam->preliminary_pass);
        }

        if ($this->hasWrittenExam()) {
            $query = $query->where('written', '>=', $this->recruitmentExam->written_pass);
        }

        if ($this->hasAptitudeExam()) {
            $query = $query->where('aptitude', '>=', $this->recruitmentExam->aptitude_pass);
        }

        if ($this->hasVivaExam()) {
            $query = $query->where('viva', '>=', $this->recruitmentExam->viva_pass);
        }

        return $query;
    }

    public function admitCards()
    {
        return $this->hasMany(JobAdmitCard::class);
    }

    public function recruitmentExam()
    {
        return $this->hasOne(RecruitmentExam::class, 'job_circular_id', 'id');
    }

    public function recruitmentExamMarks()
    {
        return $this->hasMany(RecruitmentExamMark::class, 'job_circular_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

    public function hasPreliminaryExam()
    {
        return $this->recruitmentExam->preliminary_total ? true : false;
    }

    public function hasWrittenExam()
    {
        return $this->recruitmentExam->written_total ? true : false;
    }

    public function hasAptitudeExam()
    {
        return $this->recruitmentExam->aptitude_total ? true : false;
    }

    public function hasVivaExam()
    {
        return $this->recruitmentExam->viva_total ? true : false;
    }
}
