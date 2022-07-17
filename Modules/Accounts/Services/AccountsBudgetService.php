<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use App\Utilities\EnToBnNumberConverter;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Modules\Accounts\Repositories\AccountsBudgetSectorRepository;
use Modules\Accounts\Repositories\AccountsBudgetRepository;
use Modules\Accounts\Repositories\BudgetCostCenterSectorRepository;
use Modules\Accounts\Repositories\EconomyHeadRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AccountsBudgetService
{
    use CrudTrait;
    /**
     * @var AccountsBudgetRepository
     */
    private $accountsBudgetRepository;
    /**
     * @var AccountsBudgetSectorRepository
     */
    private $accountsBudgetSectorRepository;
    /**
     * @var EconomyHeadRepository
     */
    private $economyHeadRepository;
    /**
     * @var FiscalYearService
     */
    private $fiscalYearService;
    /**
     * @var BudgetCostCenterSectorRepository
     */
    private $budgetCostCenterSectorRepository;

    /**
     * AccountsBudgetService constructor.
     * @param AccountsBudgetRepository $accountsBudgetRepository
     * @param AccountsBudgetSectorRepository $accountsBudgetSectorRepository
     * @param EconomyHeadRepository $economyHeadRepository
     * @param FiscalYearService $fiscalYearService
     * @param BudgetCostCenterSectorRepository $budgetCostCenterSectorRepository
     */
    public function __construct(
        AccountsBudgetRepository $accountsBudgetRepository,
        AccountsBudgetSectorRepository $accountsBudgetSectorRepository,
        EconomyHeadRepository $economyHeadRepository,
        FiscalYearService $fiscalYearService,
        BudgetCostCenterSectorRepository $budgetCostCenterSectorRepository
    ) {
        $this->accountsBudgetRepository = $accountsBudgetRepository;
        $this->setActionRepository($accountsBudgetRepository);
        $this->accountsBudgetSectorRepository = $accountsBudgetSectorRepository;
        $this->economyHeadRepository = $economyHeadRepository;
        $this->fiscalYearService = $fiscalYearService;
        $this->budgetCostCenterSectorRepository = $budgetCostCenterSectorRepository;
    }

    public function saveBudget(array $data)
    {
        DB::transaction(function () use ($data) {
            $budgetData = [
                'title' => $data['title'],
                'fiscal_year_id' => $data['fiscal_year_id'],
            ];
            $save = $this->save($budgetData);

            /**
             * Saving Budget Amounts
             */
            foreach ($data['budget_entries'] as $budgetEntry) {
                $budgetEntry['local_amount'] = $budgetEntry['local_amount'] ?? 0;
                $budgetEntry['revenue_amount'] = $budgetEntry['revenue_amount'] ?? 0;
                $budgetEntry['revised_local_amount'] = $budgetEntry['revised_local_amount'] ?? 0;
                $budgetEntry['revised_revenue_amount'] = $budgetEntry['revised_revenue_amount'] ?? 0;
                $budgetEntry['accounts_budget_id'] = $save->id;
                $this->accountsBudgetSectorRepository->save($budgetEntry);
            }
        });
    }

    public function updateBudget(array $data, $budgetId)
    {
        $budgetAmountCodes = collect($data['budget_entries'])->pluck('code')->toArray();
        DB::transaction(function () use ($data, $budgetAmountCodes, $budgetId) {
            $budgetData = [
                'title' => $data['title'],
                'fiscal_year_id' => $data['fiscal_year_id'],
            ];
            $this->findOrFail($budgetId)->update($budgetData);
            /**
             * Syncing and updating budget amounts
             */
            foreach ($data['budget_entries'] as $budgetEntry) {
                $isCodeExist = $this->accountsBudgetSectorRepository->hasCodeInBudget($budgetId, $budgetEntry['code']);
                if ($isCodeExist) {
                    $thisBudget = $this->accountsBudgetSectorRepository->findOrFail($budgetEntry['budget_amount_id']);
                    $thisBudget->update($budgetEntry);
                } else {
                    $budgetEntry['accounts_budget_id'] = $budgetId;
                    $this->accountsBudgetSectorRepository->save($budgetEntry);
                }
            }
            /**
             * Deleting entries that exists in DB but not in the update request
             */
            $this->accountsBudgetSectorRepository->deleteIfCodesNotInBudget(
                $budgetId,
                $budgetAmountCodes
            );
        });
    }

    public function downloadBudgetReport($budgetId)
    {
        $reportData = $this->prepareBudgetReportData($budgetId);
        $budgetCostCenters = $this->findOne($budgetId)->budgetCostCenters;
        $lang = App::getLocale();
        //dd($reportData, $budgetCostCenters);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Setting headers for the file
        //$headerRow =
        $sheet->setCellValue('A1', __('accounts::economy-code.title'));
        $sheet->setCellValue('B1', __('accounts::economy-code.recurring_expenditure'));
        $sheet->setCellValue('C1', __('accounts::budget.sector_details'));
        $sheet->setCellValue('D1', __('accounts::budget.budget_split_for_fiscal_year'));
        $sheet->setCellValue('E1', __('accounts::budget.gob'));
        $counter = 2;
        $start = 2;

        foreach ($reportData as $key => $data) {
            $head = explode('-', $key);
            $sheet->setCellValue('A' . $start, $head[0]);
            $sheet->setCellValue('B' . $start, $head[1]);
            $subtotal = 0;
            $subtotalGob = 0;
            foreach ($data as $datum) {
                $economyCode = $datum['economy_code'];
                $sector = $datum['sector'];
                $subtotal += $sector->revised_revenue_amount;
                $subtotalGob += $sector->revised_local_amount;

                $sheet->setCellValue('C' . $counter, $sector->code . '-' . ($lang == 'bn') ?
                    $economyCode->bangla_name : $economyCode->english_name);
                $sheet->setCellValue(
                    'D' . $counter,
                    EnToBnNumberConverter::en2bn($sector->local_amount + $sector->revenue_amount)
                );
                $sheet->setCellValue(
                    'E' . $counter,
                    EnToBnNumberConverter::en2bn($sector->revised_revenue_amount)
                );
                $counter++;
            }
            $sheet->setCellValue('C' . $counter, __('accounts::budget.subtotal') . '-' . $head[1] . ':');
            $sheet->setCellValue('D' . $counter, EnToBnNumberConverter::en2bn($subtotal));
            $sheet->setCellValue('E' . $counter, EnToBnNumberConverter::en2bn($subtotalGob));
            $counter++;
            $spreadsheet->getActiveSheet()->mergeCells('A' . $start . ':A' . ($counter - 1));
            $spreadsheet->getActiveSheet()->mergeCells('B' . $start . ':B' . ($counter - 1));
            $start = $counter;
        }

        $styleArray = $this->reportStyle();

        $spreadsheet->getActiveSheet()->getStyle('A1:E1')->applyFromArray($styleArray);

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(18);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(18);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(18);

        // Budget Cost Center sections
        $start = 1;
        $newSheet = $spreadsheet->createSheet();
        $newSheet->setTitle('Budget Cost Centers');
        $spreadsheet->setActiveSheetIndex(1);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(18);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        foreach ($budgetCostCenters as $key => $budgetCostCenter) {
            $economyCode = $budgetCostCenter->economyCode;
            $sectors = $budgetCostCenter->sectors;
            $costCenterTitle = $lang == 'bn' ? $economyCode->bangla_name : $economyCode->english_name;
            $spreadsheet->getActiveSheet()->mergeCells('A' . $start . ':C' . $start);
            $spreadsheet->getActiveSheet()->setCellValue(
                'A' . $start++,
                $costCenterTitle . ', ' . __('labels.code') . ': ' . EnToBnNumberConverter::en2bn($economyCode->code,
                    false) . ', '
                . __('accounts::budget.allocation') . '-' . EnToBnNumberConverter::en2bn($budgetCostCenter->budget_amount)
            );
            // Header for each cost center sector list
            $spreadsheet->getActiveSheet()->setCellValue('A' . $start, __('labels.serial'));
            $spreadsheet->getActiveSheet()->setCellValue('B' . $start, __('accounts::budget.sector'));
            $spreadsheet->getActiveSheet()->setCellValue('C' . $start++,
                __('accounts::budget.budget_split_for_fiscal_year'));

            $costCenterTotal = 0;
            foreach ($sectors as $key => $sector) {
                $economySector = $sector->economySector;
                $sectorTitle = $lang == 'bn' ? $economySector->title_bangla : $economySector->title;
                $spreadsheet->getActiveSheet()->setCellValue('A' . $start, ($key + 1));
                $spreadsheet->getActiveSheet()->setCellValue('B' . $start, $sectorTitle);
                $spreadsheet->getActiveSheet()->setCellValue('C' . $start++,
                    EnToBnNumberConverter::en2bn($sector->budget_amount));
                $costCenterTotal += $sector->budget_amount;
            }
            $spreadsheet->getActiveSheet()->setCellValue('A' . $start, "");
            $spreadsheet->getActiveSheet()->setCellValue('B' . $start, __('labels.total'));
            $spreadsheet->getActiveSheet()->setCellValue('C' . $start++,
                EnToBnNumberConverter::en2bn($costCenterTotal));
        }

        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
//        $spreadsheet->getActiveSheet()->getRowDimension('10')->setRowHeight(100);

        $writer = new Xlsx($spreadsheet);
        //$writer = new Xlsx($spreadsheet);
        $path = public_path() . '/files/budget_report.xlsx';
        $writer->save($path);
    }

    /**
     * Method that takes budget id as parameter and returns an array of budget sector with economy head and code
     * @param $budgetId
     * @return array
     */
    public function prepareBudgetReportData($budgetId)
    {
        $budget = $this->findOne($budgetId);
        $sectors = $budget->sectors;
        $economyHeadCode = 0;
        $economyHeads = [];
        $lang = App::getLocale();

        foreach ($sectors as $sector) {
            $sectorEconomyHeadCode = $this->economyHeadRepository->getHeadByCodeAndLevel($sector->code, 2);
            if ($economyHeadCode != $sectorEconomyHeadCode->code) {
                $economyHeadCode = $sectorEconomyHeadCode->code;
            }
            $economyHeadTitle = $lang == 'bn' ? $sectorEconomyHeadCode->bangla_name : $sectorEconomyHeadCode->english_name;
            $economyHeads[$economyHeadCode . '-' . $economyHeadTitle][] = [
                'economy_code' => $sector->economyCode,
                'sector' => $sector
            ];
        }
        return $economyHeads;
    }

    private function reportStyle(): array
    {
        return [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'FFA0A0A0',
                ],
                'endColor' => [
                    'argb' => 'FFFFFFFF',
                ],
            ],
        ];

    }

    /**
     * @param $code
     * @param $fiscalYearId
     * @return int|null
     */
    public function getRevisedBudgetAmountByCode($code, $fiscalYearId)
    {
        $fiscalYear = $this->fiscalYearService->findOne($fiscalYearId);
        $budget = $fiscalYear->budget;
        if (!$budget) {
            return null;
        }
        if (strlen($code) > 7) {
            $sectorBudget = $this->budgetCostCenterSectorRepository->getBudgetAmountByCodeAndBudget($code, $budget->id);
            $budgetAmount = $sectorBudget->budget_amount;
        } else {
            $sectorBudget = $this->accountsBudgetSectorRepository->getAmountByBudgetAndCode($budget->id, $code);
            $revisedBudgetAmount = $sectorBudget ? $sectorBudget->revised_local_amount + $sectorBudget->revised_revenue_amount : 0;
            $budgetAmount = $sectorBudget ? $sectorBudget->local_amount + $sectorBudget->revenue_amount : 0;
            $budgetAmount = $revisedBudgetAmount ? $revisedBudgetAmount : $budgetAmount;
        }

        return $budgetAmount;
    }
}
