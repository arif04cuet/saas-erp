<?php

namespace Modules\Cafeteria\Entities;

use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    protected $fillable = ['bn_name', 'en_name', 'remark'];

    public function foodMenuItems()
    {
        return $this->hasMany(FoodMenuItem::class);
    }
}
