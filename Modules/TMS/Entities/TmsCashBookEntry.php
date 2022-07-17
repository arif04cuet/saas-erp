<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TmsCashBookEntry extends Model
{
    protected $fillable = [
        "training_id",
        "tms_journal_entry_detail_id",
        "payment_type",
        "amount",
        "date",
        "status"
    ];

    public function tmsJournalEntryDetail()
    {
        return $this->belongsTo(TmsJournalEntryDetail::class, 'tms_journal_entry_detail_id', 'id')
            ->withDefault();
    }
}
