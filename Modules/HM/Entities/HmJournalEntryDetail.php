<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;

class HmJournalEntryDetail extends Model
{
    protected $fillable = [
        "hm_journal_entry_id",
        "hostel_budget_section_id",
        "transaction_type",
        "credit_amount",
        "debit_amount",
        "is_cash_book_entry",
        "remark",
        "status"
    ];

    //----------------------------------------------------------------------------
    //                                  ORM Relations
    //----------------------------------------------------------------------------

    public function hmJournalEntry()
    {
        return $this->belongsTo(hmJournalEntry::class, 'hm_journal_entry_id', 'id')
            ->withDefault();
    }

    public function hmCashBookEntry()
    {
        return $this->hasOne(HmCashBookEntry::class, 'hm_journal_entry_detail_id', 'id')
            ->withDefault();
    }

    public function hostelBudgetSection()
    {
        return $this->belongsTo(HostelBudgetSection::class, 'hostel_budget_section_id', 'id')
            ->withDefault();
    }
}
