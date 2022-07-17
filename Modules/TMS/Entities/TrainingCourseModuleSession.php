<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingCourseModuleSession extends Model
{
    protected $fillable = [
        'training_course_module_id',
        'title',
        'description',
        'mark',
        'session_length',
        'speaker_expire_timeline',
        'training_course_resource_id'
    ];

    public function module()
    {
        return $this->belongsTo(
            TrainingCourseModule::class,
            'training_course_module_id',
            'id'
        )->withDefault();
    }

    public function speaker()
    {
        return $this->belongsTo(
            TrainingCourseResource::class,
            'training_course_resource_id',
            'id'
        )->withDefault();
    }

    //TODO:: later it should be schedules because of multiple batches under training
    public function schedule()
    {
        return $this->hasOne(
            TrainingCourseModuleBatchSessionSchedule::class,
            'training_course_module_session_id',
            'id'
        );
    }

    public function speakers()
    {
        return $this->hasMany(
            TrainingCourseModuleSessionSpeaker::class,
            'training_course_module_session_id',
            'id'
        );
    }

    public function submissions()
    {
        return $this->hasManyThrough(
            AssessmentQuestionAnswer::class,
            TrainingSpeakerAssessment::class,
            'training_course_module_session_id',
            'training_speaker_assessment_id',
            'id',
            'id'
        );
    }

    public function assessments()
    {
        return $this->hasMany(TrainingSpeakerAssessment::class, 'training_course_module_session_id', 'id');
    }
}
