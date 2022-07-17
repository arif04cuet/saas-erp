<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 2/5/19
 * Time: 6:36 PM
 */

namespace App\Services\Notification;


interface SmsNotifiable
{
    public function sendSms();
}
