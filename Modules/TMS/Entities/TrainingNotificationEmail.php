<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingNotificationEmail extends Model
{
    public $timestamps =  false;

    protected $fillable = ['annual_training_notification_id', 'email_content', 'created_at'];

}
