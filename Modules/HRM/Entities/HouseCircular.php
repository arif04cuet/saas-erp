<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class HouseCircular extends Model
{
    protected $fillable = ['reference_no', 'apply_to', 'apply_from', 'status', 'remark'];

    public function circularCategories()
    {
        return $this->hasMany(HouseCircularCategory::class, 'house_circular_id', 'id');
    }

    public function circularHouses()
    {
        return $this->hasMany(HouseCircularHouse::class, 'house_circular_id', 'id');
    }

    public function circularDesignations()
    {
        return $this->hasMany(HouseCircularDesignation::class, 'house_circular_id', 'id');
    }

    public function houseApplicants()
    {
        return $this->hasMany(HouseApplication::class, 'house_circular_id', 'id');
    }
}
