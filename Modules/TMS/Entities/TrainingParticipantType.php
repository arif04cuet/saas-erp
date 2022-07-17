<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\TMS\Entities\TrainingCourse;

class TrainingParticipantType extends Model
{
    protected $fillable = [
        'title',
        'bangla_title',
        'label',
        'bangla_label'
    ];


    public function getTitle()
    {
        if (app()->isLocale('bn')) {
            return $this->bangla_title ?? trans('labels.not_found');
        }
        return $this->title ?? trans('labels.not_found');
    }
    public function participantType()
    {
        return $this->belongsTo(TrainingCourse::class, 'id', 'trainee_type');
    }

    public function getLabel()
    {
        if (app()->isLocale('bn')) {
            return $this->bangla_label ?? trans('labels.not_found');
        }
        return $this->label ?? trans('labels.not_found');
    }


}
