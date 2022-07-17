<?php

namespace Modules\PMS\Services;

use App\Traits\CrudTrait;
use Modules\PMS\Entities\ProjectAttribute;
use Modules\PMS\Repositories\ProjectAttributeRepository;
use Modules\PMS\Services\ProjectService;
use Modules\PMS\Services\ProjectAttributePlannedValueService;
use App\Utilities\DropDownDataFormatter;
use Closure;
use Modules\PMS\Services\ProjectAttributeAchievedValueService;
use Illuminate\Support\Carbon;

class ProjectAttributeService
{
    use CrudTrait;

    private $projectAttributeRepository;
    private $projectService;

    public function __construct(
        ProjectAttributeRepository $projectAttributeRepository,
        ProjectService $projectService,
        ProjectAttributePlannedValueService $projectAttributePlannedValueService,
        ProjectAttributeAchievedValueService $projectAttributeAchievedValueService

    ) {
        $this->projectAttributeRepository = $projectAttributeRepository;
        $this->setActionRepository($this->projectAttributeRepository);
        $this->projectService = $projectService;
        $this->projectAttributePlannedValueService = $projectAttributePlannedValueService;
        $this->projectAttributeAchievedValueService = $projectAttributeAchievedValueService;
    }

    public function getAchievedPlannedValuesByMonthYear(ProjectAttribute $attribute, $onlyTillActiveMonth = false)
    {
        return $this->projectAttributeRepository->getAchievedPlannedValuesByMonthYear($attribute->id, $onlyTillActiveMonth);
    }


    public function getProjectAttributesForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $attributes = $query ? $this->findBy($query) : $this->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $attributes,
            $implementedKey,
            $implementedValue ?: function ($attributes) {
                return $attributes->name;
            },
            $isEmptyOption
        );
    }

    public function filterAttributeValuesByDateRange($projectId, $from, $to)
    {
        $project =  $this->projectService->findOrFail($projectId);
        $from = Carbon::createFromFormat('d/m/Y',  $from)->format('Y-m-d');
        $to = Carbon::createFromFormat('d/m/Y',   $to)->format('Y-m-d');
        $plannedValues = $this->projectAttributePlannedValueService->getTotalPlannedValueByDateRange($project, $from, $to);
        $achievedValues = $this->projectAttributeAchievedValueService->getTotalAchievedValueByDateRange($project, $from, $to);

        $values = [];
        for ($i = 0; $i < sizeof($plannedValues); $i++) {
            $value = [];
            array_push($value, $plannedValues[$i][0], $plannedValues[$i][1], $plannedValues[$i][2], $achievedValues[$i][2]);
            array_push($values, $value);
        }
        return  $values;
    }

    public function filterUsingProjectAttribute($attributeId, $from, $to)
    {
        $from = Carbon::createFromFormat('d/m/Y',  $from)->format('Y-m-d');
        $to = Carbon::createFromFormat('d/m/Y',   $to)->format('Y-m-d');

        $projectAttributeName = $this->findOrFail($attributeId)->name;

        $plannedValues = $this->projectAttributePlannedValueService->getPlannedValues($attributeId, $from, $to);
        $achievedValues = $this->projectAttributeAchievedValueService->getAchievedValues($attributeId, $from, $to);

        $values = [];

        array_push($values,  $plannedValues);
        array_push($values,  $achievedValues);

        $data = [];
        array_push($data,  $values);
        $selectedProjectId = 1;
        array_push($data,  $selectedProjectId);
        return $data;
    }
}
