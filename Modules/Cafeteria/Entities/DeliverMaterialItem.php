<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;

class DeliverMaterialItem extends Model
{
    protected $fillable = ['deliver_material_id', 'raw_material_id', 'quantity', 'status'];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
