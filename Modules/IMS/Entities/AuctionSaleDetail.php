<?php

    namespace Modules\IMS\Entities;

    use Illuminate\Database\Eloquent\Model;

    class AuctionSaleDetail extends Model
    {
        protected $fillable = [
            'auction_sale_id',
            'inventory_item_category_id',
            'quantity',
            'unit_price',
            'tax',
            'vat'
        ];

        public function inventoryItemCategory()
        {
            return $this->belongsTo(InventoryItemCategory::class, 'inventory_item_category_id', 'id');
        }

        public function auctionSale()
        {
            return $this->belongsTo(AuctionSale::class, 'auction_sale_id', 'id');
        }
    }
