<?php

namespace Modules\Cafeteria\Entities;

use Modules\Cafeteria\Entities\Unit;
use Illuminate\Database\Eloquent\Model;
use Modules\Cafeteria\Entities\RawMaterial;

class SalesItem extends Model
{
    protected $fillable = ['sales_id', 'raw_material_id', 'quantity', 'unit_price', 'vat', 'total_price'];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
