<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Illuminate\Http\RedirectResponse as RedirectResponseAlias;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Repositories\EmployeeContractRepository;
use Modules\Accounts\Repositories\MonthlyPensionContractRepository;
use phpDocumentor\Reflection\Types\Mixed_;

class MonthlyPensionContractService
{
    use CrudTrait;
    /**
     * @var MonthlyPensionContractRepository
     */
    private $monthlyPensionContractRepository;
    /**
     * @var EmployeeContractRepository
     */
    private $employeeContractRepository;
    /**
     * @var PayscaleService
     */
    private $payscaleService;
    /**
     * @var PensionConfigurationService
     */
    private $pensionConfigurationService;

    /**
     * MonthlyPensionContractService constructor.
     * @param MonthlyPensionContractRepository $monthlyPensionContractRepository
     * @param EmployeeContractRepository $employeeContractRepository
     * @param PayscaleService $payscaleService
     * @param PensionConfigurationService $pensionConfigurationService
     */
    public function __construct(
        MonthlyPensionContractRepository $monthlyPensionContractRepository,
        EmployeeContractRepository $employeeContractRepository,
        PayscaleService $payscaleService,
        PensionConfigurationService $pensionConfigurationService
    ) {
        $this->monthlyPensionContractRepository = $monthlyPensionContractRepository;
        $this->setActionRepository($monthlyPensionContractRepository);
        $this->employeeContractRepository = $employeeContractRepository;
        $this->payscaleService = $payscaleService;
        $this->pensionConfigurationService = $pensionConfigurationService;
    }

    /**
     * @param array $data
     * @return RedirectResponseAlias
     */
    public function saveData(array $data)
    {
        try {
            DB::transaction(function () use ($data) {
                $data['status'] = 'inactive';
                $save = $this->save($data);
                Session::flash('success', __('labels.save_success'));
                return $save;
            });
        } catch (\Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * @param array $data
     * @param $id
     * @return Mixed
     */
    public function updateData(array $data, $id)
    {
        try {
            DB::transaction(function () use ($data, $id) {
                $this->findOrFail($id)->update($data);
                Session::flash('success', __('labels.update_success'));
                return true;
            });
        } catch (\Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * @param $employeeId
     * @param bool $hasIncrement
     * @return float
     */
    public function getInitialBasic($employeeId, $hasIncrement = false): float
    {
        $contract = $this->employeeContractRepository->findBy(['employee_id' => $employeeId])->first();
        if (!$contract) {
            return 0;
        }
        $configuration = $this->pensionConfigurationService->getActiveConfiguration();
        $increment = $hasIncrement ? $this->payscaleService
            ->nextApplicableIncrement($contract->salary_grade, $contract->increment) : $contract->increment;
        $lastBasic = ($contract) ?
            $this->payscaleService->getBasicSalary($contract->salary_grade, $increment) : 0;

        return (((($lastBasic * $configuration->percentage) / 100) * $configuration->monthly_pension_percentage) / 100);
    }

    public function toggleActivation($id)
    {
        try {
            $contract = $this->findOrFail($id);
            if ($contract->status == 'active') {
                $this->update($contract, ['status' => 'inactive']);
            } else {
                $this->monthlyPensionContractRepository->updateByEmployeeId(
                    $contract->employee_id,
                    ['status' => 'inactive']
                );
                $this->update($contract, ['status' => 'active']);
            }
        } catch (\Exception $exception) {
            Session::falsh('error', $exception->getMessage());
        }
    }

    public function getActiveContracts()
    {
        return $this->findBy(['status' => 'active']);
    }

}

