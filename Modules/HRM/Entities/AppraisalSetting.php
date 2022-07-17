<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AppraisalSetting extends Model
{
    protected $fillable = ['reporter_id', 'signer_id', 'commenter_id'];

    public function reporter()
    {
        return $this->belongsTo(Employee::class, 'reporter_id', 'id');
    }

    public function signer()
    {
        return $this->belongsTo(Employee::class, 'signer_id', 'id');
    }

    public function commenter()
    {
        return $this->belongsTo(Employee::class, 'commenter_id', 'id');
    }

    public function reviewees()
    {
        return $this->hasMany(AppraisalReviewee::class, 'appraisal_setting_id', 'id');
    }

    public function getRevieweeNames()
    {
        return $this->reviewees()->get()->map(function ($reviewee) {
            return optional($reviewee->employee)->getName();
        })->implode(', ');
    }
}
