<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class HouseDetail extends Model
{
    protected $fillable = [
        'house_id',
        'house_type',
        'location',
        'allocated_to',
        'rent',
        'capacity',
        'status',
        'remark'
    ];

    public static function getStatuses($onlyKey = false)
    {
        $houseAllocationStatus = config('constants.house_allocate.status');
        if ($onlyKey) {
            return array_keys($houseAllocationStatus);
        }
        return $houseAllocationStatus;
    }

    public function category()
    {
        return $this->belongsTo(HouseCategory::class, 'house_type', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'allocated_to', 'id');
    }

    public function histories()
    {
        return $this->hasMany(HouseHistory::class, 'house_details_id', 'id');
    }
}
