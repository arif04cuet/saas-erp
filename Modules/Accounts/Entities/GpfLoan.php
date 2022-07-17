<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\HRM\Entities\Employee;

class GpfLoan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id',
        'amount',
        'current_balance',
        'no_of_installment',
        'sanction_date',
        'payment_date',
        'remark',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function loans()
    {
        return $this->hasMany(GpfLoan::class, 'employee_id', 'employee_id');
    }

    public function deposits()
    {
        return $this->hasMany(GpfLoanDeposit::class);
    }
}
