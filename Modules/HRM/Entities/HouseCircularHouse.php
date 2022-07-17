<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class HouseCircularHouse extends Model
{
    protected $fillable = ['house_circular_id', 'house_circular_category_id', 'house_details_id'];

    public function house()
    {
        return $this->belongsTo(HouseDetail::class, 'house_details_id', 'id');
    }

    public function houseCircular()
    {
        return $this
            ->belongsTo(HouseCircular::class, 'house_circular_id', 'id')
            ->withDefault();
    }
}
