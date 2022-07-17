<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class CourseEvaluationSetting extends Model
{
    protected $fillable = [
        'training_course_id',
        'status',
        'start_date',
        'end_date',
    ];
}
