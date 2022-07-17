<?php

namespace Modules\TMS\Entities;

use App\Events\NotifyCourseAdministration;
use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class TrainingCourseAdministration extends Model
{
    protected $fillable = ['training_id', 'training_course_id', 'employee_id', 'role'];

    protected $dispatchesEvents = [
        'created' => NotifyCourseAdministration::class,
        'updated' => NotifyCourseAdministration::class,
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id')->withDefault();
    }

    public function trainingCourse()
    {
        return $this->belongsTo(TrainingCourse::class, 'training_course_id', 'id')->withDefault();
    }

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id', 'id')->withDefault();
    }

}
