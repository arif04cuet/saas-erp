<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingCertificateLink extends Model
{
    protected $fillable = [
        'trainee_id',
        'training_id',
        'unique_code',
        'public_link',
        'verified',
    ];

    public function trainee()
    {
        return $this->belongsTo(Trainee::class, 'trainee_id', 'id')->withDefault();
    }

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id', 'id')->withDefault();
    }

}
