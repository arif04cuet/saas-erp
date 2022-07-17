<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;

class SpecialGroupBill extends Model
{
    protected $fillable = ['special_group_id', 'payment', 'due_total', 'remark','advance_amount'];

    public function specialGroupBillLists()
    {
        return $this->hasMany(SpecialGroupBillList::class);
    }

    public function specialGroup()
    {
        return $this->belongsTo(SpecialGroup::class);
    }
}
