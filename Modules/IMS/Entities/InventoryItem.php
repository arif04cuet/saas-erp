<?php

namespace Modules\IMS\Entities;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'inventory_item_category_id',
        'inventory_location_id',
        'unique_id',
        'title',
        'model',
        'unit_price',
        'invoice_no',
        'remark',
        'status',
        'created_by'
    ];

    public function category()
    {
        return $this->belongsTo(InventoryItemCategory::class, 'inventory_item_category_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(InventoryLocation::class, 'inventory_location_id', 'id');
    }

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function requests()
    {
        return $this->hasMany(InventoryRequestItem::class);
    }

    public function appreciationDepreciationRecords()
    {
        return $this->hasMany(ItemAppreciationDepreciationRecord::class);
    }

    public function totalAppreciation()
    {
        return $this->appreciationDepreciationRecords->filter(function ($record) {
            return $record->type == config('constants.asset_evaluation_types')[0];
        })->sum('value');
    }

    public function totalDepreciation()
    {
        return $this->appreciationDepreciationRecords->filter(function ($record) {
            return $record->type == config('constants.asset_evaluation_types')[1];
        })->sum('value');
    }
}
