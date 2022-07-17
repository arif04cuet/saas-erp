<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class SalaryCategory extends Model
{
    const SALARY_CATEGORY_DEDUCTION = 'Deduction';

    protected $fillable = ['name', 'description'];

    /**
     * Fetch all the related rules
     */
    public function salaryRules()
    {
        return $this->hasMany(SalaryRule::class, 'salary_category_id', 'id');
    }

}
