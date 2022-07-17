<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $table = 'cafeteria_venues';

    protected $fillable = [
        'name_en',
        'name_bn',
        'location',
        'priority_level',
        'description',
    ];
}
