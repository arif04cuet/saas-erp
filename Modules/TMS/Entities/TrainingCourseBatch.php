<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HM\Entities\Room;

class TrainingCourseBatch extends Model
{
    protected $fillable = [
        'training_course_id',
        'title',
        'start_date',
        'end_date',
        'no_of_trainees',
    ];

    public function course()
    {
        return $this->belongsTo(TrainingCourse::class, 'training_course_id', 'id');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'training_course_batch_rooms');
    }
}
