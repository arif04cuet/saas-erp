<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Modules\Accounts\Entities\PensionConfiguration;
use Modules\Accounts\Repositories\PensionRuleRepository;

class PensionRuleService
{
    use CrudTrait;

    public function __construct(PensionRuleRepository $pensionRuleRepository)
    {
        $this->setActionRepository($pensionRuleRepository);
    }

    public function update(PensionConfiguration $pensionConfiguration, $data)
    {
        $ids = $data->pluck('id');
        $pensionRuleIdsToBeDeleted = $this->getRuleToDelete($pensionConfiguration, $ids->toArray())
            ->each(function ($id) {
                $pensionRule = $this->actionRepository->findOne($id);
                return $this->actionRepository->delete($pensionRule);
            });

        $pensionRuleIdsToBeUpdated = $ids->diff($pensionRuleIdsToBeDeleted);

        $filtered = $data->whereIn('id', $pensionRuleIdsToBeUpdated);

        // update the data
        if (!empty($filtered)) {
            $updateOrSaves = $filtered
                ->each(function ($rule) use ($pensionConfiguration) {
                    $rule['pension_configuration_id'] = $pensionConfiguration->id;
                    $this->actionRepository->getModel()->updateOrCreate(
                        [
                            'id' => $rule['id']
                        ],
                        $rule
                    );
                });
            return $updateOrSaves;
        }
        return $pensionRuleIdsToBeDeleted;
    }

    private function getRuleToDelete(PensionConfiguration $pensionConfiguration, $newIds)
    {
        return $pensionConfiguration->rules->filter(function ($rule) use ($newIds) {
            return !in_array($rule->id, $newIds);
        })->pluck('id');
    }

}

