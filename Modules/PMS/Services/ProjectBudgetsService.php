<?php

namespace Modules\PMS\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Modules\Accounts\Services\FiscalYearService;
use Illuminate\Support\Facades\App;
use Modules\PMS\Repositories\ProjectBudgetsRepository;


class ProjectBudgetsService
{
    use CrudTrait;

    private $projectBudgetsRepository;
    private $fiscalYearService;


    /**
     * ProjectBudgetService constructor.
     * @param ProjectBudgetsRepository $projectBudgetsRepository
     */

    public function __construct(
        ProjectBudgetsRepository $projectBudgetsRepository,
        FiscalYearService $fiscalYearService
    ) {
        $this->projectBudgetsRepository = $projectBudgetsRepository;
        $this->setActionRepository($projectBudgetsRepository);
        $this->fiscalYearService = $fiscalYearService;
    }

    public function getCreatedBudget($project)
    {
        return $this->projectBudgetsRepository->findBy(['project_id' => $project->id])->toArray();
    }

    public function store($project, array $data)
    {
        DB::transaction(function () use ($project, $data) {
            foreach ($data['peoject-budget-entries'] as $item) {
                $item['project_id'] = $project->id;
                $this->save($item);
            }
        });
    }

    public function updateBudget($project, array $data)
    {
        return DB::transaction(function () use ($project, $data) {
            $project->budgetCreate()->delete();
            $this->store($project, $data);
        });
    }

    public function getProjectBudgets($project, $fiscalYearId)
    {
        $projectBudget  = $project->budgetCreate;
        $projectBudget =  $projectBudget->where('fiscal_year_id', $fiscalYearId);
        return $projectBudget;
    }

    /**
     * Format Collection Data As Json Data
     * For DataTables
     * @param $iterables
     * @return mixed
     */
    public function formatToJsonForDataTable($iterables)
    {
        $number = 1;
        $lang = App::getLocale();

        return $iterables->each(function ($obj) use (&$number, $lang) {
            $obj->index = $number;
            $obj->fiscal_year_name = $obj->fiscalYear->name;
            $obj->EconomyCode = $lang == 'bn' ? $obj->EconomyCode->bangla_name : $obj->EconomyCode->english_name;
            $obj->activity_name = $obj->Activity->name;
            $obj->budget = $obj->budget;
            $obj->revised_budget = $obj->revised_budget;
            $obj->expense = $obj->expense;

            $number = $number + 1;
        });
    }
}
