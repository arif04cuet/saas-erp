<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class CourseEvaluationSubmissionDetail extends Model
{
    protected $fillable = [
        'course_evaluation_submission_id',
        'question_type',
        'training_course_objective_id',
        'course_evaluation_questionnaire_id',
        'course_evaluation_option_id',
        'answer',
        'course_evaluation_sub_section_id'
    ];

    public function submission()
    {
        return $this->belongsTo(CourseEvaluationSubmission::class, 'course_evaluation_submission_id', 'id');
    }

    public function option()
    {
        return $this->belongsTo(CourseEvaluationOption::class, 'course_evaluation_option_id', 'id');
    }

    public function questionnaire()
    {
        return $this->belongsTo(CourseEvaluationQuestionnaire::class, 'course_evaluation_questionnaire_id', 'id')->with('subSection');
    }

    public function objective()
    {
        return $this->belongsTo(TrainingCourseObjective::class, 'training_course_objective_id', 'id');
    }

    public function subSection()
    {
        return $this->belongsTo(CourseEvaluationSubSection::class, 'course_evaluation_sub_section_id');
    }

}
