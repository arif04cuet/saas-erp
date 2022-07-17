<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['division_id', 'name'];

    public function thanas()
    {
        return $this->hasMany(Thana::class, 'district_id');
    }

    //belongs to a Division
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');

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
