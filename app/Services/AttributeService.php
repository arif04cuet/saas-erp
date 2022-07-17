<?php

/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 1/16/19
 * Time: 1:15 PM
 */

namespace App\Services;


use App\Entities\Attribute;
use App\Entities\Organization\Organization;
use App\Entities\Organization\OrganizationMember;
use App\Repositories\AttributeRepository;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use App\Utilities\DropDownDataFormatter;
use Closure;
use Illuminate\Support\Facades\DB;
use Modules\PMS\Entities\AttributePlanning;
use Modules\PMS\Entities\Project;
use Modules\PMS\Services\AttributePlanningService;
use App\Services\AttributeValueService;

class AttributeService
{
    use CrudTrait;

    private $attributePlanningService;
    private $attributeValueService;
    private $projectService;

    /**
     * @var AttributeRepository
     */
    private $attributeRepository;

    /**
     * AttributeService constructor.
     * @param AttributeRepository $attributeRepository
     */
    public function __construct(
        AttributeRepository $attributeRepository,
        AttributePlanningService $attributePlanningService,
        AttributeValueService $attributeValueService
    ) {
        $this->attributeRepository = $attributeRepository;
        $this->setActionRepository($attributeRepository);
        $this->attributePlanningService = $attributePlanningService;
        $this->attributeValueService = $attributeValueService;
    }

    public function getAttributeType(Attribute $attribute)
    {
        return strtolower($attribute->name);
    }

    public function getMemberAttributeValues(Attribute $attribute, OrganizationMember $member)
    {
        $firstAttributeValue = $member->attributeValues->where('attribute_id', $attribute->id)->first();

        $initialValue = $firstAttributeValue ? $firstAttributeValue->achieved_value : 0;

        $currentBalance = $member->attributeValues->where('attribute_id', $attribute->id)->sum('achieved_value');

        return (object)[
            'initial_value' => $initialValue,
            'current_balance' => $currentBalance
        ];
    }

    public function getAchievedPlannedValuesByMonthYear(Attribute $attribute, $onlyTillActiveMonth = false)
    {
        return $this->attributeRepository->getAchievedPlannedValuesByMonthYear($attribute->id, $onlyTillActiveMonth);
    }

    public function getMonthYearlyAchievedPlannedValues(Attribute $attribute, Carbon $monthYear)
    {
        $month = $monthYear->format('m');
        $year = $monthYear->format('Y');
        return $this->attributeRepository->getMonthYearlyAchievedPlannedValues($attribute, $month, $year);
    }

    public function getMemberMonthlyAchievedPlannedValues(
        Project $project,
        Organization $organization,
        Carbon $monthYear
    ) {
        $data = [];
        $month = $monthYear->format('m');
        $year = $monthYear->format('Y');

        foreach ($organization->members as $member) {
            $temp = [];
            foreach ($project->attributes as $attribute) {
                $temp[$attribute->id] = $this->attributeRepository->getMemberMonthlyAchievedPlannedValues(
                    $attribute,
                    $member,
                    $month,
                    $year
                );
            }
            $data[$member->id] = $temp;
        }
        return $data;
    }


    public function getAttributesForDropdown(
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

    /**
     * @param Attribute $attribute
     * @param Carbon $from
     * @param Carbon $to
     * @return array
     */
    public function getAchievedPlannedValuesInDateRange(Attribute $attribute, Carbon $from, Carbon $to)
    {
        $from = $from->format('Y-m-d');
        $to = $to->format('Y-m-d');
        return $this->attributeRepository->getAchievedPlannedValuesInDateRange($attribute, $from, $to);
    }

    /**
     * @param Project $project
     * @param Organization $organization
     * @param Carbon $from
     * @param Carbon $to
     * @return array
     */
    public function getMemberAchievedPlannedValuesInDateRange(
        Project $project,
        Organization $organization,
        Carbon $from,
        Carbon $to
    ) {
        $data = [];
        $from = $from->format('Y-m-d');
        $to = $to->format('Y-m-d');
        foreach ($organization->members as $member) {
            $temp = [];
            foreach ($project->attributes as $attribute) {
                $temp[$attribute->id] = $this->attributeRepository->getMemberAchievedPlannedValuesInDateRange(
                    $attribute,
                    $member,
                    $from,
                    $to
                );
            }
            $data[$member->id] = $temp;
        }
        return $data;
    }
}
