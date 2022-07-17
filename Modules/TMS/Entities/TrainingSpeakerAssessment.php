<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Modules\HRM\Entities\Employee;

class TrainingSpeakerAssessment extends Model
{
    const EXCELLENT = 'Excellent';
    const VERY_GOOD = 'Good';
    const GOOD = 'Average';
    const AVERAGE = 'Poor';
    const BELOW_AVERAGE = 'Very Poor';

    protected $fillable = [
        'trainee_id',
        'training_course_id',
        'training_course_resource_id',
        'training_course_module_session_id',
        'score',
        'recommendation',
        'date',
        'good_parts',
    ];

    public function trainee()
    {
        return $this->belongsTo(Trainee::class, 'trainee_id', 'id');
    }

    public function assessmentQuestions()
    {
        return $this->belongsToMany(AssessmentQuestion::class, 'assessment_question_answers')
            ->withPivot('value');
    }

    public function session()
    {
        return $this->belongsTo(TrainingCourseModuleSession::class, 'training_course_module_session_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(TrainingCourse::class, 'training_course_id', 'id');
    }

    public function speaker()
    {
        return $this->belongsTo(TrainingCourseResource::class, 'training_course_resource_id', 'id')
            ->withDefault();
    }

    public function getAnswerForQuestion($questionName)
    {
        $questionAnswer = $this->assessmentQuestions->where('name', $questionName)->first();

        if ($score = Arr::get($questionAnswer, 'pivot.value')) {
            return $this->getScoreRepresentation($score);
        } else {
            return;
        }
    }

    public function getVerdict()
    {
        switch (1) {
            case $this->score == 100:
                return self::EXCELLENT;
            case $this->score >= 80 && $this->score <= 99:
                return self::VERY_GOOD;
            case $this->score >= 60 && $this->score <= 79:
                return self::GOOD;
            case $this->score >= 40 && $this->score <= 59:
                return self::AVERAGE;
            default:
                return self::BELOW_AVERAGE;
        }
    }

    private function getScoreRepresentation($score)
    {
        switch ($score) {
            case 5:
                return self::EXCELLENT;
            case 4:
                return self::VERY_GOOD;
            case 3:
                return self::GOOD;
            case 2:
                return self::AVERAGE;
            default:
                return self::BELOW_AVERAGE;
        }
    }
}
