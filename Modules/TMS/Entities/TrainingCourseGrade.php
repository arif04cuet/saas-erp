<?php

namespace Modules\TMS\Entities;

use Modules\TMS\Entities\TrainingCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainingCourseGrade extends Model
{
    use HasFactory;

    protected $fillable = ['training_course_id','grading_mark','grade'];

    public function course()
    {
        return $this->belongsTo(TrainingCourse::class, 'id', 'training_course_id');
    }
    
}
