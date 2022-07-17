<?php

namespace Modules\Publication\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\JournalEntry;

class PublicationIncomeExpenseEntry extends Model
{
    protected $fillable = ['journal_entry_id'];

    public function journalEntry()
    {
        return $this->belongsTo(JournalEntry::class);
    }
}
