<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TmsVatTaxDetail extends Model
{
    protected $fillable = [
        'training_id',
        'tms_journal_entry_detail_id',
        'vat_amount',
        'tax_amount'
    ];

    public function tmsJournalEntryDetail()
    {
        return $this->belongsTo(TmsJournalEntryDetail::class, 'tms_journal_entry_detail_id', 'id')->withDefault();
    }
}
