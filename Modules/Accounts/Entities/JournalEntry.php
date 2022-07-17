<?php

namespace Modules\Accounts\Entities;

use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Department;
use Modules\IMS\Entities\ProcurementBilling;

class JournalEntry extends Model
{

    const COLUMN_JOURNAL_ID = 'journal_id';
    const COLUMN_DATE = 'date';
    const COLUMN_REFERENCE = 'reference';
    const COLUMN_FISCAL_YEAR = 'fiscal_year_id';
    const COLUMN_STATUS = 'status';

    protected $fillable = [
        self::COLUMN_REFERENCE,
        self::COLUMN_JOURNAL_ID,
        self::COLUMN_DATE,
        self::COLUMN_FISCAL_YEAR,
        self::COLUMN_STATUS,
    ];

    public function journal()
    {
        return $this->belongsTo(Journal::class, 'journal_id', 'id')->withDefault();
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id')->withDefault();
    }

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class, 'fiscal_year_id', 'id');
    }

    public function journalEntryDetails()
    {
        return $this->hasMany(JournalEntryDetail::class, 'journal_entry_id', 'id');
    }

    public function procurementBilling()
    {
        return $this->hasOne(ProcurementBilling::class, 'journal_entry_id', 'id');
    }


    /**
     * Get all the status of Journal entryl
     *
     * @return Repository|mixed
     */
    public static function getStatuses()
    {
        return array_keys(config('constants.journal_entry.statuses'));
    }

    public static function getTransactionSources()
    {
        if (app()->isLocale('bn')) {
            return config('constants.journal_entry.dropdown.source_bn');
        } else {
            return config('constants.journal_entry.dropdown.source');
        }
    }

    public static function getTransactionTypes()
    {
        if (app()->isLocale('bn')) {
            return config('constants.journal_entry.dropdown.account_transaction_type_bn');
        } else {
            return config('constants.journal_entry.dropdown.account_transaction_type');
        }
    }

    public static function getPaymentTypes()
    {
        if (app()->isLocale('bn')) {
            return config('constants.journal_entry.dropdown.payment_type_bn');
        } else {
            return config('constants.journal_entry.dropdown.payment_type');
        }
    }
}
