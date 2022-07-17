<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;

class InventoryRequestItem extends Model
{
    protected $fillable = ['inventory_request_id', 'inventory_item_id'];

    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id', 'id');
    }

    public function request()
    {
        return $this->belongsTo(InventoryRequest::class, 'inventory_request_id', 'id');
    }
}
