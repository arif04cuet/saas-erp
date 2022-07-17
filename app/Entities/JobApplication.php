<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Modules\HRM\Entities\JobApplicantResearch;
use Modules\HRM\Entities\JobCircular;
use Modules\HRM\Entities\JobCircularDetail;
use Modules\HRM\Entities\RecruitmentExamMark;

class JobApplication extends Model
{
    protected $fillable = [
        'circular_no',
        'job_circular_detail_id',
        'applicant_id',
        'applicant_name',
        'applicant_name_bn',
        'national_id',
        'birth_certificate_no',
        'birth_place',
        'birth_date',
        'present_address',
        'permanent_address',
        'father_name',
        'mother_name',
        'mobile',
        'email',
        'nationality',
        'gender',
        'religion',
        'occupation',
        'extra_qualities',
        'quota',
        'bank_draft_no',
        'payment_date',
        'name_of_bank_branch',
        'is_divisional_applicant',
        'status',
    ];

    public function jobCircularDetail()
    {
        return $this->belongsTo(JobCircularDetail::class, 'job_circular_detail_id')
            ->withDefault();
    }

    public function jobCircular()
    {
        return $this->belongsTo(JobCircular::class, 'circular_no', 'id');
    }

    public function presentAddress()
    {
        return $this->belongsTo(JobApplicantAddress::class, 'present_address', 'id');
    }

    public function permanentAddress()
    {
        return $this->belongsTo(JobApplicantAddress::class, 'permanent_address', 'id');
    }

    public function educations()
    {
        return $this->hasMany(JobApplicantEducation::class);
    }

    public function pictures()
    {
        return $this->hasMany(JobApplicantPicture::class);
    }

    public function experiences()
    {
        return $this->hasMany(JobApplicantExperience::class);
    }

    public function researches()
    {
        return $this->hasMany(JobApplicantResearch::class);
    }

    public function getApplicantName()
    {
        return App::getLocale() == 'bn' ? $this->applicant_name_bn : $this->applicant_name;
    }

    public function recruitmentExamMark()
    {
        return $this->hasOne(RecruitmentExamMark::class);
    }
}
