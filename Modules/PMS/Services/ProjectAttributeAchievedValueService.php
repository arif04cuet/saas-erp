<?php

namespace Modules\PMS\Services;

use App\Traits\CrudTrait;
use Modules\PMS\Repositories\ProjectAttributeAchievedValueRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\PMS\Entities\ProjectAttributeAchievedValue;


class ProjectAttributeAchievedValueService
{
    use CrudTrait;

    private $projectAttributeAchievedValueRepository;

    public function __construct(
        ProjectAttributeAchievedValueRepository $projectAttributeAchievedValueRepository
    ) {
        $this->projectAttributeAchievedValueRepository = $projectAttributeAchievedValueRepository;
        $this->setActionRepository($this->projectAttributeAchievedValueRepository);
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();

            foreach ($data['planning'] as $planningData) {
                $this->save([
                    'project_attribute_id' => $planningData['attribute_id'],
                    'achieved_value' => $planningData['achieved_value'],
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

    public function getTotalAchievedValueByDateRange($project, $from, $to)
    {
        $achievedValues = [];
        foreach ($project->projectAttributes as $attribute) {
            $achievedValue = [];
            $value = $this->findBy(['project_attribute_id' => $attribute['id']])->whereBetween('date', [$from, $to])->sum('achieved_value');
            array_push($achievedValue, $attribute->name, $attribute->unit, $value);
            array_push($achievedValues, $achievedValue);
        }
        return $achievedValues;
    }

    public function getAchievedValues($attributeId, $from, $to)
    {
        return $this->projectAttributeAchievedValueRepository->getAchievedValues($attributeId, $from, $to);
    }
}
