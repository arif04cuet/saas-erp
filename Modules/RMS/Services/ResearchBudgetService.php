<?php
/**
 * Created by PhpStorm.
 * User: artisan33
 * Date: 1/24/19
 * Time: 6:36 PM
 */

namespace Modules\RMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\RMS\Repositories\ResearchBudgetRepository;


class ResearchBudgetService
{

    use CrudTrait;
    /**
     * @var ResearchBudgetRepository
     */
    private $researchBudgetRepository;


    /**
     * ResearchBudgetService constructor.
     * @param ResearchBudgetRepository $researchBudgetRepository
     */

    public function __construct(ResearchBudgetRepository $researchBudgetRepository)
    {
        $this->researchBudgetRepository = $researchBudgetRepository;
        $this->setActionRepository($researchBudgetRepository);
    }

    /**
     * @param $research
     * @param array $data
     * @return mixed
     */
    public function store($research, array $data)
    {
        return DB::transaction(function () use ($research, $data) {
            $budgets = [];

            foreach ($data['activity'] as $index => $activity){

                array_push($budgets, [
                    'activity' => $activity,
                    'estimated_cost' => $data['estimated_cost'][$index]
                ]);
            }

            return $research->budgets()->createMany($budgets);

        });
    }


    public function updateBudget($research, array $data)
    {
        return DB::transaction(function () use ($research, $data) {

            $research->budgets()->delete();
            $budgets = [];

            foreach ($data['activity'] as $index => $activity){

                array_push($budgets, [
                    'activity' => $activity,
                    'estimated_cost' => $data['estimated_cost'][$index]
                ]);
            }

            return $research->budgets()->createMany($budgets);
        });
    }

}
