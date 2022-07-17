<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class AccountTransactionHistory extends Model
{
    protected $fillable = [
        "employee_id",
        "economy_code",
        "journal_entry_detail_id",
        "fiscal_year_id",
        "previous_balance",
        "updated_balance"
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id')
            ->withDefault();
    }

    public function journalEntryDetail()
    {
        return $this->belongsTo(JournalEntryDetail::class, 'journal_entry_detail_id', 'id')
            ->withDefault();
    }

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class, 'fiscal_year_id', 'id')
            ->withDefault();
    }

    public function economyCode()
    {
        return $this->belongsTo(EconomyCode::class, 'economy_code', 'code')->withDefault();
    }

}
