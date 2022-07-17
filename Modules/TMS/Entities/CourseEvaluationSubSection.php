<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class CourseEvaluationSubSection extends Model
{
    protected $fillable = [
        'title_en',
        'title_bn',
        'label_en',
        'label_bn',
        'objective_en',
        'objective_bn',
        'course_evaluation_section_id',
        'is_option_enabled',
    ];

    public function courseObjectives()
    {
        return $this->hasMany(TrainingCourseObjective::class, 'sub_section_id');
    }

    public function questionnaires()
    {
        return $this->hasMany(CourseEvaluationQuestionnaire::class, 'course_evaluation_sub_section_id');
    }

    public function options()
    {
        return $this->hasMany(CourseEvaluationOption::class, 'course_evaluation_sub_section_id');
    }

    public function evaluationSubmissionDetails()
    {
        return $this->hasMany(CourseEvaluationSubmissionDetail::class, 'course_evaluation_sub_section_id');
    }


}
