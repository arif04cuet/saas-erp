<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;

class CheckinPayment extends Model
{
    protected $fillable = ['checkin_id', 'shortcode', 'amount', 'type', 'check_number'];
}
