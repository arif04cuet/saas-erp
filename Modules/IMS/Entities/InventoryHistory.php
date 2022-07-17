<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;

class InventoryHistory extends Model
{
    protected $fillable = ['inventory_id', 'ref_inventory_id', 'type', 'quantity', 'is_transfer'];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'id');
    }

    public function referenceInventory()
    {
        return $this->belongsTo(Inventory::class, 'ref_inventory_id', 'id');
    }
}
