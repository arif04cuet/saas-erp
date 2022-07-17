<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class EmployeeAdvancePayment extends Model
{
    protected $fillable = [
        "id",
        "employee_id",
        "journal_entry_id",
        "total_debit_amount",
        "total_credit_amount",
        "remark",
        "status"
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id')->withDefault();
    }

    public function journalEntry()
    {
        return $this->belongsTo(JournalEntry::class, 'journal_entry_id', 'id')->withDefault();
    }

    public static function getStatuses()
    {
        return config('constants.journal_entry.statuses');
    }

}
