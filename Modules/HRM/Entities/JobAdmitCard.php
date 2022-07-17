<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class JobAdmitCard extends Model
{
    protected $fillable = ['job_circular_id', 'exam_type', 'date_of_exam', 'exam_center', 'location'];

    public function circular()
    {
        return $this->belongsTo(JobCircular::class, 'job_circular_id', 'id');
    }
}
