<?php

namespace Modules\PMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\PMS\Entities\Attribute;
use Modules\PMS\Entities\ProjectProposal;

class MonitorProjectGraphController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param ProjectProposal $projectProposal
     * @return Response
     */
    public function index(ProjectProposal $projectProposal)
    {
        $attributes = $projectProposal->organizations->map(function ($organization) {
            return $organization->attributes->map(function ($attribute) {
                return $attribute;
            });
        })->flatten();

        $attributeSelectOptions = $attributes->pluck('name', 'id');

        return view('pms::project.monitor.graph', compact('projectProposal', 'attributeSelectOptions'));
    }

    public function update(ProjectProposal $projectProposal, Attribute $attribute)
    {
        // TODO: check if attribute is valid for the project
        // TODO: move code to project service class
        $attributeValueSumsByMonthYear = \Modules\PMS\Entities\AttributeValue::where('attribute_id', $attribute->id)
            ->select(DB::raw('date, attribute_id, sum(planned_value) as total_planned_value, sum(achieved_value) as total_achieved_value'))
            ->groupBy('date')
            ->groupBy('attribute_id')
            ->orderBy('date')
            ->get();

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
