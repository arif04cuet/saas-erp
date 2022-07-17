<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingSponsor extends Model
{
    protected $fillable = ['training_id', 'training_organization_id'];

    public function getName()
    {
        $org = $this->organization;
        if (!is_null($org)) {
            return $org->name ?? trans('labels.not_found');
        }
        return trans('labels.not_found');
    }

    public function organization()
    {
        return $this->belongsTo(TrainingOrganization::class, 'training_organization_id', 'id')
            ->withDefault();
    }

    public function trainingHead()
    {
        return $this->belongsTo(TrainingHead::class)
            ->withDefault();
    }
}
