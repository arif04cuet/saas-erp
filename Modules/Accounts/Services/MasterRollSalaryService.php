<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Repositories\MasterRollSalaryRepository;
use Modules\HRM\Services\EmployeeService;

class MasterRollSalaryService
{

    use CrudTrait;
    protected $employeeService;

    public function __construct(
        MasterRollSalaryRepository $masterRollSalaryRepository,
        EmployeeService $employeeService
    )
    {
        $this->setActionRepository($masterRollSalaryRepository);
        $this->employeeService = $employeeService;
    }

    public function saveData(array $data)
    {
        try {
            DB::beginTransaction();
            if (!isset($data['designation'])) {
                Session::flash('error', 'Select at least one user');
                throw new \Exception('Select at least one user');
            }
            $rows = count($data['designation']);
            $periodFrom = $data['period_from'];
            $periodTo = $data['period_to'];
            $defaultValues = array('period_from' => $periodFrom, 'period_to' => $periodTo);
            for ($i = 0; $i < $rows; ++$i) {
                $employeeId = $this->getEmployee($data['designation'][$i])->id ?? null;
                $defaultValues['employee_id'] = $employeeId;
                $defaultValues['number_of_days'] = $data['number_of_days'][$i];
                $defaultValues['payment_per_day'] = $data['payment_per_day'][$i];
                $defaultValues['total_amount'] = $data['number_of_days'][$i] * $data['payment_per_day'][$i];
                $this->actionRepository->save($defaultValues);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error Message ' . $e->getMessage() . ' Trace = ' . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * @param $employeeId
     * @return mixed
     */
    private function getEmployee($employeeId)
    {
        $employeeId = trim($employeeId);
        try {
            return $this->employeeService->findBy(['employee_id' => $employeeId])->first();
        } catch (\Exception $e) {
            Log::error('Something went wrong for ' . $employeeId);
        }
    }


}

