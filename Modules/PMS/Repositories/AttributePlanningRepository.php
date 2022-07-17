<?php

/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 2/25/19
 * Time: 6:33 PM
 */

namespace Modules\PMS\Repositories;


use App\Repositories\AbstractBaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\PMS\Entities\AttributePlanning;

class AttributePlanningRepository extends AbstractBaseRepository
{
    protected $modelName = AttributePlanning::class;

    public function getMonthlyPlanningFor($attributeId)
    {
        return DB::table('attribute_plannings')
            ->select(
                DB::raw('date_format(date, "%Y %M") as monthYear'),
                DB::raw('sum(planned_value) as total_planned_value')
            )
            ->where('attribute_id', $attributeId)
            ->groupBy('monthYear')
            ->orderBy('monthYear', 'asc')
            ->get();
    }


    public function getPlannedValues($attributeId, $from, $to)
    {
        return AttributePlanning::selectRaw('monthname(date) as month, sum(planned_value) as planned_value')
            ->groupBy('month')
            ->where('attribute_id', $attributeId)
            ->whereBetween('date', [$from, $to])
            ->get();
    }
}
