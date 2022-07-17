<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class TmsAdvancePayment extends Model
{
    protected $fillable = [
        "training_id",
        "employee_id",
        "tms_journal_entry_id",
        "total_debit_amount",
        "total_credit_amount",
        "date",
        "status"
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id')->withDefault();
    }

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id', 'id')->withDefault();
    }

    public function tmsJournalEntry()
    {
        return $this->belongsTo(TmsJournalEntry::class, 'tms_journal_entry_id', 'id')
            ->withDefault();
    }

    public static function getStatuses()
    {
        return config('tms.constants.accounts.statuses');
    }
}
