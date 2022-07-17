<?php

namespace Modules\VMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Entities\Designation;

class TripLimit extends Model
{
    protected $fillable = [
        'designation_id',
        'limit'
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id')
            ->withDefault();
    }

}
