<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class HouseCategory extends Model
{
    protected $fillable = ['name', 'eligible_from', 'eligible_to', 'remark'];

    public function houseDetails()
    {
        return $this->hasMany(HouseDetail::class, 'house_type', 'id');
    }
    
}
