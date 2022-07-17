<?php

namespace Modules\TMS\Entities;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Modules\TMS\Entities\TrainingVenue;
use Modules\TMS\Entities\TrainingCourse;

class TrainingCourseBreak extends Model
{
    protected $fillable = [
        'training_course_id',
        'title',
        'start_time',
        'end_time',
        'entity_id',
        'entity_type',
    ];

    public function course()
    {
        return $this->belongsTo(TrainingCourse::class, 'training_course_id', 'id');
    }

    public function venue()
    {
        return $this->belongsTo(TrainingVenue::class, 'entity_id', 'id');
    }

    public function cafeteria()
    {
        return $this->belongsTo(TrainingCafeteria::class, 'entity_id', 'id');
    }

    public function scheduledVenue()
    {
        if($this->entity_type == TrainingVenue::class) {
            return $this->venue()->first();
        }else {
            return $this->cafeteria()->first();
        }
    }

    public function scheduledVenueTitle()
    {
        if($this->entity_type == TrainingVenue::class) {
            $scheduledVenue = $this->scheduledVenue();
            return App::isLocale('bn')? $scheduledVenue->title_bn : $scheduledVenue->title;
        }else{
            $scheduledVenue = $this->scheduledVenue();
            return App::isLocale('bn')? $scheduledVenue->name : $scheduledVenue->name;
        }
        
    }

    public function getRecurringEventId()
    {
        if($this->entity_type == TrainingVenue::class) {
            return "venue_recurring_event_" . $this->venue()->first()->id;
        }else {
            return "cafeteria_recurring_event_" . $this->cafeteria()->first()->id;
        }
    }

    public function getRecurringEventResourceId()
    {
        if($this->entity_type == TrainingVenue::class) {
            return $this->venue()->first()->id;
        }else {
            return "cafeteria_recurring_resource_" . $this->cafeteria()->first()->id;
        }
    }
}
