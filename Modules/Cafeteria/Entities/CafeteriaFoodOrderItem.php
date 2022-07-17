<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Employee;
use Modules\TMS\Entities\Training;

class CafeteriaFoodOrderItem extends Model
{
    protected $fillable = [
        'cafeteria_food_order_id',
        'raw_material_id',
        'quantity',
        'unit_id',
        'unit_price',
        'vat',
        'total_price',
        'status'
    ];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
