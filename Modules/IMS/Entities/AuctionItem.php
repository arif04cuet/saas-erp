<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;

class AuctionItem extends Model
{
    public $timestamps =false;

    protected $fillable = ['auction_id', 'inventory_item_id', 'created_at'];

    public function auction()
    {
        return $this->belongsTo(Auction::class, 'auction_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id', 'id');
    }
}
