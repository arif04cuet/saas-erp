<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/27/19
 * Time: 8:37 PM
 */

namespace App\Models;


class DashboardItem
{
    public $featureName;
    public $featureItemId;
    public $workFlowMasterId;
    public $dynamicValues;
    public $checkUrl;
    public $workFlowConversationId;
    public $workFlowMasterStatus;
    public $reInitiationUrl;
    public $message;
    public $remarks;
    public $closeUrl;

    /**
     * @return mixed
     */
    public function getFeatureName()
    {
        return $this->featureName;
    }

    /**
     * @param mixed $featureName
     */
    public function setFeatureName($featureName): void
    {
        $this->featureName = $featureName;
    }

    /**
     * @return mixed
     */
    public function getFeatureItemId()
    {
        return $this->featureItemId;
    }

    /**
     * @param mixed $featureItemId
     */
    public function setFeatureItemId($featureItemId): void
    {
        $this->featureItemId = $featureItemId;
    }

    /**
     * @return mixed
     */
    public function getWorkFlowMasterId()
    {
        return $this->workFlowMasterId;
    }

    /**
     * @param mixed $workFlowMasterId
     */
    public function setWorkFlowMasterId($workFlowMasterId): void
    {
        $this->workFlowMasterId = $workFlowMasterId;
    }

    /**
     * @return mixed
     */
    public function getDynamicValues()
    {
        return $this->dynamicValues;
    }

    /**
     * @param mixed $dynamicValues
     */
    public function setDynamicValues($dynamicValues): void
    {
        $this->dynamicValues = $dynamicValues;
    }

    /**
     * @return mixed
     */
    public function getCheckUrl()
    {
        return $this->checkUrl;
    }

    /**
     * @param mixed $checkUrl
     */
    public function setCheckUrl($checkUrl): void
    {
        $this->checkUrl = $checkUrl;
    }


    /**
     * @return mixed
     */
    public function getWorkFlowConversationId()
    {
        return $this->workFlowConversationId;
    }

    /**
     * @param mixed $workFlowConversationId
     */
    public function setWorkFlowConversationId($workFlowConversationId): void
    {
        $this->workFlowConversationId = $workFlowConversationId;
    }

    /**
     * @return mixed
     */
    public function getWorkFlowMasterStatus()
    {
        return $this->workFlowMasterStatus;
    }

    /**
     * @param mixed $workFlowMasterStatus
     */
    public function setWorkFlowMasterStatus($workFlowMasterStatus): void
    {
        $this->workFlowMasterStatus = $workFlowMasterStatus;
    }

    /**
     * @return mixed
     */
    public function getReInitiationUrl()
    {
        return $this->reInitiationUrl;
    }

    /**
     * @param mixed $reInitiationUrl
     */
    public function setReInitiationUrl($reInitiationUrl): void
    {
        $this->reInitiationUrl = $reInitiationUrl;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * @param mixed $remarks
     */
    public function setRemarks($remarks): void
    {
        $this->remarks = $remarks;
    }

    /**
     * @return mixed
     */
    public function getCloseUrl()
    {
        return $this->closeUrl;
    }

    /**
     * @param mixed $closeUrl
     */
    public function setCloseUrl($closeUrl): void
    {
        $this->closeUrl = $closeUrl;
    }
}
