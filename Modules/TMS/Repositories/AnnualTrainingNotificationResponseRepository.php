<?php


namespace Modules\TMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\TMS\Entities\AnnualTrainingNotificationResponse;

class AnnualTrainingNotificationResponseRepository extends AbstractBaseRepository
{
    protected $modelName = AnnualTrainingNotificationResponse::class;


    /**
     * @param $notifiedOrganizationId
     * @param $notificationId
     * @return mixed
     */
    public function removeOrganizationResponseOfNotification($notifiedOrganizationId, $notificationId)
    {
        return $this->model
            ->newQuery()
            ->where('annual_training_notification_organization_id', $notifiedOrganizationId)
            ->where('annual_training_notification_id', $notificationId)
            ->delete();
    }

    /**
     * @param $notificationId
     * @param $userId
     * @return mixed
     */
    public function removeUserResponse($userId, $notificationId)
    {
        return $this->model
            ->newQuery()
            ->where('user_id', $userId)
            ->where('annual_training_notification_id', $notificationId)
            ->delete();
    }

    public function getOldResponsesForOrganization($annualTrainingNotificationOrganizationId)
    {
        return $this->model->newQuery()
            ->where('annual_training_notification_organization_id', $annualTrainingNotificationOrganizationId)
            ->get();
    }

    public function getOldResponsesForUser($userId, $notificationId)
    {
        return $this->model->newQuery()
            ->where('annual_training_notification_id', $notificationId)
            ->where('user_id', $userId)
            ->get();
    }


}
