<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\JournalEntry;

class CafeteriaIncomeExpenseEntry extends Model
{
    protected $fillable = ['journal_entry_id'];

    public function journalEntry()
    {
        return $this->belongsTo(JournalEntry::class);
    }
}
