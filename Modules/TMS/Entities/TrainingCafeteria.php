<?php

namespace Modules\TMS\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainingCafeteria extends Model
{
    protected $fillable = ['name', 'short_code', 'capacity'];
}
