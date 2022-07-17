<?php

namespace Modules\PMS\Services;

use App\Entities\Organization\Organization;
use App\Services\AttributeService;
use Carbon\Carbon;
use Modules\PMS\Entities\Project;

class ProjectReportService
{
    /**
     * @var AttributeService
     */
    private $attributeService;
    /**
     * @var ProjectService
     */
    private $projectService;

    public function __construct(AttributeService $attributeService, ProjectService $projectService)
    {
        $this->attributeService = $attributeService;
        $this->projectService = $projectService;
    }

    public function getMemberMonthlyIndicatorData(Project $project, Organization $organization, Carbon $monthYear)
    {

        return $this->attributeService->getMemberMonthlyAchievedPlannedValues($project, $organization, $monthYear);
    }

    public function getMemberAchievedPlannedValuesInDateRange(Project $project, Organization $organization, Carbon $from, Carbon $to)
    {
        return $this->attributeService->getMemberAchievedPlannedValuesInDateRange($project, $organization, $from, $to);
    }


//    public function getProjectAttributeSummary(Project $project, $monthYear = null)
//    {
//        return $this->projectService->getProjectAttributeSummary($project, $monthYear);
//    }

    public function getMonthYearlyAchievedPlannedValues(Project $project, Carbon $monthYear)
    {
        $data = [];
        foreach ($project->attributes as $attribute) {
            $data[$attribute->id] = $this->attributeService->getMonthYearlyAchievedPlannedValues($attribute,
                $monthYear);
        }
        return $data;
    }

    /**
     * @param Project $project
     * @param Carbon $from
     * @param Carbon $to
     * @return array
     */
    public function getAchievedPlannedValuesInDateRange(Project $project, Carbon $from, Carbon $to)
    {
        $data = [];
        foreach ($project->attributes as $attribute) {
            $data[$attribute->id] = $this->attributeService->getAchievedPlannedValuesInDateRange($attribute, $from,
                $to);
        }
        return $data;
    }
}

