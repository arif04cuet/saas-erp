<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingCourseModule extends Model
{
    protected $fillable = [
        'training_course_id',
        'title',
        'description',
        'mark',
    ];

    public function course()
    {
        return $this->belongsTo(TrainingCourse::class, 'training_course_id', 'id')->withDefault();
    }

    public function sessions()
    {
        return $this->hasMany(TrainingCourseModuleSession::class, 'training_course_module_id', 'id');
    }
}
