<?php
namespace Modules\Accounts\Services;

use App\Traits\CrudTrait;
use Modules\Accounts\Entities\SalaryCategory;
use Modules\Accounts\Repositories\PayslipDetailRepository;

class PayslipDetailService
{
    use CrudTrait;

    protected $payslipDetailRepository;

    public function __construct(PayslipDetailRepository $payslipDetailRepository)
    {
        $this->payslipDetailRepository = $payslipDetailRepository;
        $this->setActionRepository($this->payslipDetailRepository);
    }

    public function getAllowanceFromPayslipDetail($payslipDetail)
    {
        return $payslipDetail->filter(function ($detail) {
            return $detail->salaryRule->salaryCategory->name != SalaryCategory::SALARY_CATEGORY_DEDUCTION;
        })->sortBy(function ($u) {
            return (int)$u->salaryRule->sequence;
        })->values();
    }

    public function getDeductionFromPayslipDetail($payslipDetail)
    {
        return $payslipDetail->filter(function ($detail) {
            return $detail->salaryRule->salaryCategory->name == SalaryCategory::SALARY_CATEGORY_DEDUCTION;
        })->sortBy(function ($u) {
            return (int)$u->salaryRule->sequence;
        })->values();

    }

}

