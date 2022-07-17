<?php
/**
 * Created by PhpStorm.
 * User: Tanvir
 * Date: 10/18/18
 * Time: 5:18 PM
 */

namespace Modules\PMS\Services;

use App\Services\workflow\FeatureService;
use App\Traits\CrudTrait;
use App\Traits\ExcelExportTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Modules\PMS\Entities\DraftProposalBudgetFiscalValue;
use Modules\PMS\Repositories\DraftProposalBudgetRepository;
use stdClass;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class DraftProposalBudgetService
{
    use CrudTrait, ExcelExportTrait;

    private $draftProposalBudgetRepository;
    private $featureService;

    /**
     * ProjectRequestService constructor.
     *
     * @param DraftProposalBudgetRepository $draftProposalBudgetRepository
     * @param FeatureService $featureService
     */

    public function __construct(DraftProposalBudgetRepository $draftProposalBudgetRepository,FeatureService $featureService)
    {
        $this->draftProposalBudgetRepository = $draftProposalBudgetRepository;
        $this->featureService = $featureService;

        $this->setActionRepository($draftProposalBudgetRepository);

    }

    public function getSectionTypesOfDraftProposalBudget(){
        return [
            'revenue' => Lang::get('draft-proposal-budget.revenue'),
            'capital' => Lang::get('draft-proposal-budget.capital'),
            'physical_contingency' => Lang::get('draft-proposal-budget.physical_contingency'),
            'price_contingency' => Lang::get('draft-proposal-budget.price_contingency'),
        ];
    }

    public function getEconomyCodeWiseSortedBudgets($budgetable){
        return $budgetable->budgets()->orderBy('economy_code_id', 'asc')->get();
    }

    public function getTotalExpenseOfRevenueAndCapital($budgetable)
    {
        $revenueExpense = 0;
        $capitalExpense = 0;

        foreach ($budgetable->budgets as $budget)
        {
            switch ($budget->section_type){
                case 'revenue':
                    $revenueExpense += $budget->total_expense;
                    break;
                case 'capital':
                    $capitalExpense += $budget->total_expense;
                    break;
            }
        }

        $totalExpense = $revenueExpense + $capitalExpense;

        return compact('totalExpense', 'revenueExpense', 'capitalExpense');
    }

    /**
     * @param $budgetable
     * @return array
     */
    public function prepareDataForBudgetView($budgetable)
    {
        $physicalContingencyExpense = 0;
        $priceContingencyExpense = 0;

        list($totalExpense, $revenueExpense, $capitalExpense) = array_values($this->getTotalExpenseOfRevenueAndCapital($budgetable));

        foreach ($budgetable->budgets as $budget)
        {
            switch ($budget->section_type){
                case 'physical_contingency':
                    $physicalContingencyExpense = ( $totalExpense * $budget->total_expense_percentage ) / 100 ;
                    break;
                case 'price_contingency':
                    $priceContingencyExpense = ( $totalExpense * $budget->total_expense_percentage ) / 100 ;
                    break;
            }
        }

        $grandTotalExpense = $totalExpense + $physicalContingencyExpense + $priceContingencyExpense;

        $economyHeadWiseRevenueData = $this->getEconomyCodeWiseSubTotal($budgetable, 'revenue');
        $economyHeadWiseCapitalData = $this->getEconomyCodeWiseSubTotal($budgetable, 'capital');

        return compact('totalExpense',
            'revenueExpense',
            'capitalExpense',
            'physicalContingencyExpense',
            'priceContingencyExpense',
            'grandTotalExpense',
            'economyHeadWiseRevenueData',
            'economyHeadWiseCapitalData'
        );

    }

    private function getEconomyCodeWiseSubTotal($budgetable, $sectionType){

        $totalBasedOnEconomyCode = array();

        foreach ($budgetable->budgets as $budget){
            if($budget->section_type === $sectionType) {

                $economyHeadCode = $budget->economyCode->economyHead->code;

                if(!isset($totalBasedOnEconomyCode[$economyHeadCode])){
                    $totalBasedOnEconomyCode[$economyHeadCode] = new stdClass;
                    $totalBasedOnEconomyCode[$economyHeadCode]->unitRate = 0;
                    $totalBasedOnEconomyCode[$economyHeadCode]->quantity = 0;
                    $totalBasedOnEconomyCode[$economyHeadCode]->govSource = 0;
                    $totalBasedOnEconomyCode[$economyHeadCode]->ownFinancingSource = 0;
                    $totalBasedOnEconomyCode[$economyHeadCode]->otherSource = 0;
                    $totalBasedOnEconomyCode[$economyHeadCode]->totalExpense = 0;
                }

                $totalBasedOnEconomyCode[$economyHeadCode]->unitRate += $budget->unit_rate;
                $totalBasedOnEconomyCode[$economyHeadCode]->quantity += $budget->quantity;
                $totalBasedOnEconomyCode[$economyHeadCode]->govSource += $budget->gov_source;
                $totalBasedOnEconomyCode[$economyHeadCode]->ownFinancingSource += $budget->own_financing_source;
                $totalBasedOnEconomyCode[$economyHeadCode]->otherSource += $budget->other_source;
                $totalBasedOnEconomyCode[$economyHeadCode]->totalExpense += $budget->total_expense;
            }
        }

        return $totalBasedOnEconomyCode;
    }

    /**
     * Export View as a Excel File
     * @param $data
     * @param $viewName
     * @param null $fileName
     * @return BinaryFileResponse
     */
    public function exportExcel($data, $viewName, $fileName = null)
    {
        $fileName = $fileName ? $fileName . '.xlsx' : 'DPPBudget.xlsx';
        return $this->downloadExcel($data, $viewName, $fileName);
    }


    /**
     * @param $budgetable
     * @param array $data
     * @return mixed
     */
    public function store($budgetable, array $data)
    {
        return DB::transaction(function () use ($budgetable, $data) {

            $draftProposalBudget = $budgetable->budgets()->create($data);

            foreach ($data['fiscal_year'] as $key => $budgetFiscalYear) {

                if ($budgetFiscalYear) {

                    $fiscalValue = new DraftProposalBudgetFiscalValue([
                        'budget_id' => $draftProposalBudget->id,
                        'fiscal_year' => $budgetFiscalYear,
                        'monetary_amount' => $data['monetary_amount'][$key],
                        'monetary_percentage' => $data['monetary_percentage'][$key],
                    ]);

                    $draftProposalBudget->budgetFiscalValue()->save($fiscalValue);
                }
            }

            return $draftProposalBudget;
        });
    }

    public function updateBudget(array $data, $draftProposalBudget)
    {
        return DB::transaction(
            function () use ($data, $draftProposalBudget) {

            $this->update($draftProposalBudget, $data);

            $draftProposalBudget->budgetFiscalValue()->delete();

            foreach ($data['fiscal_year'] as $key => $budgetFiscalYear) {

                if ($budgetFiscalYear) {

                    $fiscalValue = new DraftProposalBudgetFiscalValue([
                        'budget_id' => $draftProposalBudget->id,
                        'fiscal_year' => $budgetFiscalYear,
                        'monetary_amount' => $data['monetary_amount'][$key],
                        'monetary_percentage' => $data['monetary_percentage'][$key],
                    ]);

                    $draftProposalBudget->budgetFiscalValue()->save($fiscalValue);
                }
            }

            return $draftProposalBudget;
        });
    }

}
