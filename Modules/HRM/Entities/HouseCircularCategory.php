<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class HouseCircularCategory extends Model
{
    protected $fillable = ['house_circular_id', 'house_category_id'];

    public function category()
    {
        return $this->belongsTo(HouseCategory::class, 'house_category_id', 'id');
    }

    public function circularHouses()
    {
        return $this->hasMany(HouseCircularHouse::class, 'house_circular_category_id', 'id');
    }

    public function circularDesignations()
    {
        return $this->hasMany(HouseCircularDesignation::class, 'house_circular_category_id', 'id');
    }
}
