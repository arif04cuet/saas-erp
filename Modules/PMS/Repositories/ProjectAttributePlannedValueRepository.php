<?php


namespace Modules\PMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\PMS\Entities\ProjectAttributePlannedValue;

class ProjectAttributePlannedValueRepository extends AbstractBaseRepository
{

    protected $modelName = ProjectAttributePlannedValue::class;

    public function getPlannedValues($attributeId, $from, $to)
    {
        return ProjectAttributePlannedValue::selectRaw('monthname(date) as month, sum(planned_value) as planned_value')
            ->groupBy('month')
            ->where('project_attribute_id', $attributeId)
            ->whereBetween('date', [$from, $to])
            ->get();
    }
}
