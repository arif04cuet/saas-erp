<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;

class SpecialPurchaseList extends Model
{
    protected $fillable = ['title', 'special_group_id', 'purchase_date', 'remark', 'payment', 'due_total'];

    public function specialGroup()
    {
        return $this->belongsTo(SpecialGroup::class);
    }

    public function purchaseItems()
    {
        return $this->hasMany(SpecialPurchaseListItem::class);
    }
}
