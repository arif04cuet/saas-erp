<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class CourseEvaluationOption extends Model
{
    protected $fillable = [
        'title_en',
        'title_bn',
        'mark',
        'course_evaluation_sub_section_id',
    ];
}
