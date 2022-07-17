<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class CourseEvaluationSection extends Model
{
    protected $fillable = [
        'training_course_id',
        'title_en',
        'title_bn',
    ];

    public function subSections()
    {
        return $this->hasMany(CourseEvaluationSubSection::class, 'course_evaluation_section_id');
    }
}
