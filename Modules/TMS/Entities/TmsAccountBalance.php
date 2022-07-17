<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TmsAccountBalance extends Model
{
    protected $fillable = [
        "training_id",
        "tms_sub_sector_id",
        "total_receive_amount",
        "total_payment_amount",
    ];

    protected $attributes = [
        'total_receive_amount' => 0.0,
        'total_payment_amount' => 0.0
    ];
}
