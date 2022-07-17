<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 2/5/19
 * Time: 6:31 PM
 */

namespace App\Services\Notification\Generators;


use App\Entities\Notification\NotificationType;
use App\Models\NotificationInfo;

abstract class BaseNotificationGenerator
{
    abstract public function notify(NotificationInfo $notificationInfo, NotificationType $notificationType);
}
