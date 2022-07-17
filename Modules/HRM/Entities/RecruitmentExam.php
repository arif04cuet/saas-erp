<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class RecruitmentExam extends Model
{
    protected $fillable = [
        'job_circular_id',
        'preliminary_total',
        'preliminary_pass',
        'written_total',
        'written_pass',
        'aptitude_total',
        'aptitude_pass',
        'viva_total',
        'viva_pass',
        'status'
    ];

    public function circular()
    {
        return $this->belongsTo(JobCircular::class, 'job_circular_id', 'id');
    }
}
