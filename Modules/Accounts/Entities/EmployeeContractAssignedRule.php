<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeContractAssignedRule extends Model
{
    protected $fillable = ['employee_contract_id', 'salary_rule_id', 'amount', 'remark'];

    public function salaryRule()
    {
        return $this->belongsTo(SalaryRule::class);
    }
}
