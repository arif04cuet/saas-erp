<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DoptorAbleTrait;

class TrainingCourseGuest extends Model
{
    // use DoptorAbleTrait;

    protected $table = 'training_course_guests';
    protected $fillable = ['first_name', 'last_name', 'short_name', 'email', 'mobile_no','reference_entity_id'];

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
