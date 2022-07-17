<?php

namespace Modules\HRM\Services;

use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Repositories\EmployeeLoanRepository;

class EmployeeLoanService
{
    use CrudTrait;
    use FileTrait;
    /**
     * @var EmployeeService
     */
    private $employeeService;
    /**
     * @var EmployeeLoanRepository
     */
    private $employeeLoanRepository;

    /**
     * EmployeeLoanService constructor.
     * @param EmployeeService $employeeService
     * @param EmployeeLoanRepository $employeeLoanRepository
     */
    public function __construct(EmployeeService $employeeService, EmployeeLoanRepository $employeeLoanRepository)
    {
        $this->employeeService = $employeeService;
        $this->employeeLoanRepository = $employeeLoanRepository;
        $this->setActionRepository($employeeLoanRepository);
    }

    /**
     * @param array $data
     * @return bool|\Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try {
            $data['previous_loans'] = !empty($data['previous_loan_type']) ? implode(', ',$data['previous_loan_type']) : '';
            $data['created_by'] = Auth::user()->id;
            return $saved = $this->save($data);

        } catch (\Exception $e) {
            Session::flash('error', __('labels.save_fail') . ' ' . __('labels.error_code',
                    ['code' => $e->getCode()]));
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    public function approval(array $data, $id)
    {
        try {
            $loan = $this->findOne($id);
            if (!empty($data['attachment'])) {
                $data['attachment'] = $this->upload($data['attachment'], 'loans');
            }
            $data['approval_date'] = Carbon::now();
            $data['status'] = 'approved';
            return $loan->update($data);

        } catch (\Exception $e) {
            Session::flash('error', __('labels.save_fail') . ' ' . __('labels.error_code',
                    ['code' => $e->getCode()]));
            Log::error($e->getMessage() . ', trace: ' . $e->getTraceAsString());
            return false;
        }

    }

    public function employeesWithApprovedLoan()
    {
        return $this->findBy(['status' => 'approved'], ['employee'])->unique('employee_id');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function employeeListForDropdown()
    {
        if (Auth::user()->can('hrm-user-access')) {
            $employees = $this->employeeService->findAll()->each(function ($employee) {
                return $employee->details = $employee->getName() . ' - ' . $employee->mobile_one;
            });
        } else {
            $employees[] = Auth::user()->employee;
            $employees = collect($employees)->each(function ($employee) {
                return $employee->details = $employee->getName() . ' - ' . $employee->mobile_one;
            });
        }

        return $employees->pluck('details', 'id');
    }
}

