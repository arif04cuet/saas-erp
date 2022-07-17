<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TripBillPayment extends Model
{
    protected $fillable = [
        'trip_id',
        'payment_option',
        'amount',
        'status'
    ];

    public static function getPaymentStatus()
    {
        return config('vms.trip.payment_status');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id', 'id')->withDefault();
    }
}
