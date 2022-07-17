<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;

class UnitPrice extends Model
{
    protected $fillable = ['raw_material_id', 'category', 'price', 'vat'];

}
