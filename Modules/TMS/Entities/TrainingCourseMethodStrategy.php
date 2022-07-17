<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingCourseMethodStrategy extends Model
{
    protected $fillable = ['training_course_id', 'title', 'description'];
}
