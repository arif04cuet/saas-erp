<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'date', 'sh_code', 'bar_code'];
    protected $table = 'products';
}
