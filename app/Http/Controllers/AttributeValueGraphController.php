<?php

namespace App\Http\Controllers;

use App\Entities\Attribute;
use App\Services\AttributeValueService;
use Carbon\Carbon;

class AttributeValueGraphController extends Controller
{
    /**
     * @var AttributeValueService
     */
    private $attributeValueService;

    /**
     * AttributeValueGraphController constructor.
     * @param AttributeValueService $attributeValueService
     */
    public function __construct(AttributeValueService $attributeValueService)
    {
        $this->attributeValueService = $attributeValueService;
    }

    public function update(Attribute $attribute)
    {
        $attributeValueSumsByMonthYear = $this->attributeValueService->getAttributeValueSumsByMonthYear($attribute->id);

        $uniqueMonthYear = $attributeValueSumsByMonthYear->map(function ($row) {
            $monthYear = explode(' ', Carbon::parse($row->date)->format('F Y'));
            return trans('month.' . $monthYear[0]) . ' ' . $monthYear[1];
        })->unique()->values();

        $attributeValue['id'] = $attribute->id;
        $attributeValue['name'] = $attribute->name;
        $attributeValue['monthly_planned_values'] = $attributeValueSumsByMonthYear->where('attribute_id', $attribute->id)
            ->pluck('total_planned_value');
        $attributeValue['monthly_achieved_values'] = $attributeValueSumsByMonthYear->where('attribute_id', $attribute->id)
            ->pluck('total_achieved_value');

        return \response()->json([
            'uniqueMonthYear' => $uniqueMonthYear,
            'attributeValue' => $attributeValue
        ], 200);
    }
}
