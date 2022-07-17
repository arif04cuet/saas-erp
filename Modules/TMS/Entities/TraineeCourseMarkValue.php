<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TraineeCourseMarkValue extends Model
{
    protected $fillable = ['trainee_id', 'training_course_id', 'training_course_mark_allotment_type_id', 'value'];
}
