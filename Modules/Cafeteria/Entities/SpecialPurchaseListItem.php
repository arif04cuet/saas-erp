<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;

class SpecialPurchaseListItem extends Model
{
    
    protected $fillable = ['special_purchase_list_id', 'raw_material_id', 'quantity', 'unit_price', 'total_price'];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }

}
