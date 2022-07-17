<?php

namespace App\Listeners;

use App\Events\NotificationGeneration;
use App\Repositories\Notification\NotificationTypeRepository;
use App\Services\Notification\NotificationGeneratorFactory;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotification
{
    private $notificationTypeRepository;

    /**
     * Create the event listener.
     *
     * @param NotificationTypeRepository $notificationTypeRepository
     */
    public function __construct(NotificationTypeRepository $notificationTypeRepository)
    {
        $this->notificationTypeRepository = $notificationTypeRepository;
    }

    /**
     * Handle the event.
     *
     * @param  NotificationGeneration $event
     * @return void
     * @throws \Exception
     */
    public function handle(NotificationGeneration $event)
    {
        $notificationInfo = $event->notificationInfo;
        $notificationType = $this->notificationTypeRepository->findOneBy(['name' => $notificationInfo->notificationType]);
        if (!$notificationType)
            throw new \Exception('Please add notification type to database');
        $notifier = NotificationGeneratorFactory::getNotificationGenerator($notificationType->name);
        $notifier->notify($notificationInfo, $notificationType);
    }
}
