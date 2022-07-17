<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;

class AuctionSale extends Model
{
    protected $fillable = ['auction_id', 'vendor_id', 'order_no', 'date'];

    public function details()
    {
        return $this->hasMany(AuctionSaleDetail::class, 'auction_sale_id', 'id');
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class, 'auction_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
}
