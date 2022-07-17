<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ProcurementBillingItem extends Model
{
    protected $fillable = [
        'procurement_billing_id',
        'code',
        'inventory_item_category_id',
        'item_name',
        'quantity',
        'unit_price',
        'vat',
        'it'
    ];

    public function itemCategory()
    {
        return $this->belongsTo(InventoryItemCategory::class, 'inventory_item_category_id', 'id');
    }

}
