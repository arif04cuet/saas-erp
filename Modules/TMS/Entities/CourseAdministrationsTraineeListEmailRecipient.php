<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class CourseAdministrationsTraineeListEmailRecipient extends Model
{
    protected $fillable = [
        'training_course_module_batch_session_schedule_id',
        'status'
    ];

    public function schedule()
    {
        return $this->belongsTo(
            TrainingCourseModuleBatchSessionSchedule::class,
            'training_course_module_batch_session_schedule_id',
            'id'
        );
    }
}
