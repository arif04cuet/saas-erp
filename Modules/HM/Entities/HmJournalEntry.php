<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\FiscalYear;
use Modules\Accounts\Entities\Journal;

class HmJournalEntry extends Model
{
    protected $fillable = ["fiscal_year_id", "journal_id", 'hostel_budget_title_id', "title", "date", "status"];

    //------------------------------------------------------------------------------------
    //                              Static methods
    //------------------------------------------------------------------------------------
    public static function transactionTypes($keysOnly = false, $valueInSmallCase = true)
    {
        $options = null;
        if (app()->isLocale('bn')) {
            $options = config('tms.constants.accounts.journal_entry.form_elements.dropdowns.transaction_type_bn');
        } else {
            $options = config('tms.constants.accounts.journal_entry.form_elements.dropdowns.transaction_type');
        }
        if ($keysOnly) {
            return array_keys($options);
        }
        if ($valueInSmallCase) {
            foreach ($options as $key => $value) {
                $options[$key] = strtolower($value);
            }
        }
        return $options ?? [];
    }

    public static function paymentTypes($keysOnly = false, $valueInSmallCase = true)
    {
        $options = null;
        if (app()->isLocale('bn')) {
            $options = config('tms.constants.accounts.journal_entry.form_elements.dropdowns.payment_type_bn');
        } else {
            $options = config('tms.constants.accounts.journal_entry.form_elements.dropdowns.payment_type');
        }
        if ($keysOnly) {
            return array_keys($options);
        }
        if ($valueInSmallCase) {
            foreach ($options as $key => $value) {
                $options[$key] = strtolower($value);
            }
        }
        return $options ?? [];
    }

    public static function getStatuses($keysOnly = false, $valueInSmallCase = true)
    {
        $options = null;
        if (app()->isLocale('bn')) {
            $options = config('hm.accounts.statuses.bn');
        } else {
            $options = config('hm.accounts.statuses.en');
        }
        if ($keysOnly) {
            return array_keys($options);
        }
        if ($valueInSmallCase) {
            foreach ($options as $key => $value) {
                $options[$key] = strtolower($value);
            }
        }
        return $options ?? [];
    }
    //------------------------------------------------------------------------------------
    //                                ORM Relations
    //------------------------------------------------------------------------------------

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class, 'fiscal_year_id', 'id')->withDefault();
    }

    public function HostelBudgetTitle()
    {
        return $this->belongsTo(HostelBudgetTitle::class, 'hostel_budget_title_id', 'id')
            ->withDefault();
    }

    public function journal()
    {
        return $this->belongsTo(Journal::class, 'journal_id', 'id')
            ->withDefault();
    }

    public function hmJournalEntryDetails()
    {
        return $this->hasMany(HmJournalEntryDetail::class, 'hm_journal_entry_id', 'id');
    }
}
