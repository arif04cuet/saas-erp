<?php

namespace Modules\HM\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DoptorAbleTrait;

class Room extends Model
{
    use DoptorAbleTrait;

    protected $table = 'rooms';

    protected $fillable = ['hostel_id', 'room_type_id', 'room_number', 'floor', 'doptor_id', 'status'];

    public static function getRoomStatuses()
    {
        return config('hm.roomStatuses');
    }

    public function hostel()
    {
        return $this->belongsTo(Hostel::class)->withDefault();
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id', 'id')
            ->withDefault();
    }

    public function inventories()
    {
        return $this->hasMany(RoomInventory::class);
    }

    // get all the checkIn Information of this room
    public function checkInRooms()
    {
        return $this->hasMany(CheckinRoom::class, 'room_id', 'id');
    }
}
