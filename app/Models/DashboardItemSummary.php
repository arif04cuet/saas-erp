<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/27/19
 * Time: 8:46 PM
 */

namespace App\Models;


class DashboardItemSummary
{
    public $feature;
    public $dashboardItems = array();

    /**
     * @return mixed
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * @param mixed $feature
     */
    public function setFeature($feature): void
    {
        $this->feature = $feature;
    }

    /**
     * @return array
     */
    public function getDashboardItems(): array
    {
        return $this->dashboardItems;
    }

    /**
     * @param array $dashboardItems
     */
    public function setDashboardItems(array $dashboardItems): void
    {
        $this->dashboardItems = $dashboardItems;
    }


}
