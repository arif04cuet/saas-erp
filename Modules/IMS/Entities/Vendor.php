<?php

namespace Modules\IMS\Entities;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['name', 'description'];
    protected $table = 'vendors';
}
