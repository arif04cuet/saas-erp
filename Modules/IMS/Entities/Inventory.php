<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories';
    protected $fillable = ['location_id', 'inventory_item_category_id', 'quantity', 'price' ];

    public function inventoryLocation()
    {
        return $this->belongsTo(InventoryLocation::class, 'location_id', 'id')->withDefault([
        'name' => 'No Location Found',
        ]);
    }

    public function inventoryItemCategory()
    {
        return $this->belongsTo(InventoryItemCategory::class, 'inventory_item_category_id', 'id')->withDefault([
            'name' => 'No Category Found',
        ]);
    }

    public function histories()
    {
        return $this->hasMany(InventoryHistory::class, 'inventory_id', 'id');
    }
}
