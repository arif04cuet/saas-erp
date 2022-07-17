<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\FiscalYear;

class HmCashBookEntry extends Model
{
    protected $fillable = ["fiscal_year_id", "hm_journal_entry_detail_id", "payment_type", "amount", "date", "status"];

    public function fiscalYear()
    {
        return $this
            ->belongsTo(FiscalYear::class, 'fiscal_year_id', 'id')
            ->withDefault();
    }

    public function hmJournalEntryDetail()
    {
        return $this->belongsTo(HmJournalEntryDetail::class, 'hm_journal_entry_detail', 'id')
            ->withDefault();
    }
}
