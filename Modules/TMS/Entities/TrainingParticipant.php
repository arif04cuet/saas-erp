<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingParticipant extends Model
{
    protected $fillable = [
        'training_head_id',
        'training_id',
        'training_participant_type_id'
    ];

    public function getName()
    {
        $type = $this->type;
        if (!is_null($type)) {
            return $type->title ?? trans('labels.not_found');
        }
        return trans('labels.not_found');
    }


    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id', 'id')->withDefault();
    }

    public function trainingHead()
    {
        return $this->belongsTo(TrainingHead::class)
            ->withDefault();
    }

    public function type()
    {
        return $this->belongsTo(TrainingParticipantType::class, 'training_participant_type_id', 'id')
            ->withDefault();
    }
}
