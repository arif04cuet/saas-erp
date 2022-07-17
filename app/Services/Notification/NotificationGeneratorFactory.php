<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 2/5/19
 * Time: 6:59 PM
 */

namespace App\Services\Notification;


use App\Constants\NotificationType;
use App\Services\Notification\Generators\BaseNotificationGenerator;

abstract class NotificationGeneratorFactory
{
    public static function getNotificationGenerator($notificationType): BaseNotificationGenerator
    {
        switch ($notificationType) {
            case NotificationType::RESEARCH_PROPOSAL_SUBMISSION:
                return app()->make('App\Services\Notification\Generators\ResearchProposalNotificationGenerator');
        }
        switch ($notificationType) {
            case NotificationType::PROJECT_PROPOSAL_SUBMISSION:
                return app()->make('App\Services\Notification\Generators\ProjectProposalNotificationGenerator');
        }
    }
}
