<?php

namespace App\Entities;

use App\Entities\District;
use App\Entities\Union;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
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
}
