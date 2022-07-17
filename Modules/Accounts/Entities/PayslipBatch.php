<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;

class PayslipBatch extends Model
{
    const COLUMN_NAME = "name";
    const COLUMN_PERIOD_FROM = "period_from";
    const COLUMN_PERIOD_TO = "period_to";
    const COLUMN_AMOUNT = "amount";
    const COLUMN_JOURNAL_ID = "journal_id";

    protected $fillable = [
        self::COLUMN_NAME,
        self::COLUMN_PERIOD_FROM,
        self::COLUMN_PERIOD_TO,
        self::COLUMN_AMOUNT,
        self::COLUMN_JOURNAL_ID
    ];

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }

}
