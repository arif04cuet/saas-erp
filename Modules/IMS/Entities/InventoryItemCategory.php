<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;

class InventoryItemCategory extends Model
{

    protected $fillable = ['name', 'unique_id', 'short_code', 'type', 'unit', 'price', 'group_id'];

    protected $table = 'inventory_item_categories';

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'inventory_item_category_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(InventoryItem::class);
    }
}
