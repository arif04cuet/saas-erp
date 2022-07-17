<?php

namespace Modules\TMS\Entities;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;

class AnnualTrainingNotificationResponse extends Model
{
    protected $fillable = [
        "annual_training_notification_organization_id",
        'annual_training_notification_id',
        "user_id",
        "type",
        "title",
        "no_of_trainee",
        "participant_type",
        "start_date",
        "end_date",
        "remark",
        "status"
    ];

    public static function getResponseTypes($keysOnly = true)
    {
        if ($keysOnly) {
            return array_keys(config('tms.constants.annual_training.notification.response.type'));
        }
        return config('tms.constants.annual_training.notification.response.type');
    }

    public function annualTrainingNotificationOrganization()
    {
        return $this->belongsTo(AnnualTrainingNotificationOrganization::class,
            'annual_training_notification_organization_id', 'id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

}
