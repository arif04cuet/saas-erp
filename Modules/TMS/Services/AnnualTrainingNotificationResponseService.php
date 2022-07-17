<?php

namespace Modules\TMS\Services;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\TMS\Entities\AnnualTrainingNotification;
use Modules\TMS\Entities\AnnualTrainingNotificationOrganization;
use Modules\TMS\Entities\AnnualTrainingNotificationResponse;
use Modules\TMS\Repositories\AnnualTrainingNotificationOrganizationRepository;
use Modules\TMS\Repositories\AnnualTrainingNotificationResponseRepository;

class AnnualTrainingNotificationResponseService
{
    use CrudTrait;

    /**
     * @var AnnualTrainingNotificationOrganizationRepository
     */
    private $annualTrainingNotificationOrganizationRepository;

    public function __construct(
        AnnualTrainingNotificationResponseRepository $annualTrainingNotificationResponseRepository,
        AnnualTrainingNotificationOrganizationRepository $annualTrainingNotificationOrganizationRepository
    ) {
        $this->setActionRepository($annualTrainingNotificationResponseRepository);
        $this->annualTrainingNotificationOrganizationRepository = $annualTrainingNotificationOrganizationRepository;
    }

    public function getOrganizationByUniqueKey($uniqueKey)
    {
        return $this->annualTrainingNotificationOrganizationRepository->getOrganizationByUniqueKey($uniqueKey);
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $responseData = $this->prepareResponseDataFromArray($data);
            $this->cleanPreviousData($data);
            foreach ($responseData as $responseDatum) {
                $this->save($responseDatum->toArray());
            }
            $this->updateRelatedValues($responseData->first()->toArray());
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Training Notification Response Error: " . $e->getMessage() . " Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * @param AnnualTrainingNotificationOrganization $annualTrainingNotificationOrganization
     * @return bool
     */
    public function isOrganizationNotificationExpired(
        AnnualTrainingNotificationOrganization $annualTrainingNotificationOrganization
    ) {
        return Carbon::parse($annualTrainingNotificationOrganization->last_date_of_response)->isPast();
    }

    /**
     * @param AnnualTrainingNotificationOrganization $annualTrainingNotificationOrganization
     * @return mixed
     */
    public function getOldResponsesForOrganization(
        AnnualTrainingNotificationOrganization $annualTrainingNotificationOrganization
    ) {
        return $this->actionRepository->getOldResponsesForOrganization($annualTrainingNotificationOrganization->id);
    }

    /**
     * @param $userId
     * @param $notificationId
     * @return mixed
     */
    public function getOldResponsesForUser($userId, $notificationId)
    {
        return $this->actionRepository->getOldResponsesForUser($userId, $notificationId);
    }

    public function clearSessionValues()
    {
        if (session()->has('_old_input.response')) {
            session()->forget('_old_input.response');
        }
    }

    //------------------------------------------------------------------------------
    //                                   private methods
    //-------------------------------------------------------------------------------

    private function prepareResponseDataFromArray(array $requestData)
    {
        $responseTypes = AnnualTrainingNotificationResponse::getResponseTypes();
        $masterData = collect();
        foreach ($requestData['response'] as $data) {
            $eachResponse = collect($data);
            $eachResponse['annual_training_notification_id']
                = $requestData['annual_training_notification_id'];
            if ($requestData['type'] == $responseTypes[0]) {
                $eachResponse['annual_training_notification_organization_id']
                    = $requestData['annual_training_notification_organization_id'];
                $eachResponse['type'] = $responseTypes[0];
            } else {
                $eachResponse['user_id']
                    = $requestData['user_id'];
                $eachResponse['type'] = $responseTypes[1];
            }
            $masterData[] = $eachResponse;
        }
        return $masterData;
    }

    /**
     * Clean Previous Records
     * @param array $data
     */
    private function cleanPreviousData(array $data)
    {
        $type = $data['type'];
        $responseTypes = AnnualTrainingNotificationResponse::getResponseTypes();
        if ($type == $responseTypes[0]) {
            // response by organization
            $this->actionRepository->removeOrganizationResponseOfNotification($data['annual_training_notification_organization_id'],
                $data['annual_training_notification_id']);
        } else {
            // response by user
            $this->actionRepository->removeUserResponse($data['user_id'], $data['annual_training_notification_id']);
        }
    }

    /**
     * Update Related values - [annual_training_notification_organizationss]
     * @param array $data
     */
    private function updateRelatedValues(array $data)
    {
        $type = $data['type'];
        $responseTypes = AnnualTrainingNotificationResponse::getResponseTypes(false);
        if ($type == strtolower($responseTypes['organization'])) {
            // organization
            $notificationStatus = AnnualTrainingNotification::statuses(false);
            $respondStatus = strtolower($notificationStatus['responded']);
            $notifiedOrganization = $this->annualTrainingNotificationOrganizationRepository
                ->findOne($data['annual_training_notification_organization_id']);
            $this->annualTrainingNotificationOrganizationRepository->update($notifiedOrganization,
                ['status' => $respondStatus, 'date_of_response' => Carbon::now()->toDateTimeString()]);
        } else {
            // should it be updated for user level too ? design does not support
        }
    }
}

