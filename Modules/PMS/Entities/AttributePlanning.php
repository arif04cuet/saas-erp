<?php

namespace Modules\PMS\Entities;

use Illuminate\Database\Eloquent\Model;

class AttributePlanning extends Model
{
    protected $fillable = ['date', 'attribute_id', 'planned_value'];
}
