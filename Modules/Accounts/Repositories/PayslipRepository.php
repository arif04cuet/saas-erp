<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Carbon\Carbon;
use Modules\Accounts\Entities\Payslip;

class PayslipRepository extends AbstractBaseRepository
{
    protected $modelName = Payslip::class;

    /**
     * @param null $from
     * @param null $to
     * @param string $type
     * @return mixed
     */
    public function getEmployeeIds($from = null, $to = null, $type = null)
    {
        if (is_null($from)) {
            $from = date('Y-m-01');
        }
        if (is_null($to)) {
            $to = date('Y-m-t');
        }
        if (is_null($type)) {
            $type = Payslip::getTypes()[0];
        }

        return $this->model->whereBetween('period_from', [$from, $to])
            ->whereBetween('period_to', [$from, $to])
            ->where('type', $type)
            ->get()->pluck('employee_id');
    }

    public function getPayslipsFromEmployeeId($employeeId, $from = null, $to = null)
    {
        if (is_null($from)) {
            $from = date('Y-m-01');
        }
        if (is_null($to)) {
            $to = date('Y-m-t');
        }
        return $this->model->where('employee_id', $employeeId)
            ->whereBetween('period_from', [$from, $to])
            ->whereBetween('period_to', [$from, $to])
            ->get();
    }

    public function getPayslipAmountsFromSalaryRules($employeeId, array $salaryRules)
    {
        return $this->model->select('payslip_details.*', 'payslips.period_from')
            ->where('payslips.employee_id', $employeeId)
            ->leftJoin('payslip_details', 'payslips.id', '=', 'payslip_details.payslip_id')
            ->whereIn('payslip_details.salary_rule_id', $salaryRules)
            ->get();
    }

    /**
     * Get all the payslips of a month and a year
     * @param Carbon $month
     * @param Carbon $year
     * @return mixed
     */
    public function getPayslipsByMonthAndYear(Carbon $month, Carbon $year)
    {
        return $this->model->whereYear('period_from', '=', $year->format('Y'))
            ->whereMonth('period_from', '=', $month->format('m'))
            ->get();
    }

    public function getPayslipsByDateRange(Carbon $from, Carbon $to)
    {
        return $this->model->newQuery()
            ->where('period_from', '>=', $from->format('Y-m-d'))
            ->where('period_to', '<=', $to->format('Y-m-d'))
            ->get();
    }


}
