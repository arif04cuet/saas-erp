<?php

namespace Modules\HM\Services;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Entities\Notification\Notification;
use App\Entities\Notification\NotificationType;
use Illuminate\Database\Eloquent\Model;
use Modules\VMS\Entities\Trip;

class HostelNotificationService
{
    private $notificationType;

    public function __construct($notificationType)
    {
        $this->setNotificationType($notificationType);
    }

    public function getNotificationType()
    {
        return $this->notificationType;
    }

    public function sendNotification(
        Model $model,
        $fromUserId,
        $toUserId,
        $message,
        $route
    ) {
        $notificationType = $this->getNotificationType();
        if (!is_null($notificationType)) {
            if ($toUserId) {
                $notification = Notification::create([
                    'type_id' => $notificationType->id,
                    'ref_table_id' => $model->id,
                    'from_user_id' => $fromUserId,
                    'to_user_id' => $toUserId,
                    'message' => $message,
                    'item_url' => $route
                ]);
            }
        }
    }

    /**
     * @param $type
     * @throws \Exception
     */
    private function setNotificationType($type)
    {
        $this->notificationType = NotificationType::where('name', $type)->first();
        if (is_null($this->notificationType)) {
            $this->notificationType = null;
            throw  new \Exception('No Notification Type Found For ' . $type . ' !');
        }
    }


}

