<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['name'];

    public function districts()
    {
        return $this->hasMany(District::class, 'division_id');
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
