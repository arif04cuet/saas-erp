<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 2/5/19
 * Time: 6:34 PM
 */

namespace App\Services\Notification;


interface EmailNotifiable
{
    public function sendEmailNotification($data);
}
