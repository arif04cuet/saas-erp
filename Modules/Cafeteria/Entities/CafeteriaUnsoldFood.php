<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;

class CafeteriaUnsoldFood extends Model
{
    protected $fillable = ['raw_material_id', 'quantity', 'remarks'];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
