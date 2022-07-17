<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;

class FoodMenuItem extends Model
{
    protected $fillable = ['food_menu_id', 'raw_material_id'];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
