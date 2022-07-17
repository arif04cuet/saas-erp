<?php

/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 1/16/19
 * Time: 1:14 PM
 */

namespace App\Repositories;


use App\Entities\Attribute;
use App\Entities\AttributeValue;
use App\Entities\Organization\Organization;
use App\Entities\Organization\OrganizationMember;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\PMS\Entities\AttributePlanning;

class AttributeRepository extends AbstractBaseRepository
{
    protected $modelName = Attribute::class;

    public function getAchievedPlannedValuesByMonthYear($attributeId, $onlyTillActiveMonth = false)
    {

        $plannedValuesByMonthYear = DB::table('attribute_plannings')
            ->when($onlyTillActiveMonth, function ($q) {
                return $q->whereMonth('date', '<=', Carbon::now()->format('m'));
            })
            ->select(
                DB::raw('sum(planned_value) as total_planned_value, date_format(date, "%M %Y") as monthYear')
            )
            ->where('attribute_id', $attributeId)
            ->groupBy('monthYear')
            ->get();

        $achievedValuesByMonthYear = DB::table('attribute_values')
            ->when($onlyTillActiveMonth, function ($q) {
                return $q->whereMonth('date', '<=', Carbon::now()->format('m'));
            })
            ->select(
                DB::raw('sum(achieved_value) as total_achieved_value, date_format(date, "%M %Y") as monthYear')
            )
            ->where('attribute_id', $attributeId)
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

    public function getMonthYearlyAchievedPlannedValues(Attribute $attribute, $month, $year)
    {
        $plannedValue = AttributePlanning::whereAttributeId($attribute->id)
            ->whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month)
            ->sum('planned_value');
        $achievedValue = AttributeValue::whereAttributeId($attribute->id)
            ->whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month)
            ->sum('achieved_value');
        return [
            'planned_value' => $plannedValue,
            'achieved_value' => $achievedValue
        ];
    }

    public function getAchievedPlannedValuesInDateRange(Attribute $attribute, $from, $to)
    {
        $plannedValue = AttributePlanning::whereAttributeId($attribute->id)
            ->whereBetween('date', [$from, $to])
            ->sum('planned_value');

        $achievedValue = AttributeValue::whereAttributeId($attribute->id)
            ->whereBetween('date', [$from, $to])
            ->sum('achieved_value');

        return [
            'planned_value' => $plannedValue,
            'achieved_value' => $achievedValue
        ];
    }

    public function getMemberMonthlyAchievedPlannedValues(
        Attribute $attribute,
        OrganizationMember $member,
        $month,
        $year
    ) {
        $achievedValue = AttributeValue::whereAttributeId($attribute->id)
            ->whereOrganizationMemberId($member->id)
            ->whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month)
            ->sum('achieved_value');
        return [
            'achieved_value' => $achievedValue
        ];
    }

    public function getMemberAchievedPlannedValuesInDateRange(
        Attribute $attribute,
        OrganizationMember $member,
        $from,
        $to
    ) {
        $achievedValue = AttributeValue::whereAttributeId($attribute->id)
            ->whereOrganizationMemberId($member->id)
            ->whereBetween('date', [
                $from,
                $to
            ])
            ->sum('achieved_value');
        return [
            'achieved_value' => $achievedValue
        ];
    }
}
