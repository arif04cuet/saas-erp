<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class SalaryRuleChild extends Model
{
    protected $fillable = ['salary_rule_id', 'child_rule_id'];

    public function salaryRule()
    {
        return $this->belongsTo(SalaryRule::class, 'child_rule_id');
    }
}
