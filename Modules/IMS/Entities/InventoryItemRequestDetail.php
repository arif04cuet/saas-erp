<?php

namespace Modules\IMS\Entities;

use App\Entities\StateDetail;
use Iben\Statable\Models\StateHistory;
use Illuminate\Database\Eloquent\Model;

class InventoryItemRequestDetail extends Model
{
    protected $fillable = [
        'inventory_item_request_id',
        'inventory_item_category_id',
        'quantity'
    ];

    public function inventoryItemRequest()
    {
        return $this->belongsTo(InventoryItemRequest::class, 'inventory_item_request_id', 'id')
            ->withDefault();
    }

    public function inventoryItemCategory()
    {
        return $this->belongsTo(InventoryItemCategory::class, 'inventory_item_category_id', 'id')->withDefault();
    }


}
