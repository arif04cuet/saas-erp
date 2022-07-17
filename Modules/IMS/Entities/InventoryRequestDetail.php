<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;

class InventoryRequestDetail extends Model
{
    protected $fillable = ['inventory_request_id', 'category_id', 'quantity'];

    public function request()
    {
        return $this->belongsTo(InventoryRequest::class, 'inventory_request_id');
    }

    public function category()
    {
        return $this->hasOne(InventoryItemCategory::class, 'id', 'category_id');
    }
}
