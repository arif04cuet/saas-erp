<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 2/5/19
 * Time: 4:44 PM
 */

namespace App\Models;


class NotificationInfo
{
    public $notificationType;

    public $dynamicValues;


    /**
     * NotificationInfo constructor.
     * @param $notificationType
     * @param $dynamicValues
     */
    public function __construct($notificationType, $dynamicValues)
    {
        $this->notificationType = $notificationType;
        $this->dynamicValues = $dynamicValues;
    }


    /**
     * @return mixed
     */
    public function getNotificationType()
    {
        return $this->notificationType;
    }

    /**
     * @param mixed $notificationType
     */
    public function setNotificationType($notificationType): void
    {
        $this->notificationType = $notificationType;
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
}
