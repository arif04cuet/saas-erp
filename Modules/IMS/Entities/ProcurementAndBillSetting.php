<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\EconomyCode;
use Modules\Accounts\Entities\Journal;

class ProcurementAndBillSetting extends Model
{
    protected $fillable = [
        'title',
        'vat_percentage',
        'vat_economy_code',
        'it_economy_code',
        'items_economy_code',
        'journal_id',
        'bill_type',
        'is_default',
        'status',
        'remark'
    ];

    public function vatEconomyCode()
    {
        return $this->belongsTo(EconomyCode::class, 'vat_economy_code', 'code');
    }

    public function itEconomyCode()
    {
        return $this->belongsTo(EconomyCode::class, 'it_economy_code', 'code');
    }

    public function itemsEconomyCode()
    {
        return $this->belongsTo(EconomyCode::class, 'items_economy_code', 'code');
    }

    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }
}
