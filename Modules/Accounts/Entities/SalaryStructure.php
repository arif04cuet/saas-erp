<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class SalaryStructure extends Model
{
    protected $fillable = ['parent_structure', 'name', 'reference', 'is_parent'];

    public function rules()
    {
        return $this->belongsToMany(SalaryRule::class, 'salary_structure_rules')
            ->withPivot('salary_rule_id')
            ->orderBy('sequence', 'asc');
    }

    public function parent()
    {
        return $this->belongsTo(SalaryStructure::class, 'parent_structure', 'id')->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employeeContracts()
    {
        return $this->hasMany(EmployeeContract::class, 'salary_structure_id', 'id');
    }

    /**
     * get all rules from its structure
     * and parent structure
     *
     * @return mixed
     */
    public function getAllRules()
    {
        $rules = $this->rules;
        if (!(is_null($this->parent_structure))) {
            $parentRules = $this->parent->rules;
            return $rules->merge($parentRules);
        }
        return $rules;
    }

    public function getName()
    {
        return App::getLocale() == 'bn' ? $this->bangla_name ?? $this->name :
            $this->name;
    }
}
