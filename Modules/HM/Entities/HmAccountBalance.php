<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Accounts\Entities\FiscalYear;

class HmAccountBalance extends Model
{
    protected $fillable = [
        "fiscal_year_id",
        "hostel_budget_section_id",
        "total_receive_amount",
        "total_payment_amount"
    ];


    protected $attributes = [
        'total_receive_amount' => 0.0,
        'total_payment_amount' => 0.0
    ];

    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class, 'fiscal_year_id', 'id')->withDefault();
    }

    public function hostelBudgetSection()
    {
        return $this->belongsTo(HostelBudgetSection::class, 'hostel_budget_section_id', 'id')->withDefault();
    }
}
