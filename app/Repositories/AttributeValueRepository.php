<?php

/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 1/16/19
 * Time: 8:14 PM
 */

namespace App\Repositories;


use App\Entities\Attribute;
use App\Entities\AttributeValue;
use Illuminate\Support\Facades\DB;

class AttributeValueRepository extends AbstractBaseRepository
{
    protected $modelName = AttributeValue::class;

    public function getMemberAttributeValues($memberId, $attributeIds)
    {
        $attributes = Attribute::whereIn('id', $attributeIds)->get();

        $attributeValues = $this->model->whereIn('attribute_id', $attributeIds)
            ->where('organization_member_id', $memberId)
            ->get();

        return $attributes->map(function ($attribute) use ($attributeValues) {
            $attributeValue = $attributeValues->where('attribute_id', $attribute->id)->first();
            $initialValue = $attributeValue ? $attributeValue->achieved_value : 0;
            return (object)[
                'attribute_id' => $attribute->id,
                'name' => $attribute->name,
                'initial_value' =>  $initialValue,
                'total_achieved_value' => $attributeValues->where('attribute_id', $attribute->id)->sum('achieved_value')
            ];
        });
    }

    public function getAttributeValueSumsByMonthYear($attributeId)
    {
        return $this->model->where('attribute_id', $attributeId)
            ->select(DB::raw('date, attribute_id, sum(planned_value) as total_planned_value, sum(achieved_value) as total_achieved_value'))
            ->groupBy('date')
            ->groupBy('attribute_id')
            ->orderBy('date')
            ->get();
    }

    public function getAchievedValues($attributeId, $from, $to, $organization, $memberId)
    {
        if ($memberId) {
            return AttributeValue::selectRaw('monthname(date) as month, sum(achieved_value) as achieved_value')
                ->groupBy('month')
                ->where('attribute_id', $attributeId)
                ->where('organization_member_id', $memberId)
                ->whereBetween('date', [$from, $to])
                ->get();
        } elseif ($organization && $memberId == null) {
            $members = $this->getMemberIds($organization);
            return AttributeValue::selectRaw('monthname(date) as month, sum(achieved_value) as achieved_value')
                ->groupBy('month')
                ->where('attribute_id', $attributeId)
                ->whereIn('organization_member_id', $members)
                ->whereBetween('date', [$from, $to])
                ->get();
        } else {
            return AttributeValue::selectRaw('monthname(date) as month, sum(achieved_value) as achieved_value')
                ->groupBy('month')
                ->where('attribute_id', $attributeId)
                ->whereBetween('date', [$from, $to])
                ->get();
        }
    }

    public function getMemberIds($organization)
    {
        $ids = [];
        foreach ($organization->members->toArray() as  $org) {
            $ids[] = $org['id'];
        }
        return $ids;
    }
}
