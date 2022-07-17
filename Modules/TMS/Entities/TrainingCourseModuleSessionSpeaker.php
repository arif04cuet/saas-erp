<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingCourseModuleSessionSpeaker extends Model
{
    protected $fillable = [
        'training_course_module_session_id',
        'training_course_resource_id',
    ];

    public function session()
    {
        return $this->belongsTo(
            TrainingCourseModuleSession::class,
            'training_course_module_session_id',
            'id'
        );
    }

    public function speaker()
    {
        return $this->belongsTo(
            TrainingCourseResource::class,
            'training_course_resource_id',
            'id'
        );
    }
}
