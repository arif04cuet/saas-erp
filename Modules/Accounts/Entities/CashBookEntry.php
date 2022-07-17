<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class CashBookEntry extends Model
{
    protected $fillable = [
        'id',
        "journal_entry_detail_id",
        "fiscal_year_id",
        "payment_type",
        "amount",
        "status"
    ];

    public function journalEntryDetail()
    {
        return $this
            ->belongsTo(JournalEntryDetail::class, 'journal_entry_detail_id', 'id')
            ->withDefault();
    }

    public function economyCode()
    {
        return $this
            ->belongsTo(EconomyCode::class, 'economy_code', 'code')
            ->withDefault();
    }

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class, 'fiscal_year_id', 'id')
            ->withDefault();
    }

    public function journalEntry()
    {
        return $this->belongsTo(JournalEntryDetail::class, 'journal_entry_detail_id', 'id')
            ->first()->journalEntry();
    }
}
