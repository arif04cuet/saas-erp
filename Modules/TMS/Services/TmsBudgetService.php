<?php

namespace Modules\TMS\Services;

use Exception;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\TMS\Entities\Training;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Modules\TMS\Entities\TmsBudget;
use Illuminate\Support\Facades\Session;
use Modules\TMS\Repositories\TmsBudgetRepository;
use Modules\TMS\Repositories\TmsBudgetSectorRepository;

class TmsBudgetService
{
    use CrudTrait;

    /**
     * @var TmsBudgetRepository
     */
    private $tmsBudgetRepository;
    /**
     * @var TmsBudgetSectorRepository
     */
    private $tmsBudgetSectorRepository;
    /**
     * @var TmsAccountBalanceService
     */
    private $tmsAccountBalanceService;

    /**
     * TmsBudgetService constructor.
     * @param TmsBudgetRepository $tmsBudgetRepository
     * @param TmsBudgetSectorRepository $tmsBudgetSectorRepository
     * @param TmsAccountBalanceService $tmsAccountBalanceService
     */
    public function __construct(
        TmsBudgetRepository $tmsBudgetRepository,
        TmsBudgetSectorRepository $tmsBudgetSectorRepository,
        TmsAccountBalanceService $tmsAccountBalanceService
    ) {
        $this->tmsBudgetRepository = $tmsBudgetRepository;
        $this->setActionRepository($tmsBudgetRepository);
        $this->tmsBudgetSectorRepository = $tmsBudgetSectorRepository;
        $this->tmsAccountBalanceService = $tmsAccountBalanceService;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $trainingBudgetData = $this->getTrainingBudgetData($data);
            $budgetData = $this->save($trainingBudgetData);
            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Training Budget Type Creation Error ' . $exception->getMessage() . ' Trace:' . $exception->getTraceAsString());
            return false;
        }
    }

    /**
     * @param array $data
     * @param $id
     * @return bool
     */
    public function updateBudget($id, array $data)
    {
        $budgetData = $this->findOrFail($id);
        // dd($budgetData);
        DB::transaction(function () use ($budgetData, $data) {
            $this->update($budgetData, $data);
        });
        return new Response("Training Budget Type has been updated successfully");
    }

    /**
     * @param $data
     */
    public function setTrainingHeadAsOldValues(TmsBudget $budgetType)
    {
        session(['_old_input.name_english' => $budgetType->name_english]);
        session(['_old_input.name_bangla' => $budgetType->name_bangla]);
    }

    public function clearOldSessionValues()
    {
        if (session()->has('_old_input.name_english')) {
            session()->forget('_old_input.name_english');
        }
        if (session()->has('_old_input.name_english')) {
            session()->forget('_old_input.name_bangla');
        }
    }

    public function destroy($id)
    {
        $budgetType = $this->findOrFail($id);
        DB::transaction(function () use ($budgetType) {
            $budgetType->delete();
        });

        return new Response("Budget Type has been deleted successfully");
    }

    public function getBudgetsForDropdown()
    {
        $budget_title = !App::isLocale('bn') ? 'name_english' : 'name_bangla';
        return $this->findAll()->pluck($budget_title, 'id');
    }

    //------------------------------------------------------------------------------------------
    //                                      Private Function
    //-------------------------------------------------------------------------------------------

    private function getTrainingBudgetData(array $data)
    {
        return [
            'name_english' => $data['name_english'],
            'name_bangla' => $data['name_bangla'],
        ];
    }
}

