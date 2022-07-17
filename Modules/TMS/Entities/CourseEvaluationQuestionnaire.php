<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class CourseEvaluationQuestionnaire extends Model
{
    protected $fillable = [
        'title_en',
        'title_bn',
        'is_optional',
        'type',
        'course_evaluation_sub_section_id',
    ];

    public function subSection()
    {
        return $this->belongsTo(CourseEvaluationSubSection::class, 'course_evaluation_sub_section_id');
    }
}
