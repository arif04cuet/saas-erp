<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\HRM\Entities\Employee;

class EmployeeContract extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'reference',
        'employee_id',
        'salary_structure_id',
        'salary_grade',
        'increment',
        'start_date',
        'end_date',
        'probation_end',
        'bank_account_no',
        'hr_responsible',
        'house_allotment',
        'car_facility'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function hrResponsible()
    {
        return $this->belongsTo(Employee::class, 'hr_responsible', 'id');
    }

    public function assignedRules()
    {
        return $this->hasMany(EmployeeContractAssignedRule::class);
    }

    public function salaryStructure()
    {
        return $this->belongsTo(SalaryStructure::class);
    }

    public function getSalaryGrade()
    {
        return $this->salary_grade ?? 0;
    }

    public function getIncrement()
    {
        return $this->increment ?? 0;
    }

    // model query required for excel report
    public function getMinSalary()
    {
        $activePayscale = $this->getActivePayScale();
        $salaryBasic = SalaryBasic::where('payscale_id', $activePayscale->id)->where('grade',
            $this->salary_grade)->first();
        return $salaryBasic->basic_salary;

    }

    public function getMaxSalary()
    {
        $activePayscale = $this->getActivePayScale();
        $salaryBasic = SalaryBasic::where('payscale_id', $activePayscale->id)->where('grade',
            $this->salary_grade)->first();
        $basicSalary = $salaryBasic->basic_salary;
        $percentage = $salaryBasic->percentage_of_increment;
        for ($count = 1; $count <= $salaryBasic->no_of_increment; $count++) {
            $basicSalary += (($basicSalary * $percentage) / 100);
            $basicSalary = round(ceil(($basicSalary) / 10)) * 10;
        }
        return $basicSalary;
    }

    private function getActivePayScale()
    {
        return Payscale::where('status', 1)->first();
    }

    public function getBasicSalary()
    {
        $activePayscale = $this->getActivePayScale();
        $basics = (!is_null($activePayscale)) ? $activePayscale->salaryBasics : [];
        $basicSalary = 0;
        $percentage = 5;
        $maxIncrement = $this->increment;
        foreach ($basics as $basic) {
            if ($basic->grade == $this->salary_grade) {
                $basicSalary = $basic->basic_salary;
                $maxIncrement = $basic->no_of_increment;
                $percentage = $basic->percentage_of_increment;
            }
        }
        if ($this->increment && $this->increment <= $maxIncrement) {
            for ($count = 1; $count <= $this->increment; $count++) {
                $basicSalary += (($basicSalary * $percentage) / 100);
                $basicSalary = round(ceil(($basicSalary) / 10)) * 10;
            }
        }
        return $basicSalary;
    }

}
