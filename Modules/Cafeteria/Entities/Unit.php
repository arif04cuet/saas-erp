<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = "units";

    protected $fillable = ['bn_name', 'en_name', 'remark'];

    public function getName()
    {
        if (app()->isLocale('bn')) {
            return  $this->bn_name ?? trans('labels.not_found');
        } else {
            return  $this->en_name ?? trans('labels.not_found');
        }
    }
}
