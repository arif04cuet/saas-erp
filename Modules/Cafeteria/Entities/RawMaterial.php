<?php

namespace Modules\Cafeteria\Entities;

use Modules\Cafeteria\Entities\Unit;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    protected $table = "raw_materials";

    protected $fillable = [
        'bn_name', 
        'en_name', 
        'unit_id', 
        'short_code', 
        'type', 
        'remark', 
        'status',
        'raw_material_category_id'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function rawMaterialCategory()
    {
        return $this->belongsTo(RawMaterialCategory::class);
    }

    public function unitPrices()
    {
        return $this->hasMany(UnitPrice::class);
    }

    public function inventories()
    {
        return $this->hasOne(CafeteriaInventory::class);
    }

    public function getName()
    {
        if (app()->isLocale('bn')) {
            return  $this->bn_name ?? trans('labels.not_found');
        } else {
            return  $this->en_name ?? trans('labels.not_found');
        }
    }
}
