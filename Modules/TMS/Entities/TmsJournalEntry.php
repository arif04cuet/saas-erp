<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\Journal;

class TmsJournalEntry extends Model
{
    protected $fillable = ["training_id", "journal_id", 'fiscal_year_id', "title", "date", "status"];

    public static function transactionTypes()
    {
        if (app()->isLocale('bn')) {
            return config('tms.constants.accounts.journal_entry.form_elements.dropdowns.transaction_type_bn');
        } else {
            return config('tms.constants.accounts.journal_entry.form_elements.dropdowns.transaction_type');
        }
    }

    public static function paymentTypes()
    {
        if (app()->isLocale('bn')) {
            return config('tms.constants.accounts.journal_entry.form_elements.dropdowns.payment_type_bn');
        } else {
            return config('tms.constants.accounts.journal_entry.form_elements.dropdowns.payment_type');
        }
    }

    public function tmsJournalEntryDetails()
    {
        return $this->hasMany(TmsJournalEntryDetail::class, 'tms_journal_entry_id');
    }

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id', 'id')
            ->withDefault();
    }

    public function journal()
    {
        return $this->belongsTo(Journal::class, 'journal_id', 'id')
            ->withDefault();
    }

}
