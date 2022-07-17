<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class GpfRecord extends Model
{
    protected $fillable = [
        'employee_id',
        'fund_number',
        'stock_balance',
        'current_balance',
        'current_percentage',
        'remark',
        'start_date',
        'settlement_date',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function histories()
    {
        return $this->hasMany(GpfHistory::class, 'employee_id', 'employee_id')
            ->orderBy('created_at', 'desc');
    }

    public function monthlyRecords()
    {
        return $this->hasMany(GpfMonthlyRecord::class, 'employee_id', 'employee_id');
    }

    public function loans()
    {
        return $this->hasMany(GpfLoan::class, 'employee_id', 'employee_id');
    }
}
