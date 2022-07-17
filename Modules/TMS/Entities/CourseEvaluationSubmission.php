<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class CourseEvaluationSubmission extends Model
{
    protected $fillable = [
        'training_course_id',
        'trainee_id',
    ];

    public function details()
    {
        return $this->hasMany(CourseEvaluationSubmissionDetail::class, 'course_evaluation_submission_id', 'id')->with('option');
    }

    public function courses()
    {
        return $this->belongsTo(TrainingCourse::class, 'training_course_id')->with('training','resources');
    }

    public function trainee()
    {
        return $this->belongsTo(Trainee::class, 'trainee_id');
    }
}
