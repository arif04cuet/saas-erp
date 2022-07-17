<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class AnnualTrainingNotification extends Model
{
    protected $fillable = ['year', 'attachment', 'attachment_file_name', 'note', 'send_to_divisional_director'];

    public function organizations()
    {
        return $this->hasMany(AnnualTrainingNotificationOrganization::class);
    }

    public static function statuses($keysOnly = true)
    {
        if ($keysOnly) {
            return array_keys(config('tms.constants.annual_training.notification.statuses'));
        }
        return config('tms.constants.annual_training.notification.statuses');
    }

    public function email()
    {
        return $this->hasOne(TrainingNotificationEmail::class);
    }
}
