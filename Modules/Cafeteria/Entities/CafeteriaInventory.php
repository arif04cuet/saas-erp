<?php

namespace Modules\Cafeteria\Entities;

use Modules\Cafeteria\Entities\Unit;
use Illuminate\Database\Eloquent\Model;
use Modules\Cafeteria\Entities\RawMaterial;
use Modules\Cafeteria\Entities\CafeteriaInventoryTransaction;

class CafeteriaInventory extends Model
{
    protected $fillable = ['raw_material_id', 'available_amount', 'previous_amount'];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(CafeteriaInventoryTransaction::class);
    }
}
