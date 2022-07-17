<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingCourseModuleBatchSessionSchedule extends Model
{
    protected $fillable = [
        'training_course_module_session_id',
        'training_course_batch_id',
        'training_venue_id',
        'date',
        'start',
        'end',
        'status'
    ];

    public function session()
    {
        return $this->belongsTo(TrainingCourseModuleSession::class, 'training_course_module_session_id',
            'id')->withDefault();
    }

    public function batch()
    {
        return $this->belongsTo(TrainingCourseBatch::class, 'training_course_batch_id', 'id')->withDefault();
    }

    public function venue()
    {
        return $this->belongsTo(TrainingVenue::class, 'training_venue_id', 'id')->withDefault();
    }

    public function notification()
    {
        return $this->hasOne(
            CourseAdministrationsTraineeListEmailRecipient::class,
            'training_course_module_batch_session_schedule_id',
            'id'
        );
    }
}
