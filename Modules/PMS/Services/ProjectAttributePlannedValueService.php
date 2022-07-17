<?php

namespace Modules\PMS\Services;

use App\Traits\CrudTrait;
use Modules\PMS\Repositories\ProjectAttributePlannedValueRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\PMS\Entities\ProjectAttributePlannedValue;

class ProjectAttributePlannedValueService
{
    use CrudTrait;

    private $projectAttributePlannedValueRepository;

    public function __construct(
        ProjectAttributePlannedValueRepository $projectAttributePlannedValueRepository

    ) {
        $this->projectAttributePlannedValueRepository = $projectAttributePlannedValueRepository;
        $this->setActionRepository($this->projectAttributePlannedValueRepository);
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();

            foreach ($data['planning'] as $planningData) {
                $this->save([
                    'project_attribute_id' => $planningData['attribute_id'],
                    'planned_value' => $planningData['planned_value'],
                    'date' => Carbon::parse($data['date'])
                ]);
            }

            DB::commit();

            return true;
        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error($exception->getMessage());

            return false;
        }
    }

    public function getTotalPlannedValueByDateRange($project, $from, $to)
    {
        $plannedValues = [];
        foreach ($project->projectAttributes as $attribute) {
            $plannedValue = [];
            $value = $this->findBy(['project_attribute_id' => $attribute['id']])->whereBetween('date', [$from, $to])->sum('planned_value');
            array_push($plannedValue, $attribute->name, $attribute->unit, $value);
            array_push($plannedValues, $plannedValue);
        }
        return $plannedValues;
    }

    public function getPlannedValues($attributeId, $from, $to)
    {
        return $this->projectAttributePlannedValueRepository->getPlannedValues($attributeId, $from, $to);
    }
}
