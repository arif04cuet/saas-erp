<?php


namespace Modules\Accounts\Repositories;

use App\Repositories\AbstractBaseRepository;
use Modules\Accounts\Entities\PayslipDetail;

class PayslipDetailRepository extends AbstractBaseRepository
{
    protected $modelName = PayslipDetail::class;

    public function getDetailsWithRuleAndPayslipId(array $ruleIds, array $payslipIds)
    {
        return $this->model->whereIn('salary_rule_id', $ruleIds)->whereIn('payslip_id', $payslipIds)->get();
    }
}
