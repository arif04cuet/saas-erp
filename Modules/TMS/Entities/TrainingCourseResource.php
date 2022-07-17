<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class TrainingCourseResource extends Model
{
    protected $table = 'training_course_resources';
    protected $fillable = [
        'training_course_id',
        'reference_entity',
        'reference_entity_id',
        'short_name',
        'should_be_evaluated'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'reference_entity_id', 'id');
    }

    public function guest()
    {
        return $this->belongsTo(TrainingCourseGuest::class, 'reference_entity_id', 'id')
            ->withDefault();
    }

    public function getResourceName()
    {
        if ($this->reference_entity === Employee::class) {
            if ($this->employee()->first() != null) {
                return $this->employee()->first()->getName();
            } else {
                return "No name Found";
            }

        } else {
            if (!is_null($this->guest)) {
                return $this->guest->getFullName() ?? trans('labels.not_found');
            } else {
                return trans('labels.not_found');
            }
        }
    }

    public function schedules()
    {
        return $this->hasMany(TrainingCourseScheduledSessionsSpeakerEmailRecipient::class,
            'training_course_resource_id', 'id');
    }

    public function getResource()
    {
        if ($this->reference_entity === Employee::class) {
            return $this->employee()->first();
        } else {
            return $this->guest()->first();
        }
    }
}


