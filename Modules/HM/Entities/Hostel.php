<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DoptorAbleTrait;

class Hostel extends Model
{
    use DoptorAbleTrait;

    protected $fillable = [
        'name',
        'bangla_name',
        'total_floor',
        'doptor_id',
    ];

    public function getName()
    {
        if (app()->isLocale('bn')) {
            return $this->bangla_name ?? trans('labels.not_found');
        }
        return $this->name ?? trans('labels.not_found');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
