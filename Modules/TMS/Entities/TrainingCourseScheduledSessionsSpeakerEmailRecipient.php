<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingCourseScheduledSessionsSpeakerEmailRecipient extends Model
{
    protected $fillable = [
        'training_course_resource_id',
        'training_course_module_batch_session_schedule_id',
        'status',
    ];

    public function resource()
    {
        return $this->belongsTo(TrainingCourseResource::class, 'training_course_resource_id', 'id');
    }

    public function schedule()
    {
        return $this->belongsTo(TrainingCourseModuleBatchSessionSchedule::class,
            'training_course_module_batch_session_schedule_id', 'id');
    }
}
