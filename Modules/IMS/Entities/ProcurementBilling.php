<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;

class ProcurementBilling extends Model
{

    protected $fillable = ['title', 'order_no', 'vendor_id', 'to_location_id', 'bill_date', 'status', 'bill_setting_id', 'journal_entry_id'];

    public function items()
    {
        return $this->hasMany(ProcurementBillingItem::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function location()
    {
        return $this->belongsTo(InventoryLocation::class, 'to_location_id', 'id');
    }

    public function billSetting()
    {
        return $this->belongsTo(ProcurementAndBillSetting::class, 'bill_setting_id', 'id');
    }

    public function totalAmount()
    {
        return $this->items->each(function ($item) {
            return $item->total = ($item->unit_price * $item->quantity);
        })->sum('total');
    }

    public function totalVat()
    {
        return $this->items->sum('vat');
    }

    public function totalIt()
    {
        return $this->items->sum('it');
    }

    public function grandTotal()
    {
        return $this->items->each(function ($item) {
            return $item->grand_total = ($item->unit_price * $item->quantity) + $item->vat + $item->it;
        })->sum('grand_total');
    }
}
