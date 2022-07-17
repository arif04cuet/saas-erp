<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    protected $fillable = ['title_english', 'title_bangla', 'code'];


    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'vehicle_type_id', 'id');
    }

    public function getTitle()
    {
        if (app()->isLocale('bn')) {
            return $this->title_bangla ?? trans('labels.not_found');
        }
        return $this->title_english ?? trans('labels.not_found');
    }
}
