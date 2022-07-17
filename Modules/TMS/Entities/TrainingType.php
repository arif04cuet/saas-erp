<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DoptorAbleTrait;

class TrainingType extends Model
{
    use DoptorAbleTrait;

    protected $fillable = [
        'name_english',
        'name_bangla',
        'parent_id',
        'status',
    ];

    public static function getLevels()
    {
        return config('tms.training.level');
    }

    public function getName()
    {
        if (app()->isLocale('bn')) {
            return $this->name_bangla ?? trans('labels.not_found');
        }
        return $this->name_english ?? trans('labels.not_found');
    }

    public function children()
    {
        return $this->hasMany(TrainingType::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(TrainingType::class, 'parent_id', 'id');
    }


    // relations

    public function trainingSponsors()
    {
        // only one sponsor is taken while creating data
        return $this->hasMany(TrainingSponsor::class, 'training_head_id', 'id');
    }

    public function trainingParticipants()
    {
        return $this->hasMany(TrainingParticipant::class, 'training_head_id', 'id');
    }

    // A training head can have multiple training, just like a training can have multiple course
    public function trainings()
    {
        return $this->hasMany(Training::class, 'training_head_id', 'id');
    }

    public function trainingOrganizations()
    {
        return $this->belongsToMany(TrainingOrganization::class, 'training_sponsors');
    }
}
