<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    protected $fillable = ['thana_id', 'name'];


    //belongs to a Thana
    public function thana()
    {
        return $this->belongsTo(Thana::class, 'thana_id');

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
