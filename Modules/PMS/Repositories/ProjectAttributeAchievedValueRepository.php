<?php

namespace Modules\PMS\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\PMS\Entities\ProjectAttributeAchievedValue;

class ProjectAttributeAchievedValueRepository extends AbstractBaseRepository
{
    protected $modelName = ProjectAttributeAchievedValue::class;

    public function getAchievedValues($attributeId, $from, $to)
    {
        return ProjectAttributeAchievedValue::selectRaw('monthname(date) as month, sum(achieved_value ) as achieved_value ')
            ->groupBy('month')
            ->where('project_attribute_id', $attributeId)
            ->whereBetween('date', [$from, $to])
            ->get();
    }
}
