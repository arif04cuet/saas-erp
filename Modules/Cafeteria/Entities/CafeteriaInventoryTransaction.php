<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;

class CafeteriaInventoryTransaction extends Model
{
    protected $fillable = ['reference_table', 'reference_table_id', 'date', 'cafeteria_inventory_id', 'quantity', 'status'];

    public function purchaseList()
    {
        return $this->belongsTo(PurchaseList::class);
    }
}
