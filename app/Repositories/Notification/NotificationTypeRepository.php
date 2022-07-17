<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 2/5/19
 * Time: 6:19 PM
 */

namespace App\Repositories\Notification;


use App\Entities\Notification\NotificationType;
use App\Repositories\AbstractBaseRepository;

class NotificationTypeRepository extends AbstractBaseRepository
{
    protected $modelName = NotificationType::class;
}
