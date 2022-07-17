<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Nexmo\Account\Config;

class JournalEntryDetail extends Model
{
    protected $fillable = [
        "journal_entry_id",
        "economy_code",
        "credit_amount",
        "debit_amount",
        "source",
        "account_transaction_type",
        'is_cash_book_entry',
        "remark",
        "status"
    ];

    // static functions
    public static function getSources()
    {
        return Config('constants.journal_entry.source');
    }

    public static function getTransactionTypes()
    {
        return Config('constants.journal_entry.account_transaction_type');
    }

    public static function getPaymentTypes()
    {
        return Config('constants.journal_entry.payment_type');
    }

    public static function getSourcesForDropdown()
    {
        return Config('constants.journal_entry.dropdown.source');
    }

    public static function getTransactionTypesForDropdown()
    {
        return Config('constants.journal_entry.dropdown.account_transaction_type');
    }

    public static function getPaymentTypesForDropdown()
    {
        return Config('constants.journal_entry.dropdown.payment_type');
    }

    public static function getCalculationProperty()
    {
        return [
            'receipt' => [
                'amount_found_in' => 'credit_amount',
                'calculation_type' => self::getCalculationTypes()[0] // increment
            ],
            'payment' => [
                'amount_found_in' => 'debit_amount',
                'calculation_type' => self::getCalculationTypes()[1] // decrement
            ]
        ];
    }

    public static function getCalculationTypes()
    {
        return ['increment', 'decrement'];
    }


    // ORM mapping
    public function journalEntry()
    {
        return $this->belongsTo(JournalEntry::class, 'journal_entry_id', 'id')
            ->withDefault();
    }

    public function cashBookEntry()
    {
        return $this->hasOne(CashBookEntry::class, 'journal_entry_detail_id', 'id');
    }

    public function economyCode()
    {
        return $this->belongsTo(EconomyCode::class, 'economy_code', 'code')
            ->withDefault();
    }

    /**
     * Get the statuses of journal entry detail
     *
     * @return array
     */
    public static function getStatuses()
    {
        return array_keys(config('constants.journal_entry.statuses'));
    }
}
