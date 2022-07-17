<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 2/5/19
 * Time: 6:35 PM
 */

namespace App\Services\Notification;


interface SystemNotifiable
{
    public function saveAppNotification($data);
}
