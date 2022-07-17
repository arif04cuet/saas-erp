<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingCourseRuleGuideline extends Model
{
    protected $fillable = ['training_course_id', 'type', 'content'];
}
