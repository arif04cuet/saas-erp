<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class HouseApplication extends Model
{
    protected $fillable = [
        'employee_id',
        'house_circular_id',
        'name',
        'designation',
        'department',
        'salary_grade',
        'salary_scale',
        'salary',
        'birth_date',
        'bard_joining_date',
        'current_position_date',
        'present_address',
        'dp_head_recommandation',
        'status'
    ];

    public function houseCircular()
    {
        return $this->belongsTo(HouseCircular::class, 'house_circular_id', 'id')->withDefault();
    }

    public function houseDetails()
    {
        return $this->hasMany(HouseApplicationHouseDetail::class, 'house_application_id', 'id');
    }
}
