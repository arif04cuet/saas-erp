<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use App\Utilities\EnToBnNumberConverter;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\BudgetCostCenter;
use Modules\Accounts\Entities\BudgetCostCenterSector;
use Modules\Accounts\Repositories\BudgetCostCenterRepository;
use Modules\Accounts\Repositories\BudgetCostCenterSectorRepository;
use Modules\Accounts\Repositories\EconomySectorRepository;

class BudgetCostCenterService
{
    use CrudTrait;

    /**
     * @var BudgetCostCenterRepository
     */
    private $budgetCostCenterRepository;
    /**
     * @var BudgetCostCenterSectorRepository
     */
    private $budgetCostCenterSectorRepository;
    /**
     * @var EconomySectorRepository
     */
    private $economySectorRepository;
    /**
     * @var EconomyCodeService
     */
    private $economyCodeService;

    /**
     * BudgetCostCenterService constructor.
     * @param BudgetCostCenterRepository $budgetCostCenterRepository
     * @param BudgetCostCenterSectorRepository $budgetCostCenterSectorRepository
     * @param EconomySectorRepository $economySectorRepository
     * @param EconomyCodeService $economyCodeService
     */
    public function __construct(
        BudgetCostCenterRepository $budgetCostCenterRepository,
        BudgetCostCenterSectorRepository $budgetCostCenterSectorRepository,
        EconomySectorRepository $economySectorRepository,
        EconomyCodeService $economyCodeService
    ) {
        $this->budgetCostCenterRepository = $budgetCostCenterRepository;
        $this->setActionRepository($budgetCostCenterRepository);
        $this->budgetCostCenterSectorRepository = $budgetCostCenterSectorRepository;
        $this->economySectorRepository = $economySectorRepository;
        $this->economyCodeService = $economyCodeService;
    }

    /**
     * Saving budget cost center data with all the requested sectors
     * @param array $data
     * @return bool
     */
    public function saveBudgetCostCenter(array $data)
    {
        try {
            DB::transaction(function () use ($data) {
                $budgetCostCenterData = [
                    'economy_code' => $data['economy_code'],
                    'accounts_budget_id' => $data['accounts_budget_id'],
                    'budget_amount' => $data['budget_amount'],
                ];
                $save = $this->save($budgetCostCenterData);

                /**
                 * Saving Budget Cost Center Sectors
                 */
                foreach ($data['sector_budget_amounts'] as $sectorCode => $sectorAmount) {
                    $sectorData = [
                        'budget_cost_center_id' => $save->id,
                        'title' => "",
                        'economy_sector_code' => $sectorCode,
                        'budget_amount' => $sectorAmount ?? 0,
                        'sequence' => $data['sequence'][$sectorCode]
                    ];
                    $this->budgetCostCenterSectorRepository->save($sectorData);
                }
            });
            Session::flash('success', __('labels.save_success'));
            return true;
        } catch (\Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return false;
        }
    }

    /**
     * Updating budget cost center data with changes in budget cost center sector
     * @param array $data
     * @param $budgetCostCenterId
     * @return bool
     */
    public function updateBudgetCostCenter(array $data, $budgetCostCenterId): bool
    {
        try {
            DB::transaction(function () use ($data, $budgetCostCenterId) {
                $budgetCostCenterData = [
                    'accounts_budget_id' => $data['accounts_budget_id'],
                    'budget_amount' => $data['budget_amount'],
                ];
                $this->findOrFail($budgetCostCenterId)->update($budgetCostCenterData);

                /**
                 * Updating budget cost center sectors
                 */
                foreach ($data['sector_budget_amount'] as $code => $amount) {
                    $updateData = [
                        'budget_amount' => $amount,
                        'sequence' => $data['sequence'][$code]
                    ];
                    $checkSectorExist = $this->budgetCostCenterSectorRepository->findBy(
                        ['budget_cost_center_id' => $budgetCostCenterId, 'economy_sector_code' => $code]
                    );
                    if ($checkSectorExist->count()) {
                        BudgetCostCenterSector::where('budget_cost_center_id', $budgetCostCenterId)
                            ->where('economy_sector_code', $code)
                            ->update($updateData);
                    } else {
                        $updateData['budget_cost_center_id'] = $budgetCostCenterId;
                        $updateData['economy_sector_code'] = $code;
                        $updateData['title'] = '';
                        $this->budgetCostCenterSectorRepository->save($updateData);
                    }
                }
            });
            Session::flash('success', __('labels.update_success'));
            return true;
        } catch (\Exception $exception) {
            Session::flash('error', __('labels.update_fail') . '<br>' . $exception->getMessage());
            return false;
        }
    }

    public function getEconomyCodeWithSectors()
    {
        $codes = $this->economySectorRepository->findAll()
            ->pluck('parent_economy_code', 'parent_economy_code')
            ->toArray();
        return $this->economyCodeService->findIn('code', $codes)->each(function ($item) {
            return $item->title = App::getLocale() == 'bn' ? EnToBnNumberConverter::en2bn($item->code, false) .
                ' - ' . $item->bangla_name : $item->code . ' - ' . $item->english_name;
        })
            ->pluck('title', 'code')
            ->toArray();
    }

    /**
     * Returns and array of saved and unsaved merged economy sectors for budget
     * @param BudgetCostCenter $budgetCostCenter
     * @return array
     */
    public function getSavedUnsavedSectors(BudgetCostCenter $budgetCostCenter)
    {
        $sectorData = [];
        $sectors = $budgetCostCenter->sectors;
        $sectorCodes = $sectors->pluck('economy_sector_code')->toArray() ?? [];
        foreach ($sectors as $sector) {
            $economySector = $sector->economySector ?? null;
            $sectorData[] = [
                'id' => $sector->id,
                'code' => $sector->economy_sector_code,
                'title' => $economySector ? App::getLocale() == 'bn' ? $economySector->title_bangla :
                    $economySector->title : __('labels.not_found'),
                'amount' => $sector->budget_amount,
                'sequence' => $sector->sequence
            ];
        }
        /**
         * Fetching unsaved economy sectors
         */
        $economySectors = $this->economySectorRepository
            ->findBy(['parent_economy_code' => $budgetCostCenter->economy_code])
            ->reject(function ($item) use ($sectorCodes) {
                return in_array($item->code, $sectorCodes);
            });
        foreach ($economySectors as $economySector) {
            $sectorData[] = [
                'id' => null,
                'code' => $economySector->code,
                'title' => App::getLocale() == 'bn' ? $economySector->title_bangla : $economySector->title,
                'amount' => '',
                'sequence' => null
            ];
        }
        return $sectorData;
    }
}

