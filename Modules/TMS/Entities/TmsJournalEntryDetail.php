<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;

class TmsJournalEntryDetail extends Model
{
    protected $fillable = [
        "tms_journal_entry_id",
        'employee_id',
        "tms_sub_sector_id",
        "transaction_type",
        "credit_amount",
        "debit_amount",
        "is_cash_book_entry",
        "remark",
        "status"
    ];

    public static function getTransactionTypes()
    {
        if (app()->isLocale('bn')) {
            return config('tms.constants.accounts.journal_entry.form_elements.dropdowns.transaction_type_bn');
        } else {
            return config('tms.constants.accounts.journal_entry.form_elements.dropdowns.transaction_type');
        }
    }

    public function tmsjournalEntry()
    {
        return $this->belongsTo(TmsJournalEntry::class, 'tms_journal_entry_id', 'id')
            ->withDefault();
    }

    public function tmsCashBookEntry()
    {
        return $this->hasOne(TmsCashBookEntry::class, 'tms_journal_entry_detail_id', 'id')
            ->withDefault();
    }

    public function tmsVatTaxDetail()
    {
        return $this->hasOne(TmsVatTaxDetail::class, 'tms_journal_entry_detail_id', 'id')
            ->withDefault();
    }

    public function tmsSubSector()
    {
        return $this->belongsTo(TmsSubSector::class, 'tms_sub_sector_id', 'id')->withDefault();
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id')->withDefault();
    }

}
