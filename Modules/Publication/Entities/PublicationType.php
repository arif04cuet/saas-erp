<?php

namespace Modules\Publication\Entities;

use Illuminate\Database\Eloquent\Model;

class PublicationType extends Model
{
    protected $table = "publication_types";

    protected $fillable = ['name_en', 'name_bn', 'status'];

    public function getName()
    {
        if (app()->isLocale('bn')) {
            return  $this->name_bn ?? trans('labels.not_found');
        } else {
            return  $this->name_en ?? trans('labels.not_found');
        }
    }
}
