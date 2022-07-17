<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    protected $fillable = ['district_id', 'name'];

    public function unions()
    {
        return $this->hasMany(Union::class, 'thana_id');
    }


    //belongs to a district
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');

    }

    public function getName()
    {
        $name = $this->name;
        if (empty($name)) {
            $name = $this->bn_name;
        }
        if (empty($name)) {
            $name = trans('labels.not_found');
        }
        return $name;
    }
}
