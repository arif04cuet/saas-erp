<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;

class RoomInventory extends Model
{
    protected $fillable = ['room_id', 'item_name', 'quantity'];
}
