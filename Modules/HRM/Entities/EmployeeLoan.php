<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeLoan extends Model
{
    protected $fillable = [
        'employee_loan_circular_id',
        'employee_id',
        'type',
        'amount',
        'installment',
        'reference_no',
        'reason',
        'remarks',
        'attachment',
        'previous_loans',
        'association_loan',
        'association_loan_amount',
        'bank_loan',
        'bank_name',
        'bank_loan_amount',
        'status',
        'created_by',
        'approval_date'
    ];

    public function circular()
    {
        return $this->belongsTo(EmployeeLoanCircular::class, 'employee_loan_circular_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function loans()
    {
        return $this->hasMany(EmployeeLoan::class, 'id', 'id');
    }

    public function total()
    {
        return $this->hasMany(EmployeeLoan::class, 'id', 'id')->sum('amount');
    }
}
