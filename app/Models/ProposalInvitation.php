<?php

namespace App\Models;

use App\Entities\Notification\NotificationType;
use App\Entities\User;


class ProposalInvitation
{
    public $recipients;
    public $model;
    public $message;
    public $url;
    public $notificationTypeId;

    public function __construct(
        $userIds,
        $model,
        $message,
        $url,
        $notificationTypeId
    )
    {
        $this->recipients = $this->getRecipients($userIds);
        $this->model = $model;
        $this->message = $message;
        $this->url = $url;
        $this->notificationTypeId = $notificationTypeId;
    }

    private function getRecipients($userIds)
    {
        return User::when($userIds, function ($query, $userIds) {
                if (is_array($userIds)) {
                    return $query->whereIn('id', $userIds);
                } else {
                    return $query->where('id', $userIds);
                }
            })
            ->where('email', '!=', '')
            ->whereNotNull('email')
            ->get();
    }

    public function hasEmailNotification() {
        $notificationType = NotificationType::find($this->notificationTypeId);

        return intval($notificationType->is_email_notification) === 1;
    }

    public function hasAppNotification()
    {
        $notificationType = NotificationType::find($this->notificationTypeId);

        return intval($notificationType->is_application_notification) === 1;
    }
}
