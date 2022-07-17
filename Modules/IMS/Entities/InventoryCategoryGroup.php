<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;

class InventoryCategoryGroup extends Model
{
    protected $table = 'inventory_category_groups';

    protected $fillable = ['name_en', 'name_bn'];

    public function categories()
    {
        return $this->hasMany(InventoryItemCategory::class, 'group_id', 'id');
    }

    public function getItemCounts()
    {
        return $this->categories->each(function ($category) {
            return $category->inventory_items = $category->inventories->sum('quantity');
        })->sum('inventory_items');
    }
}
