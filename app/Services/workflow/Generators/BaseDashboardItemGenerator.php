<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 1/28/19
 * Time: 11:20 AM
 */

namespace App\Services\workflow\Generators;


use App\Models\DashboardItemSummary;

abstract class BaseDashboardItemGenerator
{
     abstract public function generateItems(): DashboardItemSummary;
     abstract public function generateRejectedItems(): DashboardItemSummary;
     abstract public function updateItem($refTableId, $status);
}
