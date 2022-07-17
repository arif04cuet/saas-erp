<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;

class SpecialGroupBillList extends Model
{
    protected $fillable = ['special_group_bill_id', 'bill_date', 'member', 'charge', 'total_charge'];
}
