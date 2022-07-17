<?php

namespace Modules\Accounts\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Modules\Accounts\Entities\Payslip;
use Modules\HRM\Entities\Employee;

class PayslipReportService
{
    /**
     * @var PayslipService
     */
    private $payslipService;

    public function __construct(PayslipService $payslipService)
    {
        $this->payslipService = $payslipService;
    }

    /**
     * Filter from payslips using various parameter
     * @param array $data
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection|Collection
     */
    public function filter(array $data)
    {
        $payslips = $this->payslipService->filterPayslipsByEmployees($data);
        $payslips = $this->payslipService->filterPayslipsByStatus($payslips,
            strtolower(config('constants.payslip_statuses.approve')));

        if (
            (isset($data['period_from']) && !is_null($data['period_from']))
            &&
            (isset($data['period_to']) && !is_null($data['period_to']))) {
            $payslips = $this->payslipService->filterPayslipsByDateRange($payslips, $data['period_from'],
                $data['period_to']);
        }
        $payslips = $this->payslipService->filterPayslipsByTypeName($payslips, $data['type']);
        $payslips = $this->payslipService->addEmployeeNameToCollection($payslips);
        $payslips = $this->payslipService->getPayslipsSortedByDesignationAndServicePeriod($payslips);
        return $payslips;
    }


}

