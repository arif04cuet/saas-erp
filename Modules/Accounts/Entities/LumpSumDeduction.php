<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class LumpSumDeduction extends Model
{
    protected $fillable = ["employee_id", "pension_deduction_id", "amount", "remark"];

    public function lumpSum()
    {
        return $this->belongsTo(EmployeeLumpSum::class, 'employee_id', 'employee_id')
            ->withDefault();
    }

    public function pensionDeduction()
    {
        return $this->belongsTo(PensionDeduction::class, 'pension_deduction_id', 'id')
            ->withDefault();
    }
}
