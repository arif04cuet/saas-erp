<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class HouseApplicationHouseDetail extends Model
{
    protected $fillable = [
        'house_application_id',
        'house_detail_id'
    ];
    protected $table = 'house_application_house_details';

    public function houseApplication()
    {
        return $this
            ->belongsTo(HouseApplication::class, 'house_application_id', 'id')
            ->withDefault();
    }

    public function houseDetail()
    {
        return $this->belongsTo(HouseDetail::class, 'house_detail_id')
            ->withDefault();
    }
}
