<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class HouseCircularDesignation extends Model
{
    protected $fillable = ['house_circular_id', 'house_circular_category_id', 'designation_id'];

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }
}
