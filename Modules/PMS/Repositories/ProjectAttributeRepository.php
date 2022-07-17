<?php


namespace Modules\PMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\PMS\Entities\ProjectAttribute;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProjectAttributeRepository extends AbstractBaseRepository
{
    protected $modelName = ProjectAttribute::class;

    public function getAchievedPlannedValuesByMonthYear($attributeId, $onlyTillActiveMonth = false)
    {

        $plannedValuesByMonthYear = DB::table('project_attribute_planned_values')
            ->when($onlyTillActiveMonth, function ($q) {
                return $q->whereMonth('date', '<=', Carbon::now()->format('m'));
            })
            ->select(
                DB::raw('sum(planned_value) as total_planned_value, date_format(date, "%M %Y") as monthYear')
            )
            ->where('project_attribute_id', $attributeId)
            ->groupBy('monthYear')
            ->get();

        $achievedValuesByMonthYear = DB::table('project_attribute_achieved_values')
            ->when($onlyTillActiveMonth, function ($q) {
                return $q->whereMonth('date', '<=', Carbon::now()->format('m'));
            })
            ->select(
                DB::raw('sum(achieved_value) as total_achieved_value, date_format(date, "%M %Y") as monthYear')
            )
            ->where('project_attribute_id', $attributeId)
            ->groupBy('monthYear')
            ->get();

        $achievedPlannedValuesByMonthYear = $achievedValuesByMonthYear->merge($plannedValuesByMonthYear);

        return $achievedPlannedValuesByMonthYear->groupBy('monthYear')->map(function ($rows) {
            return (object)[
                'total_achieved_value' => $rows->sum('total_achieved_value'),
                'total_planned_value' => $rows->sum('total_planned_value'),
                'monthYear' => $rows->first()->monthYear
            ];
        })->sortBy(function ($row) {
            return Carbon::parse($row->monthYear);
        })->values()->all();
    }
}
