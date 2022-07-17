<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingCourseMarkAllotment extends Model
{
    protected $fillable = [
        'training_course_id',
        'training_course_mark_allotment_type_id',
        'description',
        'mark',
    ];

    public function type()
    {
        return $this->belongsTo(TrainingCourseMarkAllotmentType::class, 'training_course_mark_allotment_type_id', 'id');
    }
}
