<?php

namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Accounts\Entities\MasterRollEmployee;
use Modules\Accounts\Repositories\MasterRollEmployeeRepository;
use Modules\HRM\Services\EmployeeService;

class MasterRollEmployeeService
{
    use CrudTrait;
    private $employeeService;

    public function __construct(
        MasterRollEmployeeRepository $masterRollEmployeeRepository,
        EmployeeService $employeeService
    )
    {
        $this->setActionRepository($masterRollEmployeeRepository);
        $this->employeeService = $employeeService;
    }

    public function saveData(array $data)
    {
        try {
            if (!isset($data['employee_id'])) {
                Session::flash('error', 'Select at least one user');
                throw new \Exception('Select at least one user');
            }
            $rows = count($data['employee_id']);
            $defaultValues = array();
            $errorEmployee = array();
            for ($i = 0; $i < $rows; ++$i) {
                $employee = $this->getEmployee($data['employee_id'][$i]);
                $defaultValues['employee_id'] = $employee->id ?? null;
                $defaultValues['payment_per_day'] = $data['payment_per_day'][$i];
//                $masterRollEmployee = optional($employee)->masterRoll;
//                if (is_null($masterRollEmployee)) {
//                    array_push($errorEmployee, optional($employee)->getName());
//                    Session::flash('error', implode(', ', $errorEmployee) . " is not master roll employee");
//                    return;  // if continue,, all error user will be printed
//                }
                $this->actionRepository->getModel()->updateOrCreate(
                    ['employee_id' => $defaultValues['employee_id']],
                    ['payment_per_day' => $defaultValues['payment_per_day']]
                );
            }
            return true;
        } catch (\Exception $e) {
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

