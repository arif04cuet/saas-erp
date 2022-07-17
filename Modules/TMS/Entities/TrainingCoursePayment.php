<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\TMS\Entities\TrainingCourse;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainingCoursePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'payment_type',
        'registration',
        'registration_amt',
        'exam',
        'exam_amt',
        'certificate_widraw',
        'certificate_widraw_amt'
    ];

    public function trainingCoursePayment()
    {
        return $this->hasOne(TrainingCourse::class, 'id', 'course_id');
    }
    
}
