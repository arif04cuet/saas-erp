<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/30/19
 * Time: 7:18 PM
 */

namespace App\Entities\Notification;


use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    protected $table = 'notification_types';

    protected $fillable = ['name', 'description', 'is_application_notification', 'is_email_notification', 'is_sms_notification', 'icon_name'];
}
