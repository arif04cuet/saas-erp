<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingCourseSessionsEvaluationTraineeWarningEmailRecipient extends Model
{
    protected $table = 'trainee_warning_email_recipients';

    protected $fillable = [
        'trainee_id',
        'training_course_module_batch_session_schedule_id',
        'status',
    ];

    public function trainee()
    {
        return $this->belongsTo(Trainee::class, 'trainee_id', 'id');
    }

    public function schedule()
    {
        return $this->belongsTo(
            TrainingCourseModuleBatchSessionSchedule::class,
            'training_course_module_batch_session_schedule_id',
            'id'
        );
    }
}
