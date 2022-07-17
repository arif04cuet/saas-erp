<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class AnnualTrainingNotificationOrganization extends Model
{
    protected $fillable = [
        'annual_training_notification_id',
        'training_organization_id',
        'unique_key',
        'date_of_response',
        'last_date_of_response',
        'status'
    ];

    public function organization()
    {
        return $this->belongsTo(TrainingOrganization::class, 'training_organization_id', 'id')
            ->withDefault();
    }

    public function annualTrainingNotification()
    {
        return $this->belongsTo(AnnualTrainingNotification::class, 'annual_training_notification_id', 'id')
            ->withDefault();
    }

    public function annualTrainingNotificationResponses()
    {
        return $this->hasMany(AnnualTrainingNotificationResponse::class, 'annual_training_notification_organization_id',
            'id');
    }

}
