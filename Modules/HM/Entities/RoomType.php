<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DoptorAbleTrait;
class RoomType extends Model
{
    use DoptorAbleTrait;
    
    protected $fillable = [
        'name',
        'bangla_name',
        'doptor_id',
        'capacity',
        'seat_wise_calculation',
        'government_official_rate',
        'government_personal_rate',
        'non_government_rate',
        'international_rate',
        'bard_rate',
        'others_rate'
    ];

    public function getName()
    {
        if (app()->isLocale('bn')) {
            !is_null($this->bangla_name) ? $this->bangla_name : trans('labels.not_found');
        }
        return $this->name ?? trans('labels.not_found');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'room_type_id', 'id');
    }
}
