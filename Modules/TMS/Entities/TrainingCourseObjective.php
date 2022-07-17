<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingCourseObjective extends Model
{
    protected $fillable = ['training_course_id', 'type', 'content'];

}
